<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengelolaan Zakat</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.6; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #000; text-align: left; }
        .section-title { background-color: #f2f2f2; padding: 5px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Laporan Pengelolaan Zakat</h1>
    <p>Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

    <div class="section-title">Data Penerimaan Zakat</div>
    <table>
        <tr><th>Jenis</th><th>Jumlah</th></tr>
        <tr><td>Total Zakat Beras</td><td>{{ $data['totalZakatBeras'] }} kg</td></tr>
        <tr><td>Total Zakat Uang</td><td>Rp {{ number_format($data['totalZakatUang'], 0, ',', '.') }}</td></tr>
    </table>

    <div class="section-title">Data Distribusi Zakat</div>
    <table>
        <tr><th>Jenis</th><th>Jumlah</th></tr>
        <tr><td>Beras ke Warga</td><td>{{ $data['totalDistribusiZakatBeras'] }} kg</td></tr>
        <tr><td>Uang ke Warga</td><td>Rp {{ number_format($data['totalDistribusiZakatUang'], 0, ',', '.') }}</td></tr>
        <tr><td>Beras ke Warga Lain</td><td>{{ $data['totalBerasDistribusiLainnya'] }} kg</td></tr>
        <tr><td>Uang ke Warga Lain</td><td>Rp {{ number_format($data['totalUangDistribusiLainnya'], 0, ',', '.') }}</td></tr>
    </table>

    <div class="section-title">Status Pembayaran Zakat</div>
    <table>
        <tr><td>Total Warga Wajib Zakat</td><td>{{ $data['wargaWajibBayar'] }}</td></tr>
        <tr><td>Sudah Bayar</td><td>{{ $data['sudahBayar'] }}</td></tr>
        <tr><td>Belum Bayar</td><td>{{ $data['belumBayar'] }}</td></tr>
    </table>

    <div class="section-title">Data Penerima</div>
    <table>
        <tr><td>Jumlah Warga Terdistribusi</td><td>{{ $data['jumlahWargaTerdistribusi'] }}</td></tr>
        <tr><td>Jumlah Penerima Lainnya</td><td>{{ $data['jumlahPenerimaLainnya'] }}</td></tr>
    </table>

    <div style="page-break-before: always;"></div>

    <div class="section-title">Rincian Pemasukan Zakat</div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama KK</th>
                <th>Tanggungan</th>
                <th>Jenis Bayar</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data['zakatLunas'] as $index => $zakat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $zakat->nama_KK }}</td>
                <td>{{ $zakat->jumlah_tanggungan }}</td>
                <td>{{ ucfirst($zakat->jenis_bayar) }}</td>
                <td>
                    @if($zakat->jenis_bayar == 'beras')
                        {{ $zakat->bayar_beras }} Kg
                    @else
                        Rp {{ number_format($zakat->bayar_uang, 0, ',', '.') }}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data pemasukan zakat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Rincian Penyaluran Zakat</div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama Penerima</th>
                <th>Kategori</th>
                <th>Jenis Bantuan</th>
                <th>Tgl Distribusi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data['distribusiZakatTerkirim'] as $d)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $d->warga->nama ?? 'Warga' }}</td>
                <td>{{ $d->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ ucfirst($d->jenis_bantuan) }}</td>
                <td>{{ \Carbon\Carbon::parse($d->tanggal_distribusi)->format('d/m/Y') }}</td>
                <td>
                    @if($d->jenis_bantuan == 'beras')
                        {{ $d->jumlah_beras }} Kg
                    @else
                        Rp {{ number_format($d->jumlah_uang, 0, ',', '.') }}
                    @endif
                </td>
            </tr>
            @endforeach

            @foreach($data['distribusiLainnya'] as $d)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $d->nama }} (Lainnya)</td>
                <td>{{ $d->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ ucfirst($d->jenis_bantuan) }}</td>
                <td>{{ \Carbon\Carbon::parse($d->tanggal_distribusi)->format('d/m/Y') }}</td>
                <td>
                    @if($d->jenis_bantuan == 'beras')
                        {{ $d->jumlah_beras }} Kg
                    @else
                        Rp {{ number_format($d->jumlah_uang, 0, ',', '.') }}
                    @endif
                </td>
            </tr>
            @endforeach

            @if(count($data['distribusiZakatTerkirim']) == 0 && count($data['distribusiLainnya']) == 0)
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data penyaluran zakat.</td>
            </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
