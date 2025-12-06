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
        // Default to current Hijri Year/Month would be ideal, but for now we might default to latest available or just Gregorian Year equivalent?
        // Let's rely on frontend sending params, or default to all? 
        // User asked for Hijri Filter. Let's assume we pass nothing, we might want to return everything or latest year?
        // Let's keep logic simple: If 'tahun_hijriah' is passed, use it. If 'year' passed, use created_at (legacy).
        
        $query = BayarZakat::query();
        
        if ($request->has('tahun_hijriah')) {
            $query->where('tahun_hijriah', $request->tahun_hijriah);
            if ($request->has('bulan_hijriah') && $request->bulan_hijriah !== 'all') {
                $query->where('bulan_hijriah', $request->bulan_hijriah);
            }
        } elseif ($request->has('year')) {
             $query->whereYear('created_at', $request->year);
        } else {
             // Default to showing everything or maybe just latest unified period?
             // Let's default to latest 50 records for now to avoid empty page
        }

        $bayar_zakat = $query->get();
        
        // We need to fetch available Hijri Years for the filter
        $availableHijriYears = BayarZakat::select('tahun_hijriah')->distinct()->orderBy('tahun_hijriah', 'desc')->pluck('tahun_hijriah')->filter()->values();
        
        return Inertia::render("bayar", [
            "bayarZakat" => $bayar_zakat,
            "filters" => $request->all(['tahun_hijriah', 'bulan_hijriah', 'year']),
            "availableHijriYears" => $availableHijriYears // Pass this to frontend
        ]);
    }

    /**
     * Unified Generation for Zakat Period (Hijri)
     */
    public function generateUnified(Request $request) 
    {
        $tahunHijriah = $request->input('tahun_hijriah');
        $bulanHijriah = $request->input('bulan_hijriah');
        
        if (!$tahunHijriah || !$bulanHijriah) {
            return back()->with('error', 'Tahun dan Bulan Hijriah wajib diisi.');
        }

        // Progressive Lock Check (Hijri)
        $futureDataExists = BayarZakat::where('tahun_hijriah', '>', $tahunHijriah)->exists();
        
        if ($futureDataExists) {
            return back()->with('error', "Gagal: Sudah ada data periode tahun mendatang (> $tahunHijriah H).");
        }
        
        // 1. Generate BayarZakat (For Mampu)
        $kategoriMampu = \App\Models\Kategori::where('nama', 'Mampu')->first();
        if (!$kategoriMampu) return back()->with('error', 'Kategori Mampu tidak ditemukan.');
        
        $wargaMampu = \App\Models\Warga::where('kategori_id', $kategoriMampu->id)->get();
        $bayarCount = 0;
        
        foreach ($wargaMampu as $warga) {
            $exists = BayarZakat::where('warga_id', $warga->id)
                ->where('tahun_hijriah', $tahunHijriah)
                ->exists(); // Check existence by Hijri Year primarily
                
            if (!$exists) {
                BayarZakat::create([
                    "warga_id" => $warga->id,
                    "nama_KK" => $warga->nama,
                    "nomor_KK" => $warga->keluarga_id,
                    "jumlah_tanggungan" => $warga->jumlah_tanggungan,
                    "status" => 'pending',
                    "tahun_hijriah" => $tahunHijriah,
                    "bulan_hijriah" => $bulanHijriah,
                    "created_at" => now() // Record created now
                ]);
                $bayarCount++;
            }
        }

        // 2. Generate DistribusiZakat (For Mustahik / Non-Mampu)
        // Find Warga who are NOT Mampu
        $wargaMustahik = \App\Models\Warga::where('kategori_id', '!=', $kategoriMampu->id)->orWhereNull('kategori_id')->get();
        $distribusiCount = 0;
        
        foreach ($wargaMustahik as $warga) {
            // Ensure DistribusiZakat exists for this period
             $exists = \App\Models\DistribusiZakat::where('warga_id', $warga->id)
                ->where('tahun_hijriah', $tahunHijriah)
                ->exists();
            
            if (!$exists) {
                \App\Models\DistribusiZakat::create([
                    'warga_id' => $warga->id,
                    'status' => 'belum_terkirim', // Default status
                    'tahun_hijriah' => $tahunHijriah,
                    "bulan_hijriah" => $bulanHijriah,
                    'created_at' => now()
                ]);
                $distribusiCount++;
            }
        }

        return back()->with('success', "Berhasil membuka periode $tahunHijriah H ($bulanHijriah). Dibuat: $bayarCount Tagihan, $distribusiCount Penerima.");
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
