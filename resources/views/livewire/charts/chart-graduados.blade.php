<div class="grid grid-cols-2 gap-4">
    <div class="bg-white p-6 rounded-lg shadow-md chart-container">
    @include('livewire.charts.graduados-semestre')
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md chart-container">
    @include('livewire.charts.graduados-adscripcion')
    </div>

    <div class="col-span-1 bg-white p-6 rounded-lg shadow-md chart-container">
    @include('livewire.charts.graduados-m-adscripcion')
    </div>
    <div class="col-span-1 bg-white p-6 rounded-lg shadow-md chart-container">
    @include('livewire.charts.graduados-d-adscripcion')
    </div>
</div>
