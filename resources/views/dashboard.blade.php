<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <!-- Dashboard Section -->
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="text-lg font-semibold mb-4">Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-500 text-white p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">Total Penerima Zakat</h2>
                    <p class="text-2xl mt-2">120</p>
                </div>
                <div class="bg-green-500 text-white p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">Total Dana Terkumpul</h2>
                    <p class="text-2xl mt-2">Rp. 50 Juta</p>
                </div>
                <div class="bg-yellow-500 text-white p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">Transaksi Bulan Ini</h2>
                    <p class="text-2xl mt-2">85</p>
                </div>
                <div class="bg-red-500 text-white p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">Dana Belum Disalurkan</h2>
                    <p class="text-2xl mt-2">Rp. 10 Juta</p>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">Transaksi Terbaru</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">No</th>
                        <th class="border p-2">Nama Donatur</th>
                        <th class="border p-2">Jumlah</th>
                        <th class="border p-2">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border p-2">1</td>
                        <td class="border p-2">Ahmad</td>
                        <td class="border p-2">Rp. 500.000</td>
                        <td class="border p-2">2025-01-10</td>
                    </tr>
                    <tr>
                        <td class="border p-2">2</td>
                        <td class="border p-2">Siti</td>
                        <td class="border p-2">Rp. 1.000.000</td>
                        <td class="border p-2">2025-01-09</td>
                    </tr>
                    <tr>
                        <td class="border p-2">3</td>
                        <td class="border p-2">Hidayat</td>
                        <td class="border p-2">Rp. 300.000</td>
                        <td class="border p-2">2025-01-08</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
