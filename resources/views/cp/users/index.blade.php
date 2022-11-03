<x-alpine.basic-modal>
    <x-alpine.confirm-deletion>

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-1 px-4 sm:px-6 lg:px-8">
                <nav class="px-5 py-1 rounded-md w-full">
                    <ol class="list-reset flex">
                        <li><span class="text-gray-800">{{ $mi_title }}</span></li>
                    </ol>
                </nav>
            </div>
        </header>

        <div class="py-2 max-w-7xl mx-auto sm:px-1 lg:px-2">

            @if(session('success'))
                <x-alpine.disappear :class="'fixed top-3 right-5 w-1/3'">
                    <div class="alert alert-dismissible fade show bg-green-500 shadow-lg max-w-full pointer-events-auto bg-clip-padding rounded-lg block mb-3" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                        <div class="bg-green-500 flex justify-between items-center py-2 px-3 bg-clip-padding border-b border-green-400 rounded-t-lg">
                            <p class="font-bold text-white flex items-center">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                                </svg>
                                {{ __('Success') }}
                            </p>
                            <div class="flex items-center">
                                <button type="button" class="btn-close btn-close-white box-content w-4 h-4 ml-2 text-white border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-white hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="p-3 bg-green-500 rounded-b-lg break-words text-white">
                            {{ session('success') }}
                        </div>
                    </div>
                </x-alpine.disappear>
            @endif

            <div class="flex space-x-2 justify-between mb-3">
                <div>
                    <div class="input-group relative flex flex-wrap items-stretch w-full">
                        <input disabled type="search" class="bg-gray-300 form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="search">
                        <button class="btn inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="button" id="search">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">{{ __('Advanced Search') }}</button>
                    @can('create_users')
                        <a href="{{ route($mi_code.'.create') }}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">{{ __('Create') }}</a>
                    @endcan
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table min-w-full">
                    <thead>
                        <tr>
                            <th wire:click="sortBy('name')" class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                {{ __('Name') }}
                                @if ($sortBy == 'name')
                                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                @else
                                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('email')" class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                {{ __('Email') }}
                                @if ($sortBy == 'email')
                                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                @else
                                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('status')" class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                {{ __('Status') }}
                                @if ($sortBy == 'status')
                                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                @else
                                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('created_at')" class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                {{ __('Created at') }}
                                @if ($sortBy == 'created_at')
                                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                @else
                                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                @endif
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                            </th>
                        </tr>
                        <tr>
                            <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">
                                <input wire:model.debounce.500ms="searchColumns.name" type="text" placeholder="{{ __('Search...') }}"
                                    class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400" />
                            </td>
                            <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5"></td>
                            <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5"></td>
                            <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5"></td>
                            <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">{{ $user->name }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">{{ $user->email }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">{{ $user->status }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">{{ $user->created_at?->format('Y-m-d') ?? __('n/a') }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">
                                    @canany(['update', 'delete'], $user)
                                        <div class="flex justify-center">
                                            <div>
                                                <div class="dropdown relative">
                                                    <button class="dropdown-toggle px-1 py-2.5 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-500 hover:shadow-lg focus:bg-gray-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-600 active:shadow-lg active:text-white transition duration-150 ease-in-out flex items-center whitespace-nowrap"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" class="w-2 mx-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                            <path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                                                        </svg>
                                                    </button>
                                                    <ul class="dropdown-menu min-w-full absolute hidden bg-white text-base z-50 float-left overflow-hidden list-none text-left rounded shadow-lg mt-1 m-0 bg-clip-padding border-none">
                                                        @can('update', $user)
                                                            <li>
                                                                <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                                                href="{{ route($mi_code.'.update', ['id' => $user->id]) }}" type="button">{{ __('Update') }}</a>
                                                            </li>
                                                        @endcan
                                                        @can('delete', $user)
                                                            <li>
                                                                <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                                                x-on:click="openModalAsDelete({{ $user->id }})" href="#" type="button">{{ __('Delete') }}</a>
                                                            </li>
                                                        @endcan
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endcanany
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $users->links() }}

        </div>
    </x-alpine.confirm-deletion>
</x-alpine.with-basic-modal>
