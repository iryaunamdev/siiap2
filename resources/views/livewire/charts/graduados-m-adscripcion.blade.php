<h3 class="font-bold mb-2">Estudiantes Graduados de maestría (por adscripción)</h3>
<canvas wire:ignore id="myChart3"></canvas>

<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('myChart3');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_values($labels_semestres)) !!},
                datasets: [
                    {
                        label: 'FC-UNAM',
                        data: {!! json_encode(array_values($FC_UNAM['M'])) !!},
                        backgroundColor: 'rgba(21, 93, 252, 0.1)',
                        borderColor: 'rgba(21, 93, 252, 0.3)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgba(21, 93, 252, 0.3)',
                        pointBackgroundColor: 'rgba(21, 93, 252, 0.1)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgba(21, 93, 252. 0.3)',
                        borderWidth: 1
                    },
                    {
                        label: 'IA-CU',
                        data: {!! json_encode(array_values($IA_CU['M'])) !!},
                        backgroundColor: 'rgba(0, 105, 168, 0.5)',
                        borderColor: 'rgb(0, 105, 168)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(0, 105, 168)',
                        pointBackgroundColor: 'rgba(0, 105, 168, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(0, 105, 168)',
                        borderWidth: 1
                    },
                    {
                        label: 'IA-ENS',
                        data: {!! json_encode(array_values($IA_ENS['M'])) !!},
                        backgroundColor: 'rgba(0, 184, 219, 0.5)',
                        borderColor: 'rgb(0, 184, 219)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(0, 184, 219)',
                        pointBackgroundColor: 'rgba(0, 184, 219, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(0, 184, 219)',
                        borderWidth: 1
                    },
                    {
                        label: 'ICF',
                        data: {!! json_encode(array_values($ICF['M'])) !!},
                        backgroundColor: 'rgba(81, 162, 255, 0.5)',
                        borderColor: 'rgb(81, 162, 255)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(81, 162, 255)',
                        pointBackgroundColor: 'rgba(81, 162, 255, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(81, 162, 255)',
                        borderWidth: 1
                    },
                    {
                        label: 'ICN',
                        data: {!! json_encode(array_values($ICN['M'])) !!},
                        backgroundColor: 'rgba(184, 230, 254, 0.5)',
                        borderColor: 'rgb(184, 230, 254)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(184, 230, 254)',
                        pointBackgroundColor: 'rgba(184, 230, 254, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(184, 230, 254)',
                        borderWidth: 1
                    },
                    {
                        label: 'IF',
                        data: {!! json_encode(array_values($IF['M'])) !!},
                        backgroundColor: 'rgba(162, 244, 253, 0.5)',
                        borderColor: 'rgb(162, 244, 253)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(162, 244, 253)',
                        pointBackgroundColor: 'rgba(162, 244, 253, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(162, 244, 253)',
                        borderWidth: 1
                    },
                    {
                        label: 'IRyA',
                        data: {!! json_encode(array_values($IRyA['M'])) !!},
                        backgroundColor: 'rgba(21, 93, 252, 0.5)',
                        borderColor: 'rgb(21, 93, 252)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(21, 93, 252)',
                        pointBackgroundColor: 'rgba(21, 93, 252, 0.5)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(21, 93, 252)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total',
                        data: {!! json_encode(array_values($graduados_m_s)) !!},
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
