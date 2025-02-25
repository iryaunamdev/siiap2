<div
    x-data="{
        messages: [],
        remove(message) {
            this.messages.splice(this.messages.indexOf(message), 1)
        },
    }"
    @notify.window="let message = $event.detail; messages.push(message); setTimeout(() => { remove(message) }, 5000)"
    class="fixed inset-0 z-[99] flex flex-col items-end justify-center px-4 py-6 space-y-4 pointer-events-none sm:p-6 sm:justify-start"
>
    <template x-for="(message, messageIndex) in messages" :key="messageIndex" hidden>
        <div
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="w-full max-w-md bg-white rounded-lg shadow-lg pointer-events-auto"
        >
            <div
                  :class="{
                    'ring-green-500': message[0].type === 'success',
                    'ring-red-500': message[0].type === 'error',
                    'ring-blue-500': message[0].type === 'info',
                    'ring-yellow-500': message.[0].type === 'warning',
                    'ring-gray-200': message.[0].type === '',
                }"

                class="w-full max-w-md overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-opacity-50 ring-gray-200"


            >
            <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg x-show="message[0].type === 'success'" class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <svg x-show="message[0].type === 'error'" class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <svg x-show="message[0].type === 'info'" class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <svg x-show="message[0].type === 'warning'" class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                            </svg>
                        </div>

                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p x-text="message[0].title" class="font-medium text-md"
                                :class="{
                                    'text-green-600': message[0].type === 'success',
                                    'text-red-600': message[0].type === 'error',
                                    'text-blue-600': message[0].type === 'info',
                                    'text-yellow-600': message.[0].type === 'warning',
                                    'text-gray-600': message.[0].type === '',
                                }"
                            ></p>
                            <p x-text="message[0].message" class="mt-1 text-sm text-gray-500"></p>
                        </div>
                        <div class="flex flex-shrink-0 ml-4">
                            <button @click="remove(message)" class="inline-flex text-gray-400 transition duration-150 ease-in-out focus:outline-none focus:text-gray-500">
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
