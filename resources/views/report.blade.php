<x-app-layout>
    <x-slot name="title">
      Report
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Masukkan Jumlah Pemasukan') }}
                            </h2>
                        
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Tolong isi jumlah pemasukan dengan format angka') }}
                            </p>
                        </header>

                        {{-- <form method="post" action="{{ route('report.store')}}" class="mt-6 space-y-6"> --}}

                            <div>

                            </div>
                        </form>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>