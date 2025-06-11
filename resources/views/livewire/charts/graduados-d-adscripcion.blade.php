<h3 class="font-bold mb-2">Estudiantes Graduados de doctorado (por adscripción)</h3>
<canvas wire:ignore id="myChart4"></canvas>

<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('myChart4');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_values($labels_semestres)) !!},
                datasets: [
                     {
                        label: 'FC-UNAM',
                        data: {!! json_encode(array_values($FC_UNAM['D'])) !!},
                        backgroundColor: 'rgba(254, 230, 133, 0.5)',
                        borderColor: 'rgb(254, 230, 133)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(254, 230, 133)',
                        pointBackgroundColor: 'rgba(254, 230, 133, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(254, 230, 133)',
                        borderWidth: 1
                    },
                    {
                        label: 'IA-CU',
                        data: {!! json_encode(array_values($IA_CU['D'])) !!},
                        backgroundColor: 'rgba(208, 135, 0, 0.5)',
                        borderColor: 'rgb(208, 135, 0)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(208, 135, 0)',
                        pointBackgroundColor: 'rgba(208, 135, 0, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(208, 135, 0)',
                        borderWidth: 1
                    },
                    {
                        label: 'IA-ENS',
                        data: {!! json_encode(array_values($IA_ENS['D'])) !!},
                        backgroundColor: 'rgba(255, 185, 0, 0.5)',
                        borderColor: 'rgb(255, 185, 0)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(255, 185, 0)',
                        pointBackgroundColor: 'rgba(255, 185, 0, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(255, 185, 0)',
                        borderWidth: 1
                    },
                    {
                        label: 'ICF',
                        data: {!! json_encode(array_values($ICF['D'])) !!},
                        backgroundColor: 'rgba(255, 210, 48, 0.5)',
                        borderColor: 'rgb(255, 210, 48)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(255, 210, 48)',
                        pointBackgroundColor: 'rgba(255, 210, 48, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(255, 210, 48)',
                        borderWidth: 1
                    },
                    {
                        label: 'ICN',
                        data: {!! json_encode(array_values($ICN['D'])) !!},
                        backgroundColor: 'rgba(254, 230, 133, 0.5)',
                        borderColor: 'rgb(254, 230, 133)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(254, 230, 133)',
                        pointBackgroundColor: 'rgba(254, 230, 133, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(254, 230, 133)',
                        borderWidth: 1
                    },
                    {
                        label: 'IF',
                        data: {!! json_encode(array_values($IF['D'])) !!},
                        backgroundColor: 'rgba(254, 252, 232, 0.5)',
                        borderColor: 'rgb(254, 252, 232)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(254, 252, 232)',
                        pointBackgroundColor: 'rgba(254, 252, 232, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(254, 252, 232)',
                        borderWidth: 1
                    },
                    {
                        label: 'IRyA',
                        data: {!! json_encode(array_values($IRyA['D'])) !!},
                        backgroundColor: 'rgba(240, 177, 0, 0.5)',
                        borderColor: 'rgb(240, 177, 0)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(240, 177, 0)',
                        pointBackgroundColor: 'rgba(240, 177, 0, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(240, 177, 0)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total',
                        data: {!! json_encode(array_values($graduados_d_s)) !!},
                        backgroundColor: 'rgba(248, 250, 252, 0.5)',
                        borderColor: 'rgb(202, 213, 226)',
                        tension: 0.1,
                        fill:true,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(202, 213, 226)',
                        pointBackgroundColor: 'rgba(248, 250, 252, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(202, 213, 226)',
                        borderWidth: 1
                    },
                ],
            },

            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',

                    },
                },
            }
        });
    });
</script>
