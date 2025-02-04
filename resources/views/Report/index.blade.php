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

    <div class="py-12 mt-4">
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
            
                <!-- Tabel (Hanya muncul di layar medium ke atas) -->
                <div class="overflow-x-auto hidden md:block">
                    <table class="min-w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-nowrap">{{ __('Tanggal') }}</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-nowrap">{{ __('Proses') }}</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-nowrap">{{ __('Jumlah') }}</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 w-8 text-nowrap">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr class="bg-white dark:bg-gray-800">
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-nowrap">
                                        {{ $report->created_at->format('l/m/Y') }}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-nowrap">
                                        {{ ucfirst($report->type) }}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-nowrap">
                                        Rp{{ number_format($report->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-nowrap">
                                        <form action="{{ route('report.destroy', $report) }}" method="POST" class="inline w-8">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit">
                                                {{ __('Erase') }}
                                            </x-danger-button>
                                        </form>
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
                </div>
            
                <!-- Card View (Hanya muncul di layar kecil) -->
                <div class="block md:hidden space-y-4">
                    @forelse ($reports as $report)
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $report->created_at->format('l, d M Y') }}</p>
                            <p class="text-lg font-semibold">{{ ucfirst($report->type) }}</p>
                            <p class="text-lg text-blue-500 font-bold">Rp{{ number_format($report->amount, 0, ',', '.') }}</p>
                            <form action="{{ route('report.destroy', $report) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <x-danger-button type="submit">
                                    {{ __('Erase') }}
                                </x-danger-button>
                            </form>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 dark:text-gray-400">{{ __('Belum ada laporan.') }}</p>
                    @endforelse
                </div>
            
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $reports->links() }}
                </div>
            </div>
               
        </div>
    </div>
</x-app-layout>
