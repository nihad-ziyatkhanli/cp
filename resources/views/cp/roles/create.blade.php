<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-1 px-4 sm:px-6 lg:px-8">
            <nav class="px-5 py-1 rounded-md w-full">
                <ol class="list-reset flex">
                    <li><a href="{{ route($mi_code) }}" class="text-blue-600 hover:text-blue-700">{{ __($mi_title) }}</a></li>
                    <li><span class="text-gray-500 mx-2">/</span></li>
                    <li><span class="text-gray-500">{{ __('Create') }}</span></li>
                </ol>
            </nav>
        </div>
    </header>

    <div wire:loading class="fixed z-50">
        <x-tailwind.loading/>
    </div>

    <div class="py-2 max-w-7xl mx-auto sm:px-1 lg:px-2">

        <div class="block p-6 mx-auto rounded-lg shadow-lg bg-white w-3/4">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-2 gap-20">
                    <div class="col-span-1">
                        <div class="form-group mb-6">
                            <label for="title" class="form-label inline-block mb-2 text-gray-700">{{ __('Title') }}</label>
                            <input wire:model.defer="role.title" type="text" id="title" placeholder="{{ __('Title') }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            @error('role.title') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-6">
                            <label for="code" class="form-label inline-block mb-2 text-gray-700">{{ __('Code') }}</label>
                            <input wire:model.defer="role.code" type="text" id="code" placeholder="{{ __('Code') }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            @error('role.code') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-6">
                            <label for="rank" class="form-label inline-block mb-2 text-gray-700">{{ __('Rank') }}</label>
                            <input wire:model.defer="role.rank" type="number" min="1" id="rank" placeholder="{{ __('Rank') }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            @error('role.rank') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-6">
                            <label for="status" class="form-label inline-block mb-2 text-gray-700">{{ __('Status') }}</label>
                            <select wire:model.defer="role.status" id="status" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">{{ __('Select') }}</option>
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Passive') }}</option>
                            </select>
                            @error('role.status') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <hr class="mb-6 h-0 border border-solid border-t-0 border-gray-700 opacity-25">
                        <div class="form-group mb-6">
                            <a data-mdb-ripple="true" data-mdb-ripple-color="light" href="{{ route($mi_code) }}" class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">
                                {{ __('Cancel') }}
                            </a>
                            <button wire:loading.attr="disabled" data-mdb-ripple="true" data-mdb-ripple-color="light" type="submit"
                            class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-span-1 overflow-auto h-96 px-2">
                        <div class="form-group mb-3">
                            <span class="form-label inline-block text-gray-700">{{ __('Permissions') }}</span>
                        </div>
                        <div class="form-group form-check mb-3 mx-1">
                            <input wire:model.debounce.400ms="checkAll" value="{{ $checkAll }}" type="checkbox" id="checkAll"
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer">
                            <label for="checkAll" class="form-check-label inline-block text-gray-800">{{ __('Check All') }}</label>
                        </div>
                        @foreach (config('cp.permissions') as $code => $title)
                            <div class="form-group form-check mb-1">
                                <input wire:model.defer="role.permissions" value="{{ $code }}" type="checkbox" id="{{ $code }}"
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer">
                                <label for="{{ $code }}" class="form-check-label inline-block text-gray-800">{{ __($title) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
