<?php

namespace App\Http\Controllers;

use App\Models\DistribusiZakat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DistribusiZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DistribusiZakat::with("warga", 'kategori');
        
        if ($request->has('tahun_hijriah')) {
            $query->where('tahun_hijriah', $request->tahun_hijriah);
        }
        
        $distribusiZakat = $query->get();
        $availableHijriYears = DistribusiZakat::select('tahun_hijriah')->distinct()->orderBy('tahun_hijriah', 'desc')->pluck('tahun_hijriah')->filter()->values();

        return Inertia::render("distribusi", [
            "distribusiZakat" => $distribusiZakat,
            "filters" => $request->all(['tahun_hijriah']),
            "availableHijriYears" => $availableHijriYears
        ]);
    }

    public function mustahik()
    {
        // Return only Asnaf categories (exclude Mampu)
        $mustahik = Kategori::where('nama', '!=', 'Mampu')->get();
        return response()->json($mustahik);
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
        //
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
        $distribusi = DistribusiZakat::findOrFail($id);

        $distribusi->update([
            "kategori_id" => $request["kategori_id"],
            "jenis_bantuan" => (string) $request["jenis_bantuan"],
            "jumlah_uang" => $request["jumlah_uang"],
            "jumlah_beras" => $request["jumlah_beras"],
            "status" => (string) $request["status"],
        ]);

        // Sync Warga Category if linked
        if ($distribusi->warga_id && $request["kategori_id"]) {
            $warga = $distribusi->warga;
            if ($warga) {
                $warga->update(['kategori_id' => $request["kategori_id"]]);
            }
        }

        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function distribusi(string $id)
    {
        $distribusi = DistribusiZakat::with("kategori")->where("warga_id", "=", (int) $id)->get()->first();

        if (!$distribusi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($distribusi);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
