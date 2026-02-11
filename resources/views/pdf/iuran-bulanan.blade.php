<!DOCTYPE html>
<html>

<head>
    <title>Daftar Iuran Bulanan</title>
    <style>
        /* CSS khusus untuk DomPDF */
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h3,
        .header h4,
        .header h5 {
            margin: 2px 0;
            font-weight: normal;
        }

        .header h3 {
            font-weight: bold;
            font-size: 14px;
        }

        .header h4 {
            font-weight: bold;
            font-size: 16px;
        }

        .header h5 {
            font-size: 12px;
        }

        .line {
            border-top: 2px solid black;
            margin: 10px 0;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 15px;
            text-decoration: underline;
        }

        .info-container {
            width: 100%;
            margin-bottom: 5px;
        }

        .info-text {
            font-size: 11px;
            margin-bottom: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        th {
            font-size: 10px;
        }

        td {
            font-size: 11px;
            height: 18px;
        }

        /* Tinggi baris agar enak diparaf */

        /* Pewarnaan selang-seling agar mudah dibaca (Opsional) */
        /* tr:nth-child(even) { background-color: #f9f9f9; } */
    </style>
</head>

<body>

    <div class="header">
        <h3>KERUKUNAN WARGA</h3>
        <h4>PERUMAHAN DAI PERSADA RESIDENCE 2</h4>
        <h5>RT. 09 / RW. 06 SASAK</h5>
    </div>

    <div class="line"></div>

    <div class="title">DAFTAR IURAN BULANAN</div>

    <div class="info-container">
        <div class="info-text">BULAN: Januari s/d Desember {{ $tahun }}</div>
        <div class="info-text">Jumlah Iuran: Rp. {{ number_format($jenisIuran->nominal, 0, ',', '.') }} / bulan</div>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2" width="4%">NO</th>
                <th rowspan="2" width="10%">NO.<br>RUMAH</th>
                <th rowspan="2" width="16%">NAMA WARGA</th>
                <th colspan="12">PARAF</th>
            </tr>
            <tr>
                @foreach(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'] as $bln)
                <th width="5%">{{ $bln }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($wargas as $index => $warga)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $warga->blok_rumah }} - {{ $warga->no_rumah }}</td>
                <td style="text-align: left; padding-left: 5px;">{{ $warga->nama }}</td>

                @for($i=1; $i<=12; $i++)
                    <td>
                    </td>
                    @endfor
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>