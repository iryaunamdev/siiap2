<h3 class="font-bold mb-2">Estudiantes Graduados</h3>
<canvas wire:ignore id="myChart"></canvas>

<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_values($labels_semestres)) !!},
                datasets: [
                    {
                        label: 'Maestría',
                        data: {!! json_encode(array_values($graduados_m_s)) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: 'rgb(59, 130, 246)',
                        tension: 0.1,
                        borderCapStyle: 'round',
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBorderColor: 'rgb(59, 130, 246)',
                        pointBackgroundColor: 'rgba(59, 130, 246, 0.1)',
                        pointBorderWidth: 2,
                        pointHoverBorderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1
                    },
                    {
                        label: 'Doctorado',
                        data: {!! json_encode(array_values($graduados_d_s)) !!},
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
                        label: 'Total',
                        data: {!! json_encode(array_values($graduados_t_s)) !!},
                        backgroundColor: 'rgba(248, 250, 252, 0.5)',
                        borderColor: 'rgb(202, 213, 226)',
                        fill:true,
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
                ],
            },

            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',

                    },
                    /*title: {
                        display: true,
                        text: 'Estudiantes de Graduados'
                    }*/
                },

            }
        });
    });
</script>
