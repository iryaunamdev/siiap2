<div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
        <li class="me-2">
            <button id="tutorias-tab" data-tabs-target="#tutorias" type="button" role="tab" aria-controls="tutorias" aria-selected="true" class="inline-block p-4 text-blue-600 rounded-ss-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">Tutorías</button>
        </li>
        <li class="me-2">
            <button id="act-acad-tab" data-tabs-target="#act-acad" type="button" role="tab" aria-controls="act-acad" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Actividad académica</button>
        </li>
        <li class="me-2">
            <button id="doc-tab" data-tabs-target="#doc" type="button" role="tab" aria-controls="doc" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Docencia</button>
        </li>
    </ul>
    <div id="defaultTabContent">
        <!-- Tutorias -->
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="tutorias" role="tabpanel" aria-labelledby="tutorias-tab">
           @if($tutor)
                @include('livewire.tutores.tutores-accordion-ct-m')
                @include('livewire.tutores.tutores-accordion-ct-d')
           @else
                <div class="italic text-xs text-gray-400 p-2">No hay registro de tutor.</div>
           @endif
        </div>

        <!-- Actividad académica -->
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="act-acad" role="tabpanel" aria-labelledby="act-acad-tab">
            @if($tutor)
                @include('livewire.tutores.tutores-accordion-graduados-m')
                @include('livewire.tutores.tutores-accordion-graduados-d')
                @include('livewire.tutores.tutores-accordion-seguimientos')
            @else
            <div class="italic text-xs text-gray-400 p-2">No hay registro de tutor.</div>
            @endif
        </div>

        <!-- Docencia -->
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="doc" role="tabpanel" aria-labelledby="doc-tab">
            @if($tutor)
                @include('livewire.tutores.tutores-accordion-clases-m')
                @include('livewire.tutores.tutores-accordion-clases-p')
            @else
                <div class="italic text-xs text-gray-400 p-2">No hay registro de tutor.</div>
            @endif
        </div>
    </div>
</div>

