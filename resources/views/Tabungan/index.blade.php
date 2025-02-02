<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tabungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('Statistik Tabungan') }}
                </h3>
                <div class="w-full relative overflow-hidden h-96">
                    <canvas id="tabunganChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/js/chart.js'])
</x-app-layout>
