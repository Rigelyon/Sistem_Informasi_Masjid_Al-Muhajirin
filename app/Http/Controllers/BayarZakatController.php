<?php

namespace App\Http\Controllers;

use App\Models\BayarZakat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BayarZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));
        
        $bayar_zakat = BayarZakat::whereYear('created_at', $selectedYear)->get();
        return Inertia::render("bayar", [
            "bayarZakat" => $bayar_zakat,
            "selectedYear" => (int)$selectedYear,
            "availableYears" => range(date('Y'), date('Y') - 4)
        ]);
    }

    /**
     * Generate bills for a specific year
     */
    public function generate(Request $request) 
    {
        $year = $request->input('year', date('Y'));
        
        // Progressive Lock Check:
        // Do not allow generation if data already exists for a FUTURE year.
        // This prevents backfilling historical data with current (potentially incorrect) status
        // after the new cycle has begun.
        $futureDataExists = BayarZakat::whereYear('created_at', '>', $year)->exists();
        
        if ($futureDataExists) {
            return back()->with('error', "Gagal: Sudah ada data tagihan untuk tahun mendatang (>" . $year . "). Mohon input manual untuk tahun lampau agar data akurat.");
        }

        // Find all Warga capable of paying (Mampu)
        // Assuming 'kategori_id' for Mampu is known or can be found. 
        // Based on WargaController, we look for 'Mampu'.
        $kategoriMampu = \App\Models\Kategori::where('nama', 'Mampu')->first();
        
        if (!$kategoriMampu) {
            return back()->with('error', 'Kategori "Mampu" tidak ditemukan.');
        }

        $wargaMampu = \App\Models\Warga::where('kategori_id', $kategoriMampu->id)->get();
        $count = 0;

        foreach ($wargaMampu as $warga) {
            // Check if bill already exists for this year
            $exists = BayarZakat::where('warga_id', $warga->id)
                ->whereYear('created_at', $year)
                ->exists();
                
            if (!$exists) {
                BayarZakat::create([
                    "warga_id" => $warga->id,
                    "nama_KK" => $warga->nama,
                    "nomor_KK" => $warga->keluarga_id,
                    "jumlah_tanggungan" => $warga->jumlah_tanggungan,
                    "status" => 'pending',
                    "created_at" => \Carbon\Carbon::createFromDate($year, 1, 1) // Set to Jan 1st of that year
                ]);
                $count++;
            }
        }

        return back()->with('success', "Berhasil membuat $count tagihan zakat untuk tahun $year.");
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
        BayarZakat::create([
            "warga_id" => $request->warga_id,
            "nama_KK" => $request->nama_KK,
            "nomor_KK" => $request->nomor_KK,
            "jumlah_tanggungan" => $request->jumlah_tanggungan,
            "status" => 'pending'
        ]);
        
        return back()->with('success', 'Tagihan zakat berhasil dibuat manual');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $bayar_zakat = BayarZakat::findOrFail($id);
        $bayar_zakat->update([
            'jenis_bayar' => $request->jenis_bayar,
            'status' => $request->status,
            'bayar_beras' => $request->bayar_beras,
            'bayar_uang' => $request->bayar_uang,
            'total_zakat' => $request->total_zakat,
        ]);

        return back()->with('success', 'Data zakat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
