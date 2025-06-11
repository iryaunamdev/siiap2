<h3 class="font-bold mb-2">Estudiantes Graduados (por Adscripción)</h3>
<canvas wire:ignore id="myChart2"></canvas>

<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('myChart2');
        const myChart = new Chart(ctx, {
            type: 'line',
            data:{
                labels: {!! json_encode(array_values($labels_semestres)) !!},
                datasets: [
                    {
                        label: 'FC-UNAM',
                        data: {!! json_encode(array_values($FC_UNAM['T'])) !!},
                        backgroundColor: 'rgba(248, 250, 252, 0.5)',
                        borderColor: 'rgb(202, 213, 226)',
                        tension: 0.1,
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
                    {
                        label: 'IA-CU',
                        data: {!! json_encode(array_values($IA_CU['T'])) !!},
                        backgroundColor: 'rgba(255, 162, 162, 0.5)',
                        borderColor: 'rgb(255, 162, 162)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(255, 162, 162)',
                        pointBackgroundColor: 'rgba(255, 162, 162, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(255, 162, 162)',
                        borderWidth: 1
                    },
                    {
                        label: 'IA-ENS',
                        data: {!! json_encode(array_values($IA_ENS['T'])) !!},
                        backgroundColor: 'rgba(194, 122, 255, 0.5)',
                        borderColor: 'rgb(194, 122, 255)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(194, 122, 255)',
                        pointBackgroundColor: 'rgba(194, 122, 255, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(194, 122, 255)',
                        borderWidth: 1
                    },
                    {
                        label: 'ICF',
                        data: {!! json_encode(array_values($ICF['T'])) !!},
                        backgroundColor: 'rgba(83, 234, 253, 0.1)',
                        borderColor: 'rgb(83, 234, 253)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(83, 234, 253)',
                        pointBackgroundColor: 'rgba(83, 234, 253, 0.1)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(83, 234, 253)',
                        borderWidth: 1
                    },
                    {
                        label: 'ICN',
                        data: {!! json_encode(array_values($ICN['T'])) !!},
                        backgroundColor: 'rgba(240, 177, 0, 0.1)',
                        borderColor: 'rgb(240, 177, 0)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(240, 177, 0)',
                        pointBackgroundColor: 'rgba(240, 177, 0, 0.1)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(240, 177, 0)',
                        borderWidth: 1
                    },
                    {
                        label: 'IF',
                        data: {!! json_encode(array_values($IF['T'])) !!},
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        borderColor: 'rgb(34, 197, 94)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(34, 197, 94)',
                        pointBackgroundColor: 'rgba(34, 197, 94, 0.1)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(34, 197, 94)',
                        borderWidth: 1
                    },
                    {
                        label: 'IRyA',
                        data: {!! json_encode(array_values($IRyA['T'])) !!},
                        backgroundColor: 'rgba(20, 71, 230, 0.1)',
                        borderColor: 'rgb(20, 71, 230)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(20, 71, 230)',
                        pointBackgroundColor: 'rgba(20, 71, 230, 0.1)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(20, 71, 230)',
                        borderWidth: 1
                    }
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
