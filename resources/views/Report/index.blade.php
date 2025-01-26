<x-app-layout>
    <head>
        @vite('resources/js/alert.js')
        @if (session('success'))
            <script>
                sessionStorage.setItem('success', true);
            </script>
        @endif
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>

    <div class="py-12 m-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('Laporan') }}
                </h3>
                <form action="{{ route('report.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="amount" :value="__('Jumlah')" />
                        <x-text-input id="amount" name="amount" type="number"
                            class="mt-1 block w-full [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            :value="old('amount')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                    </div>
                    <div class="mb-4 w-40">
                        <x-input-label for="type" :value="__('Proses')" />
                        <select id="type" name="type"
                            class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-700">
                            <option value="" disabled selected>{{ __('Pilih Proses') }}</option>
                            <option value="income">{{ __('Pemasukan') }}</option>
                            <option value="expense">{{ __('Pengeluaran') }}</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>
                    <x-primary-button class="mt-4">
                        {{ __('Simpan Laporan') }}
                    </x-primary-button>
                </form>
            </div>

            <!-- Tabel History -->
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-sm sm:rounded-lg p-6 mt-8">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('History Laporan') }}
                </h3>
                <table class="w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ __('Tanggal') }}</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ __('Proses') }}</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ __('Jumlah') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    {{ $report->created_at->format('l/m/Y') }}
                                </td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    {{ ucfirst($report->type) }}
                                </td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    Rp{{ number_format($report->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 dark:text-gray-400 px-4 py-2">
                                    {{ __('Belum ada laporan.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
