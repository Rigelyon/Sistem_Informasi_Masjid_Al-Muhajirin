<?php

namespace App\Http\Controllers;

use App\Models\BayarZakat;
use App\Models\DistribusiZakat;
use App\Models\DistribusiZakatLainnya;
use App\Models\Warga;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class LaporanZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function exportPdf(Request $request)
    {

        $konversiBerasKeUang = 15000;
        
        $tahunHijriah = $request->input('tahun_hijriah');
        $selectedYear = $request->input('year', date('Y'));
        $yearLabel = "";

        $queryZakat = BayarZakat::where('status', 'lunas');
        $queryDistribusi = DistribusiZakat::where('status', 'terkirim');
        $queryLainnya = DistribusiZakatLainnya::where('status', 'terkirim');
        
        if ($tahunHijriah) {
            $queryZakat->where('tahun_hijriah', $tahunHijriah);
            $queryDistribusi->where('tahun_hijriah', $tahunHijriah);
            $queryLainnya->where('tahun_hijriah', $tahunHijriah);
            $yearLabel = $tahunHijriah . ' Hijriah';
        } else {
             $queryZakat->whereYear('created_at', $selectedYear);
             $queryDistribusi->whereYear('tanggal_distribusi', $selectedYear);
             $queryLainnya->whereYear('tanggal_distribusi', $selectedYear);
             $yearLabel = $selectedYear . ' Masehi';
        }

        $zakatLunas = $queryZakat->get();
        $distribusiZakatTerkirim = $queryDistribusi->get();
        $distribusiLainnya = $queryLainnya->get();

        $totalUang = 0;
        $totalBeras = 0;
        $totalUangDistribusi = 0;
        $totalBerasDistribusi = 0;
        $totalUangDistribusiLainnya = 0;
        $totalBerasDistribusiLainnya = 0;

        foreach ($zakatLunas as $zakat) {
            if ($zakat->jenis_bayar === 'uang') {
                $totalUang += $zakat->bayar_uang;
                $totalBeras += $zakat->bayar_uang / $konversiBerasKeUang;
            } elseif ($zakat->jenis_bayar === 'beras') {
                $totalBeras += $zakat->bayar_beras;
                $totalUang += $zakat->bayar_beras * $konversiBerasKeUang;
            }
        }

        foreach ($distribusiZakatTerkirim as $d) {
            if ($d->jenis_bantuan === 'uang') {
                $totalUangDistribusi += $d->jumlah_uang;
                $totalBerasDistribusi += $d->jumlah_uang / $konversiBerasKeUang;
            } elseif ($d->jenis_bantuan === 'beras') {
                $totalBerasDistribusi += $d->jumlah_beras;
                $totalUangDistribusi += $d->jumlah_beras * $konversiBerasKeUang;
            }
        }

        foreach ($distribusiLainnya as $d) {
            if ($d->jenis_bantuan === 'uang') {
                $totalUangDistribusiLainnya += $d->jumlah_uang;
                $totalBerasDistribusiLainnya += $d->jumlah_uang / $konversiBerasKeUang;
            } elseif ($d->jenis_bantuan === 'beras') {
                $totalBerasDistribusiLainnya += $d->jumlah_beras;
                $totalUangDistribusiLainnya += $d->jumlah_beras * $konversiBerasKeUang;
            }
        }

        $wargaWajib = Warga::where('kategori_id', 1)->get();

        $querySudahBayar = BayarZakat::where('status', 'lunas');
        if ($tahunHijriah) {
            $querySudahBayar->where('tahun_hijriah', $tahunHijriah);
        } else {
            $querySudahBayar->whereYear('created_at', $selectedYear);
        }
        $sudahBayarKeluarga = $querySudahBayar->pluck("nomor_KK")->toArray();

        $sudahBayar = 0;
        $belumBayar = 0;

        foreach ($wargaWajib as $warga) {
            if (in_array($warga->keluarga_id, $sudahBayarKeluarga)) {
                $sudahBayar++;
            } else {
                $belumBayar++;
            }
        }

        $queryTerdistribusi = DistribusiZakat::where('status', 'terkirim');
        if ($tahunHijriah) {
            $queryTerdistribusi->where('tahun_hijriah', $tahunHijriah);
        } else {
            $queryTerdistribusi->whereYear('tanggal_distribusi', $selectedYear);
        }
        $jumlahWargaTerdistribusi = $queryTerdistribusi->distinct('warga_id')->count('warga_id');

        $queryPenerimaLainnya = DistribusiZakatLainnya::where('status', 'terkirim');
        if ($tahunHijriah) {
            $queryPenerimaLainnya->where('tahun_hijriah', $tahunHijriah);
        } else {
            $queryPenerimaLainnya->whereYear('tanggal_distribusi', $selectedYear);
        }
        $jumlahPenerimaLainnya = $queryPenerimaLainnya->count();
        // Ambil data summary
        $data = [
            "totalZakatBeras" => $totalBeras,
            "totalZakatUang" => $totalUang,
            "totalDistribusiZakatBeras" => $totalBerasDistribusi,
            'totalDistribusiZakatUang' => $totalUangDistribusi,
            "totalUangDistribusiLainnya" => $totalUangDistribusiLainnya,
            'totalBerasDistribusiLainnya' => $totalBerasDistribusiLainnya,
            "wargaWajibBayar" => count($wargaWajib),
            "sudahBayar" => $sudahBayar,
            "belumBayar" => $belumBayar,
            "jumlahWargaTerdistribusi" => $jumlahWargaTerdistribusi,
            "jumlahPenerimaLainnya" => $jumlahPenerimaLainnya,
            "tahun" => $yearLabel,
            
            // Detailed Data
            "zakatLunas" => $zakatLunas,
            "distribusiZakatTerkirim" => $distribusiZakatTerkirim,
            "distribusiLainnya" => $distribusiLainnya
        ];

        // Render PDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.laporan-zakat', ['data' => $data]);

        // Kembalikan file PDF
        return $pdf->download('laporan_zakat_' . $selectedYear . '.pdf');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
