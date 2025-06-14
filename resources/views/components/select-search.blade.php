@props([
    'data' => [],
    'placeholder' => 'Selecciona una opción',
    'emptyOptionsMessage' => 'Sin resultados para la búsqueda.',
    'text_size' => 'text-base',
    'float'=> false,
])

<div x-data="
        select({
            data: {{ $data }},
            emptyOptionsMessage: '{{ $emptyOptionsMessage }}',
            name: '{{ md5($attributes->wire('model')) }}',
            placeholder: '{{ $placeholder }}',
            value: @entangle($attributes->wire('model'))
            })"
    x-init="init()"
    @click.away="closeListbox()"
    @keydown.escape="closeListbox()"

    class="relative">
    <span class="inline-block w-full rounded-md shadow-sm">
        <button x-ref="button" @click="toggleListboxVisibility()" :aria-expanded="open" aria-haspopup="listbox"
            class="relative {{ $float ? 'h-[55px]' : 'h-10'}} z-0 w-full pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:{{ $text_size }} sm:leading-5">
            <span x-show="! open" x-text="value in options ? options[value] : placeholder"
                :class="{ 'text-gray-500': !(value in options),
                          'pt-0' : !$float ,
                          'pt-5': (value in options) }" class="block truncate {{ $text_size }}"></span>

            <div>
                <input x-ref="search" x-show="open" x-model="search" @keydown.enter.stop.prevent="selectOption()"
                @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()"
                type="search" class="w-full ring-0 border-none focus:ring-0 {{ $text_size }} {{ $float ? 'peer m-0 block bg-clip-padding eading-tight ease-in-out placeholder:text-transparent [&:not(:placeholder-shown)]:pt-[1.625rem] [&:not(:placeholder-shown)]:pb-[0.625rem] px-0 !pb-0 !pt-3' : 'px-0 py-0' }}" />
                <span x-show="open || value" class="{{ $float ? '' : 'hidden' }} pointer-events-none absolute top-0 left-0 origin-[0_0] border-transparent py-4 px-3 text-neutral-700 transition-[opacity,_transform] duration-100 ease-in-out peer-focus:translate-x-[0.15rem] peer-focus:-translate-y-2 peer-focus:scale-[0.85] peer-focus:opacity-[0.65] peer-[:not(:placeholder-shown)]:translate-x-[0.10rem] peer-[:not(:placeholder-shown)]:-translate-y-2 peer-[:not(:placeholder-shown)]:scale-[0.85] peer-[:not(:placeholder-shown)]:opacity-[0.65] motion-reduce:transition-none">
                    {{ $placeholder }}
                </span>
            </div>

            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </span>


        </button>

    </span>


    <div x-show="open" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" x-cloak class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg">
        <ul x-ref="listbox" @keydown.enter.stop.prevent="selectOption()"
            @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()"
            role="listbox" :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
            tabindex="-1"
            class="py-1 overflow-auto {{ $text_size }} leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:{{ $text_size }} sm:leading-5">
            <template x-for="(key, index) in Object.keys(options)" :key="index">
                <li :id="name + 'Option' + focusedOptionIndex" @click="selectOption()"
                    @mouseenter="focusedOptionIndex = index" @mouseleave="focusedOptionIndex = null" role="option"
                    :aria-selected="focusedOptionIndex === index"
                    :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !==
                            focusedOptionIndex }"
                    class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                    <span x-text="Object.values(options)[index]"
                        :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                        class="block font-normal truncate"></span>

                    <span x-show="key === value"
                        :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            </template>

            <div x-show="! Object.keys(options).length" x-text="emptyOptionsMessage"
                class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
        </ul>
    </div>
</div>

<script>
    function select(config) {
        return {
            data: config.data,

            emptyOptionsMessage: config.emptyOptionsMessage ?? 'No results match your search.',

            focusedOptionIndex: null,

            name: config.name,

            open: false,

            options: {},

            placeholder: config.placeholder ?? 'Select an option',

            search: '',

            value: config.value,

            closeListbox: function() {
                this.open = false

                this.focusedOptionIndex = null

                this.search = ''
            },

            focusNextOption: function() {
                if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options)
                    .length - 1

                if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return

                this.focusedOptionIndex++

                this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                    block: "center",
                })
            },

            focusPreviousOption: function() {
                if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0

                if (this.focusedOptionIndex <= 0) return

                this.focusedOptionIndex--

                this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                    block: "center",
                })
            },

            init: function() {
                this.options = this.data

                if (!(this.value in this.options)) this.value = null

                this.$watch('search', ((value) => {
                    if (!this.open || !value) return this.options = this.data

                    this.options = Object.keys(this.data)
                        .filter((key) => this.data[key].toLowerCase().includes(value.toLowerCase()))
                        .reduce((options, key) => {
                            options[key] = this.data[key]
                            return options
                        }, {})
                }))
            },

            selectOption: function() {
                if (!this.open) return this.toggleListboxVisibility()

                this.value = Object.keys(this.options)[this.focusedOptionIndex]

                this.closeListbox()
            },

            toggleListboxVisibility: function() {
                if (this.open) return this.closeListbox()

                this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)

                if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

                this.open = true

                this.$nextTick(() => {
                    this.$refs.search.focus()

                    this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                        block: "center"
                    })
                })
            },
        }
    }
</script>
