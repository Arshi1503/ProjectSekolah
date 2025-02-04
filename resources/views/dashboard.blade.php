<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Ringkasan Keuangan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Pemasukan</h3>
                    <p class="text-green-500 text-2xl font-bold">Rp{{ number_format($totalIncome, 0, ',', '.') }}</p>
                    <a href="{{ route('report.index') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg inline-block gap-4 mt-4">Tambah Pemasukan</a>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Pengeluaran</h3>
                    <p class="text-red-500 text-2xl font-bold">Rp{{ number_format($totalExpense, 0, ',', '.') }}</p>
                    <a href="{{ route('report.index') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg inline-block gap-4 mt-4">Tambah Pengeluaran</a>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Saldo Akhir</h3>
                    <p class="text-blue-500 text-2xl font-bold">Rp{{ number_format($totalBalance, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Grafik Statistik -->
            <div class="bg-white dark:bg-gray-800 p-6 mt-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 dark:text-gray-200">Statistik Keuangan</h3>
                <canvas id="tabunganChart"></canvas>
            </div>

            <!-- History Laporan -->
            <div class="bg-white dark:bg-gray-800 p-6 mt-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 dark:text-gray-200">Riwayat Laporan Terbaru</h3>
                <table class="w-full border-collapse border border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="border px-4 py-2 border-gray-300 dark:border-gray-600 dark:text-gray-200">Tanggal</th>
                            <th class="border px-4 py-2 border-gray-300 dark:border-gray-600 dark:text-gray-200">Proses</th>
                            <th class="border px-4 py-2 border-gray-300 dark:border-gray-600 dark:text-gray-200">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentReports as $report)
                            <tr>
                                <td class="border px-4 py-2 border-gray-300 dark:border-gray-600 dark:text-gray-200">{{ $report->created_at->format('d/m/Y') }}</td>
                                <td class="border px-4 py-2 border-gray-300 dark:border-gray-600 dark:text-gray-200">{{ ucfirst($report->type) }}</td>
                                <td class="border px-4 py-2 border-gray-300 dark:border-gray-600 dark:text-gray-200">Rp{{ number_format($report->amount, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('report.index') }}" class="mt-4 inline-block text-blue-500">Lihat Semua</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('/chart-data')
                .then(response => response.json())
                .then(data => {
                    new Chart(document.getElementById('tabunganChart'), {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: data.datasets,
                        },
                        options: { responsive: true }
                    });
                });
        });
    </script>
</x-app-layout>
