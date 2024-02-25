<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Deslizante Duplo</title>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <script>
        // Seus dados para o gráfico
        var data = {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
            datasets: [{
                label: 'Vendas',
                backgroundColor: 'blue',
                borderColor: 'blue',
                data: [65, 59, 80, 81, 56, 55]
            }]
        };

        // Configurações do gráfico
        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        // Obtém o contexto do canvas
        var ctx = document.getElementById('myChart').getContext('2d');

        // Cria o gráfico
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>
    <canvas id="myChart" width="400" height="400"></canvas>

</body>

</html>