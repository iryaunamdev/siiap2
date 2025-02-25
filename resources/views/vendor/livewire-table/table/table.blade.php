<table class="min-w-full divide-y divide-gray-200 dark:divide-none" x-data="{ selected: @entangle('selected') }">
    <thead class="bg-gray-50 dark:bg-gray-800 text-xs">
    <tr class="group">
        @if($this->canSelect())
            <th class="px-5 py-2 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                <input type="checkbox" wire:model.live="selectedPage" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
            </th>
        @endif
        @foreach($table['columns'] as $column)
            @continue(! in_array($column->code(), $this->columns))
            <th class="px-2 py-2 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                {{ $column->renderHeader() }}
            </th>
        @endforeach
    </tr>
    <tr class="group">
        @if($this->canSelect())
            <th class="px-2 py-2 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400"></th>
        @endif
        @foreach($table['columns'] as $column)
            @continue(! in_array($column->code(), $this->columns))
            <th class="px-2 py-2 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                @if($column->isSearchable())
                    {{ $column->renderSearch() }}
                @endif
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-none">
    @if($this->deferLoading && ! $this->initialized)
        <tr class="group bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row">
            <td class="px-2 py-2 whitespace-nowrap" colspan="{{ $table['columns']->count() + 1 }}">
                <span class="block text-base text-center py-20 bg-white text-black dark:bg-neutral-900 dark:text-white">
                    @lang('Fetching records...')
                </span>
            </td>
        </tr>
    @else
        @forelse($paginator->items() as $item)
            <tr class="group bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row"
                wire:key="row-{{ $item->getKey() }}"

                @if($this->isReordering())
                    draggable="true"
                    x-on:dragstart="e => e.dataTransfer.setData('key', '{{ $item->getKey() }}')"
                    x-on:dragover.prevent=""
                    x-on:drop="e => {
                        $wire.call(
                            'reorderItem',
                            e.dataTransfer.getData('key'),
                            '{{ $item->getKey() }}',
                            e.target.offsetHeight / 2 > e.offsetY
                        )
                    }"
                @endif
            >
                @if($this->canSelect())
                    <td class="px-2 py-2 whitespace-nowrap"
                        x-bind:class="~selected.indexOf('{{ $item->getKey() }}')
                                ? 'bg-blue-100 group-odd:bg-blue-100 group-hover:bg-blue-200 dark:bg-blue-900 dark:group-odd:bg-blue-900 dark:group-hover:bg-blue-800'
                                : 'bg-gray-50 group-odd:bg-white group-hover:bg-gray-100 dark:bg-gray-800 dark:group-odd:bg-gray-900 dark:group-hover:bg-gray-700'">
                        <div class="mx-3">
                            <input type="checkbox" wire:model.live="selected" value="{{ $item->getKey() }}" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        </div>
                    </td>
                @endif
                @foreach($table['columns'] as $column)
                    @continue(! in_array($column->code(), $this->columns))
                    <td class="p-0"
                        @if($column->isClickable() && ! $this->isReordering())
                            @if(($link = $this->link($item)) !== null)
                                x-on:click.prevent="window.location.href = '{{ $link }}'"
                            @elseif($this->canSelect())
                                x-on:click="$wire.selectItem('{{ $item->getKey() }}')"
                            @endif
                        @endif
                        x-bind:class="~selected.indexOf('{{ $item->getKey() }}')
                                ? 'select-none cursor-pointer bg-blue-100 group-odd:bg-blue-100 group-hover:bg-blue-200 dark:bg-blue-900 dark:group-odd:bg-blue-900 dark:group-hover:bg-blue-800'
                                : 'select-none cursor-pointer bg-gray-50 group-odd:bg-white group-hover:bg-gray-200 dark:bg-gray-800 dark:group-odd:bg-gray-900 dark:group-hover:bg-gray-700'">
                        {{ $column->render($item) }}
                    </td>
                @endforeach
            </tr>
        @empty
            <tr class="group bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row">
                <td class="px-2 py-2 whitespace-nowrap" colspan="{{ $table['columns']->count() + 1 }}">
                    <span class="block text-lg text-center py-20 bg-white text-black dark:bg-neutral-900 dark:text-white">
                        @lang('No results')
                    </span>
                </td>
            </tr>
        @endforelse
    @endif
    </tbody>
    <tfoot class="border-t border-gray-50 dark:border-neutral-700 text-xs">
    <tr class="group">
        @if($this->canSelect())
            <th class="p-0 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800"></th>
        @endif
        @foreach($table['columns'] as $column)
            @continue(! in_array($column->code(), $this->columns))
            <th class="p-0 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">
                {{ $column->renderFooter() }}
            </th>
        @endforeach
    </tr>
    </tfoot>
</table>
