<!DOCTYPE html>
<html>

<head>
    <title>Laporan Monitoring Iuran</title>
    <style>
        /* Konfigurasi Halaman */
        @page {
            size: landscape;
            margin: 1cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            /* Ukuran font sedikit dikecilkan agar muat */
            color: #333;
        }

        /* Header Style */
        .header-container {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
        }

        .header-table {
            width: 100%;
        }

        .header-title h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 18pt;
            text-transform: uppercase;
        }

        .header-meta {
            text-align: right;
            font-size: 10pt;
        }

        .header-meta span {
            display: block;
            font-weight: bold;
            color: #555;
        }

        /* Table Style */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        .data-table th {
            background-color: #2c3e50;
            /* Warna Header Gelap */
            color: #fff;
            padding: 8px;
            font-size: 9pt;
            border: 1px solid #2c3e50;
        }

        .data-table td {
            padding: 6px 4px;
            border: 1px solid #ddd;
            text-align: center;
        }

        /* Zebra Striping (Warna selang-seling) */
        .data-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Kolom Nama & Blok Rata Kiri/Tengah Khusus */
        .col-nama {
            text-align: left !important;
            padding-left: 8px !important;
            font-weight: bold;
            width: 25%;
        }

        .col-blok {
            font-weight: bold;
            width: 10%;
        }

        /* Status Styles */
        .status-lunas {
            color: #27ae60;
            /* Hijau */
            font-weight: bold;
            font-size: 10pt;
        }

        .status-belum {
            color: #e74c3c;
            /* Merah Pudar */
            font-size: 8pt;
            font-weight: normal;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 8pt;
            text-align: right;
            color: #888;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="header-container">
        <table class="header-table">
            <tr>
                <td class="header-title">
                    <h2>Laporan Keuangan Warga</h2>
                </td>
                <td class="header-meta">
                    <span>TAHUN: {{ $tahun }}</span>
                    <span style="color: #2980b9;">{{ strtoupper($nama_iuran) }}</span>
                </td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 5%;">No</th>
                <th rowspan="2">Nama Warga</th>
                <th rowspan="2">Blok / Rumah</th>
                <th colspan="12">Bulan Pembayaran</th>
            </tr>
            <tr>
                @for($i = 1; $i <= 12; $i++)
                    <th>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('M') }}</th>
                    @endfor
            </tr>
        </thead>
        <tbody>
            @foreach($wargas as $index => $warga)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="col-nama">{{ $warga->nama }}</td>
                <td class="col-blok">{{ $warga->blok_rumah }} / {{ $warga->no_rumah }}</td>

                @foreach(range(1, 12) as $bulan)
                @php
                $lunas = $warga->iurans->contains(function ($iuran) use ($bulan, $tahun, $jenis_iuran_id) {
                return $iuran->bulan == $bulan
                && $iuran->tahun == $tahun
                && $iuran->jenis_iuran_id == $jenis_iuran_id
                && $iuran->status == 'lunas';
                });
                @endphp

                <td>
                    @if($lunas)
                    <span class="status-lunas">v</span>
                    @else
                    <span class="status-belum">-</span>
                    @endif
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d F Y H:i') }}
    </div>
</body>

</html>