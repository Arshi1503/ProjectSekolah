<x-app-layout>
    @vite(['resources/js/chart.js'])
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Grid Ringkasan Keuangan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Total Pemasukan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Pemasukan</h3>
                    <p class="text-green-500 text-2xl font-bold">Rp{{ number_format($totalIncome, 0, ',', '.') }}</p>
                    <a href="{{ route('report.index') }}" class="mt-4 px-4 py-2 bg-green-500 text-white rounded-lg block text-center">
                        Tambah Pemasukan
                    </a>
                </div>
                <!-- Total Pengeluaran -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Pengeluaran</h3>
                    <p class="text-red-500 text-2xl font-bold">Rp{{ number_format($totalExpense, 0, ',', '.') }}</p>
                    <a href="{{ route('report.index') }}" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg block text-center">
                        Tambah Pengeluaran
                    </a>
                </div>
                <!-- Saldo Akhir -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Saldo Akhir</h3>
                    <p class="text-blue-500 text-2xl font-bold">Rp{{ number_format($totalBalance, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Grafik Statistik -->
            <div class="max-w-7xl mx-auto mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Statistik Tabungan') }}
                    </h3>
                    <div class="w-full relative overflow-hidden h-96">
                        <canvas id="tabunganChart" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>

            <!-- History Laporan -->
            <div class="bg-white dark:bg-gray-800 p-6 mt-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 dark:text-gray-200">Riwayat Laporan Terbaru</h3>

                <!-- Untuk Desktop -->
                <div class="hidden md:block">
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
                                    <td class="border px-4 py-2 border-gray-300 dark:border-gray-600 dark:text-gray-200">
                                        {{ $report->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="border px-4 py-2 border-gray-300 dark:border-gray-600 dark:text-gray-200">
                                        {{ ucfirst($report->type) }}
                                    </td>
                                    <td class="border px-4 py-2 border-gray-300 dark:border-gray-600 dark:text-gray-200">
                                        Rp{{ number_format($report->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Untuk Mobile -->
                <div class="md:hidden space-y-4">
                    @foreach ($recentReports as $report)
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $report->created_at->format('d/m/Y') }}</p>
                            <p class="text-lg font-semibold dark:text-gray-100">{{ ucfirst($report->type) }}</p>
                            <p class="text-lg font-bold {{ $report->type == 'income' ? 'text-green-500' : 'text-red-500' }}">
                                Rp{{ number_format($report->amount, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <!-- Link ke Semua Laporan -->
                <div class="mt-4 text-center">
                    <a href="{{ route('report.index') }}" class="text-blue-500">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
