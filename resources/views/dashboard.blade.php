<x-layout.main>
    <x-slot:title>
        Dashboard
    </x-slot:title>
  
    <div class="col">
        <div class="card o-income">
            <div class="card-body">
                <canvas id="chart" class="col"></canvas>
            </div>
        </div>
    </div>
    
    @push('foot')
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.js"></script>

        <script>
            axios.get('/get_data_chart')
            .then(function (response) {
                // handle success
               console.log(response.data)
                const data = {
                    labels: response.data.unit,
                    datasets: [{
                        label: 'Mingguan',
                        data: response.data.mingguan,
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 0, 0, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(255, 50, 90, 0.2)',
                        'rgba(255, 80, 120, 0.2)',
                        'rgba(255, 100, 180, 0.2)',
                    
                        ],
                        borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 86)',
                        
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Bulanan',
                        data: response.data.bulanan,
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 0, 0, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(255, 50, 90, 0.2)',
                        'rgba(255, 80, 120, 0.2)',
                        'rgba(255, 100, 180, 0.2)',
                    
                        ],
                        borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 86)',
                        
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Triwulan',
                        data: response.data.triwulan,
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 0, 0, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(255, 50, 90, 0.2)',
                        'rgba(255, 80, 120, 0.2)',
                        'rgba(255, 100, 180, 0.2)',
                    
                        ],
                        borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 205, 86)',
                        
                        ],
                        borderWidth: 1
                    }
                    ]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                        y: {
                            beginAtZero: true
                        }
                        }
                    },
                };
                let ctx=document.getElementById('chart');
                new Chart(ctx, config)
                console.log(response.data.mingguan);
                
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .finally(function () {
                // always executed
            });
        
        </script>
    @endpush

</x-layout.main>