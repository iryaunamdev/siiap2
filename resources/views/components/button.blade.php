<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-400 focus:ring-offset-1 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

