<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rincian Pengeluaran - Transparansi RT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #0f172a;
            color: #ffffff;
        }
    </style>
</head>

<body class="flex flex-col items-center min-h-screen px-4 py-10 antialiased">

    <div class="w-full max-w-4xl space-y-6">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-white">Rincian Pengeluaran</h1>
                <p class="text-sm text-gray-400">Daftar penggunaan dana kas warga</p>
            </div>
            <a href="/" class="flex items-center gap-2 px-4 py-2 text-sm transition bg-gray-700 rounded-lg hover:bg-gray-600">
                &larr; Kembali
            </a>
        </div>

        <div class="overflow-hidden bg-gray-800 border border-gray-700 shadow-lg rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="font-medium text-gray-200 uppercase bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4">Tanggal</th>
                            <th scope="col" class="px-6 py-4">Keterangan / Keperluan</th>
                            <th scope="col" class="px-6 py-4 text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($pengeluarans as $item)
                        <tr class="transition hover:bg-gray-700/50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4 text-white">
                                {{ $item->keterangan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 font-mono font-bold text-right text-red-400">
                                {{ Number::currency($item->nominal, 'IDR', 'id') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                Belum ada data pengeluaran tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pengeluarans->hasPages())
            <div class="px-6 py-4 bg-gray-800 border-t border-gray-700">
                {{ $pengeluarans->links('pagination::tailwind') }}
            </div>
            @endif
        </div>

    </div>

</body>

</html>