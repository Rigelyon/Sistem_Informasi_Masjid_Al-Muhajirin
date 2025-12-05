<?php

namespace App\Http\Controllers;

use App\Models\BayarZakat;
use App\Models\DistribusiZakat;
use App\Models\Kategori;
use App\Models\KategoriBayarZakat;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warga = Warga::with("kategori")->orderBy('created_at', 'desc')->get();

        $kategori = Kategori::all();
        return Inertia::render("warga", ["warga" => $warga, 'kategori' => $kategori]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Determine Category ID based on Type (Muzakki vs Mustahik)
        $kategoriId = null;
        if ($request->type === 'Muzakki') {
            $kategoriMampu = Kategori::where('nama', 'Mampu')->first();
            $kategoriId = $kategoriMampu ? $kategoriMampu->id : null;
        } 
        // For Mustahik, we leave kategori_id as null initially (to be filled in Distribution)

        // 2. Create Warga
        $warga = Warga::create([
            "keluarga_id" => $request["keluarga_id"],
            'nama' => $request["nama"],
            'deskripsi' => $request["deskripsi"],
            'kategori_id' => $kategoriId,
            'jumlah_tanggungan' => (int) $request["jumlah_tanggungan"]
        ]);

        // 3. Create Related Records based on Type
        if ($request->type === 'Muzakki') {
            // Create BayarZakat record linked to Warga
            BayarZakat::create([
                "warga_id" => $warga->id,
                "nama_KK" => $request["nama"],
                "nomor_KK" => $request["keluarga_id"],
                "jumlah_tanggungan" => (int) $request["jumlah_tanggungan"],
            ]);
        } else {
            // Mustahik: Create DistribusiZakat record
            DistribusiZakat::create([
                'warga_id' => $warga->id,
            ]);
        }

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = BayarZakat::where('nomor_KK', $id)->first();

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warga = Warga::findOrFail($id);
        
        // Determine new Category ID based on Type
        $kategoriId = $warga->kategori_id; // Default to existing
        if ($request->type === 'Muzakki') {
            $kategoriMampu = Kategori::where('nama', 'Mampu')->first();
            $kategoriId = $kategoriMampu ? $kategoriMampu->id : null;
        } elseif ($request->type === 'Mustahik') {
            // If switching to Mustahik, clear the "Mampu" category if it was set
            $kategoriMampu = Kategori::where('nama', 'Mampu')->first();
            if ($warga->kategori_id == $kategoriMampu->id) {
                $kategoriId = null; 
            }
        }

        $warga->update([
            "keluarga_id" => $request["keluarga_id"],
            'nama' => $request["nama"],
            'deskripsi' => $request["deskripsi"],
            'kategori_id' => $kategoriId,
            'jumlah_tanggungan' => (int) $request["jumlah_tanggungan"]
        ]);

        // Handle Switching Logic
        if ($request->type === 'Muzakki') {
            // Ensure BayarZakat exists for CURRENT YEAR
            $currentYear = date('Y');
            
            // Check if there is already a bill for this year
            $existingBill = $warga->bayarZakat()
                ->whereYear('created_at', $currentYear)
                ->first();

            if (!$existingBill) {
                BayarZakat::create([
                    "warga_id" => $warga->id,
                    "nama_KK" => $warga->nama,
                    "nomor_KK" => $warga->keluarga_id,
                    "jumlah_tanggungan" => $warga->jumlah_tanggungan,
                ]);
            } else {
                // Sync data just in case
                $existingBill->update([
                    "nama_KK" => $warga->nama,
                    "nomor_KK" => $warga->keluarga_id,
                    "jumlah_tanggungan" => $warga->jumlah_tanggungan,
                ]);
            }
            
            // Remove from Distribusi if exists (Optional: Might want to keep history here too? 
            // For now, let's assume if they become Muzakki, they shouldn't receive aid THIS year/active cycle)
            $warga->distribusiZakats()
                  ->where('status', 'belum_terkirim') // Safety: Only delete if not yet sent
                  ->delete();

        } elseif ($request->type === 'Mustahik') {
            // Ensure DistribusiZakat exists
            if ($warga->distribusiZakats->isEmpty()) {
                DistribusiZakat::create([
                    'warga_id' => $warga->id,
                ]);
            }
            
            // Remove from BayarZakat ONLY IF PENDING (Cancel the bill)
            // Do NOT delete history of previous payments (lunas)
            $warga->bayarZakat()
                  ->where('status', 'pending')
                  ->delete();
        }

        return back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warga = Warga::findOrFail($id);
        $bayarZakat = BayarZakat::where("nomor_KK", $warga->keluarga_id)->first();
        if ($bayarZakat) {
            $bayarZakat->delete();
        }
        $distribusiZakat = DistribusiZakat::where("warga_id", "=", $id)->get()->first();
        if ($distribusiZakat) {
            $distribusiZakat->delete();
        }
        $warga->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
