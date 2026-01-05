<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transparansi Keuangan Warga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #0f172a;
            color: #ffffff;
        }

        /* Tema Gelap ala Filament */
    </style>
</head>

<body class="flex flex-col items-center min-h-screen px-4 py-10 antialiased">

    <div class="mb-10 text-center">
        <h1 class="mb-2 text-3xl font-bold text-white">Transparansi Keuangan RT</h1>
        <p class="text-gray-400">Laporan realtime kas dan alokasi dana warga</p>
    </div>

    <div class="w-full max-w-6xl space-y-8">

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

            <div class="p-6 bg-gray-800 border border-gray-700 shadow-lg rounded-xl">
                <div class="flex items-center mb-2 space-x-3">
                    <span class="text-2xl">💰</span>
                    <h3 class="text-sm font-medium text-gray-400">Total Pemasukan Iuran</h3>
                </div>
                <p class="text-3xl font-bold text-green-400">
                    {{ Number::currency($totalPemasukan, 'IDR', 'id') }}
                </p>
                <p class="mt-1 text-xs text-gray-500">Dari iuran yang sudah lunas</p>
            </div>

            <a href="/pengeluaran" class="block bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-700 hover:border-red-500 hover:bg-gray-750 transition duration-300 group cursor-pointer">
                <div class="flex items-center space-x-3 mb-2">
                    <span class="text-2xl">💸</span>
                    <h3 class="text-sm font-medium text-gray-400 group-hover:text-white transition">Total Pengeluaran</h3>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500 group-hover:text-red-400 ml-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </div>
                <p class="text-3xl font-bold text-red-400">
                    {{ Number::currency($totalPengeluaran, 'IDR', 'id') }}
                </p>
                <p class="text-xs text-gray-500 mt-1 group-hover:text-gray-300">Klik untuk lihat rincian</p>
            </a>

            <div class="p-6 bg-gray-800 border border-gray-700 shadow-lg rounded-xl">
                <div class="flex items-center mb-2 space-x-3">
                    <span class="text-2xl">📊</span>
                    <h3 class="text-sm font-medium text-gray-400">Saldo Kas Bersih</h3>
                </div>
                <p class="text-3xl font-bold {{ $saldoBersih >= 0 ? 'text-blue-400' : 'text-red-500' }}">
                    {{ Number::currency($saldoBersih, 'IDR', 'id') }}
                </p>
                <p class="mt-1 text-xs text-gray-500">Selisih Pemasukan & Pengeluaran</p>
            </div>
        </div>

        <div class="my-8 border-t border-gray-700"></div>

        <h2 class="mb-4 text-xl font-semibold text-white">Rincian Saldo per Pos Anggaran</h2>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($posAnggarans as $pos)
            @php
            $totalPos = $pos->mutasi_danas_sum_nominal ?? 0;
            @endphp

            <div class="relative p-6 overflow-hidden transition duration-300 bg-gray-800 border border-gray-700 shadow-lg rounded-xl group hover:border-blue-500">
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-cyan-400"></div>

                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="mb-1 text-sm font-medium text-gray-400">{{ $pos->nama }}</h3>
                        <p class="text-2xl font-bold text-white">
                            {{ Number::currency($totalPos, 'IDR', 'id') }}
                        </p>
                        <p class="inline-block px-2 py-1 mt-2 font-mono text-xs text-blue-400 rounded bg-blue-900/30">
                            KODE: {{ $pos->kode ?? '-' }}
                        </p>
                    </div>
                    <div class="p-3 text-gray-300 bg-gray-700 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 right-0 h-10 opacity-20">
                    <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                        <path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #3b82f6;"></path>
                    </svg>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</body>

</html>