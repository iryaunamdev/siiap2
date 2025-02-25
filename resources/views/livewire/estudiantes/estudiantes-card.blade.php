<div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
        <li class="me-2">
            <button id="mae-tab" data-tabs-target="#mae" type="button" role="tab" aria-controls="mae" aria-selected="true" class="inline-block p-4 text-blue-600 rounded-ss-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">Maestría</button>
        </li>
        <li class="me-2">
            <button id="hist-acad-tab" data-tabs-target="#hist-acad" type="button" role="tab" aria-controls="hist-acad" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Historial Académico</button>
        </li>
        <li class="me-2">
            <button id="doc-tab" data-tabs-target="#doc" type="button" role="tab" aria-controls="doc" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Doctorado</button>
        </li>
        <li class="me-2">
            <button id="seg-acad-tab" data-tabs-target="#seg-acad" type="button" role="tab" aria-controls="seg-acad" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Seguimiento académico</button>
        </li>
    </ul>
    <div id="defaultTabContent">
        <!-- Maestría -->
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="mae" role="tabpanel" aria-labelledby="mae-tab">
            @if ($estudiante)
                <!-- Ingreso -->
                <livewire:estudiantes.estudiantes-ingresos :estudiante="$estudiante" :grado=1>
                <!-- Graduacion/Baja -->
                <livewire:estudiantes.estudiantes-graduaciones-bajas :estudiante="$estudiante" :grado=1>
                <!-- Inscripciones -->
                <livewire:estudiantes.estudiantes-inscripciones :estudiante="$estudiante" :grado=1>
            @else
                <div class="italic text-xs text-gray-400 p-2">No hay registro de estudiante.</div>
            @endif
        </div>

        <!-- Seguimiento académico -->
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="hist-acad" role="tabpanel" aria-labelledby="hist-acad-tab">
            @include('livewire.estudiantes.estudiantes-accordion-historial-academico')
        </div>

        <!-- Doctorado -->
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="doc" role="tabpanel" aria-labelledby="doc-tab">
            @if ($estudiante)
                <!-- Ingreso -->
                <livewire:estudiantes.estudiantes-ingresos :estudiante="$estudiante" :grado=0>
                <!-- Graduacion/Baja -->
                <livewire:estudiantes.estudiantes-graduaciones-bajas :estudiante="$estudiante" :grado=0>
                <!-- Inscripciones -->
                 <livewire:estudiantes.estudiantes-inscripciones :estudiante="$estudiante" :grado=0>
            @else
                <div class="italic text-xs text-gray-400 p-2">No hay registro de estudiante.</div>
            @endif
        </div>

        <!-- Seguimiento académico -->
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="seg-acad" role="tabpanel" aria-labelledby="seg-acad-tab">
            @if($estudiante)
                <livewire:estudiantes.estudiantes-seguimientos :estudiante="$estudiante">
            @else
                <div class="italic text-xs text-gray-400 p-2">No hay registro de estudiante.</div>
            @endif
        </div>
    </div>
</div>

