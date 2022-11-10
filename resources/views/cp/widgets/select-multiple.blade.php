<div x-data="{
    show: false,
}">
    <div class="relative grow" x-on:click="show=true" x-on:click.outside="show=false">
        @if ($this->dropdown['selected']->isNotEmpty())
            <div>
                @foreach($this->dropdown['selected'] as $obj)
                    <button wire:click="toggle({{ $obj->id }})" type="button" class="inline-flex items-center my-1 px-3 py-1 bg-yellow-500 text-white font-medium text-sm rounded-full shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">{{ $obj->{$conf->text} }}
                        <x-tailwind.close />
                    </button>
                @endforeach
            </div>
        @endif
        <input wire:model.debounce.1000="search" id="{{ $conf->name }}"
            type="search"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Select" />

        <ul x-show="show" x-cloak x-transition.duration.400ms class="min-w-full absolute bg-white text-base z-50 float-left overflow-hidden list-none text-left rounded-lg shadow-lg mt-1 m-0 bg-clip-padding border-none">
            @if ($this->dropdown['options']->isNotEmpty())
                @foreach ($this->dropdown['options'] as $option)
                    <li>
                        <span wire:click="toggle({{ $option->id }})"
                            class="{{ $this->dropdown['selected']->contains($option) ? 'bg-gray-200' : 'bg-transparent' }} block text-sm cursor-pointer py-2 px-4 font-normal block w-full whitespace-nowrap text-gray-700 hover:bg-gray-100">
                            {{ $option->{$conf->text} }}
                        </span>
                    </li>
                @endforeach
                <li>
                    <span wire:click="increment"
                        class="{{ $this->dropdown['hasMore'] ? '' : 'hidden' }} block text-sm text-center cursor-pointer py-2 px-4 font-normal block w-full whitespace-nowrap text-gray-700 bg-blue-100 hover:bg-blue-200">
                        {{ __('Load More') }}
                    </span>
                </li>
            @else
                <li>
                    <span class="block text-sm uppercase cursor-text py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-500">
                        {{ __('No Results') }}
                    </span>
                </li>
            @endif
        </ul>
    </div>
</div>
