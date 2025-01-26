<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('Add Report') }}
                </h3>
                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="amount" :value="__('Amount')" />
                        <x-text-input id="amount" name="amount" type="number" class="mt-1 block w-full [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            :value="old('amount')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="type" :value="__('Type')" />
                        <select id="type" name="type" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-700">
                            <option value="" disabled selected>{{ __('Select Type') }}</option>
                            <option value="income">{{ __('Income') }}</option>
                            <option value="expense">{{ __('Expense') }}</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>

                    {{-- 
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                            :value="old('description')" />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div> --}}

                    <x-primary-button class="mt-4">
                        {{ __('Save Report') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
