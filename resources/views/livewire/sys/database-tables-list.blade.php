
<div>
    @foreach($schemas as $dbName => $tables)
    {{ strtoupper($dbName) }} Database {{ count($tables) }} tables<br>
        @forelse($tables as $table)
            {{ $table['name'] }}<br>
            @foreach($table['columns'] as $column)
                {{ $column['name']  .';'. $column['type']}} <br>
            @endforeach
        @empty
        @endforelse
    @endforeach
</div>
{{--<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Comparacion de Bases de datos SIIAP/SIIPA</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($schemas as $dbName => $tables)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-indigo-600 p-4">
                    <h2 class="text-white text-xl font-bold uppercase">
                        {{ strtoupper($dbName) }} Database
                    </h2>
                    <p class="text-indigo-200 mt-1">
                        {{ count($tables) }} Tables
                    </p>
                </div>

                <div class="p-6 space-y-6">
                    @forelse($tables as $table)
                        <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ $table['name'] }}
                                </h3>

                            </div>

                            <div class="space-y-2">
                                @foreach($table['columns'] as $column)
                                    <div class="flex justify-between items-center text-sm">
                                        <div class="flex items-center">
                                            <span class="font-mono text-gray-600">{{ $column['name'] }}</span>

                                        </div>
                                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-md">
                                            {{ $column['type'] }}

                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-4 text-gray-500">
                            No tables found in this database
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>
--}}
