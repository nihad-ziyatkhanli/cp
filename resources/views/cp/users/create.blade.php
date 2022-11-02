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

    <x-tailwind.loading wire:loading />

    <div class="py-2 max-w-7xl mx-auto sm:px-1 lg:px-2">

        <div class="block p-6 mx-auto rounded-lg shadow-lg bg-white w-3/4">
            <form wire:submit.prevent="save">

                <div class="grid grid-cols-12 gap-x-5">
                    <div class="form-group mb-6 col-span-6">
                        <label for="name" class="form-label inline-block mb-2 text-gray-700">{{ __('Name') }}</label>
                        <input wire:model.defer="user.name" type="text" id="name" placeholder="{{ __('Name') }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('user.name') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-6 col-span-6">
                        <label for="email" class="form-label inline-block mb-2 text-gray-700">{{ __('Email') }}</label>
                        <input wire:model.defer="user.email" type="text" id="email" placeholder="{{ __('Email') }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('user.email') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-6 col-span-6">
                        <label for="password" class="form-label inline-block mb-2 text-gray-700">{{ __('Password') }}</label>
                        <input wire:model.defer="password" type="password" min="1" id="password" placeholder="{{ __('Password') }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('password') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-6 col-span-6">
                        <label for="status" class="form-label inline-block mb-2 text-gray-700">{{ __('Status') }}</label>
                        <select wire:model.defer="user.status" id="status" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">{{ __('Select') }}</option>
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Passive') }}</option>
                        </select>
                        @error('user.status') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-6 col-span-6">
                        <label for="role_ids" class="form-label inline-block mb-2 text-gray-700">{{ __('Roles') }}</label>
                        <select wire:model.defer="role_ids" id="role_ids" multiple class="form-multi-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option disabled>{{ __('Select') }}</option>
                            @foreach ($assignables as $role)
                                <option value="{{ $role->id }}">{{ __($role->title) }}</option>
                            @endforeach
                        </select>
                        @error('role_ids') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                        @error('role_ids.*') <span class="block mt-1 text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <hr class="mb-6 h-0 border border-solid border-t-0 border-gray-700 opacity-25 col-span-12">

                    <div class="form-group mb-6 col-span-12">
                        <a data-mdb-ripple="true" data-mdb-ripple-color="light" href="{{ route($mi_code) }}" class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">
                            {{ __('Cancel') }}
                        </a>
                        <button data-mdb-ripple="true" data-mdb-ripple-color="light" type="submit"
                        class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
