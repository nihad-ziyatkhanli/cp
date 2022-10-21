<x-alpine.basic-modal>
    <x-alpine.confirm-deletion>

        <div class="py-2 max-w-7xl mx-auto sm:px-1 lg:px-2">

            @if ($success)
                <div class="flex flex-col justify-center">
                    <div class="alert alert-dismissible fade show bg-green-500 shadow-lg mx-auto w-1/2 max-w-full text-sm pointer-events-auto bg-clip-padding rounded-lg block mb-3" id="static-example" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                        <div class="bg-green-500 flex justify-between items-center py-2 px-3 bg-clip-padding border-b border-green-400 rounded-t-lg">
                            <p class="font-bold text-white flex items-center">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                            </svg>
                            Success</p>
                            <div class="flex items-center">
                            <button type="button" class="btn-close btn-close-white box-content w-4 h-4 ml-2 text-white border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-white hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="p-3 bg-green-500 rounded-b-lg break-words text-white">
                            The record is deleted successfully.
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex space-x-2 justify-end mb-3">
                <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Search</button>
                <a href="{{ route($mi_code.'.create') }}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Create</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table min-w-full">
                    <thead>
                    <tr>
                        <th wire:click="sortBy('title')" class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                            Title
                            @if ($sortBy == 'title')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('code')" class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                            Code
                            @if ($sortBy == 'code')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('rank')" class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                            Rank
                            @if ($sortBy == 'rank')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('status')" class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                            Status
                            @if ($sortBy == 'status')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('created_at')" class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                            Date
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
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">
                            <input wire:model.debounce.500ms="searchColumns.title" type="text" placeholder="Search..."
                                class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400" />
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5"></td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5"></td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5"></td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5"></td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5"></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">{{ $role->title }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">{{ $role->code }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">{{ $role->rank }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">{{ $role->status }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">{{ $role->created_at ?? 'n/a' }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400 text-sm leading-5">
                                @canany(['update', 'delete'], $role)
                                    <div class="flex space-x-2 justify-center">
                                        <div>
                                            @can('update', $role)
                                                <a href="{{ route($mi_code.'.update', ['id' => $role->id]) }}" class="inline-block px-6 py-2.5 bg-yellow-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-700 hover:shadow-lg focus:bg-yellow-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out">{{ __('Update') }}</a>
                                            @endcan
                                            @can('delete', $role)
                                                <button x-on:click="openModalAsDelete({{ $role->id }})" type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">{{ __('Delete') }}</button>
                                            @endcan
                                        </div>
                                    </div>
                                @endcanany
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ $roles->links() }}

        </div>
    </x-alpine.confirm-deletion>
</x-alpine.with-basic-modal>
