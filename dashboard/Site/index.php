<?php
    
        //Recarregar a página a cada 5 segundos
        echo "<meta HTTP-EQUIV='refresh' CONTENT='5;URL=index.php'>";

        //Conexão com o banco de dados
        $servidor = "localhost";
        $usario = "root";
        $senha = "";
        $dbname = "dashboard";
        
        $conn = mysqli_connect($servidor,$usario,$senha,$dbname);
        
        if(!$conn){
            die("Falha na conexao: " . mysqli_connect_error());
        }

        //String para buscar os dados no banco de dados
        $result_quantidade_regiao = "SELECT * FROM quantidade_regiao";
        $result_preco_produto = "SELECT * FROM preco_produto";
        $result_lucro_vendedor = "SELECT * FROM lucro_vendedor";
        $result_quantidade_loja_ano = "SELECT * FROM quantidade_loja_ano";

        //Comando para buscar os dados no banco de dados
        $resultado_quantidade_regiao = mysqli_query($conn, $result_quantidade_regiao);
        $resultado_preco_produto = mysqli_query($conn, $result_preco_produto);
        $resultado_lucro_vendedor = mysqli_query($conn, $result_lucro_vendedor);
        $resultado_quantidade_loja_ano = mysqli_query($conn, $result_quantidade_loja_ano);

        //Iniciar os vetores que irão guardar as informações
        $quantidade_regiao_entidade = [];
        $quantidade_regiao_valor = [];
        $preco_produto_entidade = [];
        $preco_produto_valor = [];
        $lucro_vendedor_entidade = [];
        $lucro_vendedor_valor = [];
        $quantidade_loja_ano_entidade = [];
        $quantidade_loja_ano_valor = [];

        //Guardar as informações nos vetores para passar aos do java
        while($row_quantidade_regiao = mysqli_fetch_assoc($resultado_quantidade_regiao)){
            array_push($quantidade_regiao_entidade, $row_quantidade_regiao['regiao']);
            array_push($quantidade_regiao_valor, $row_quantidade_regiao['quantidade']);
        }
        while($row_preco_produto = mysqli_fetch_assoc($resultado_preco_produto)){
            array_push($preco_produto_entidade, $row_preco_produto['produto']);
            array_push($preco_produto_valor, $row_preco_produto['preco']);
        }
        while($row_lucro_vendedor = mysqli_fetch_assoc($resultado_lucro_vendedor)){
            array_push($lucro_vendedor_entidade, $row_lucro_vendedor['nome']);
            array_push($lucro_vendedor_valor, $row_lucro_vendedor['lucro']);
        }
        while($row_quantidade_loja_ano = mysqli_fetch_assoc($resultado_quantidade_loja_ano)){
            array_push($quantidade_loja_ano_entidade, $row_quantidade_loja_ano['ano']);
            array_push($quantidade_loja_ano_valor, $row_quantidade_loja_ano['quantidade']);
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <style>
    	body
    	{
    		background-image: url("grad.jpg");
    	}
    	h1, div, p
    	{
    		text-align: center;
            background-color:white;
    	}
        h2,footer
        {
            text-align: center;
            background-color:white;
        }

    </style>
  </head>
  <body>
     <h2>DASHBOARD</h2>

    <div class="container" style="width: 1500px; height: 625px">
        <div class="row">
            <div class="col" style="width: 540px; height: 300px">

                <p><b>Quantidade vendida por região</b></p>
                <canvas id="barra"></canvas>
                <script>
                    //Passando os vetores php para java
                    var quantidade_regiao_entidade = <?php echo json_encode($quantidade_regiao_entidade); ?>;
                    var quantidade_regiao_valor = <?php echo json_encode($quantidade_regiao_valor); ?>;
                    var preco_produto_entidade = <?php echo json_encode($preco_produto_entidade); ?>;
                    var preco_produto_valor = <?php echo json_encode($preco_produto_valor); ?>;
                    var lucro_vendedor_entidade = <?php echo json_encode($lucro_vendedor_entidade); ?>;
                    var lucro_vendedor_valor = <?php echo json_encode($lucro_vendedor_valor); ?>;
                    var quantidade_loja_ano_entidade = <?php echo json_encode($quantidade_loja_ano_entidade); ?>;
                    var quantidade_loja_ano_valor = <?php echo json_encode($quantidade_loja_ano_valor); ?>;

                    //Agora basta colocar os vetores em seus devidos lugares: labels e data

                    var ctx = document.getElementById('barra').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: quantidade_regiao_entidade,
                            datasets: [{
                                label: 'Quantidade',
                                data: quantidade_regiao_valor,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
            <div class="col">
                <div class="col" style="width: 540px; height: 300px">
                    <p><b>Preço unitário por produto</b></p>
                    <canvas id="polar"></canvas>
                    <script>
                        var ctx = document.getElementById('polar').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'polarArea',
                            data: {
                                labels: preco_produto_entidade,
                                datasets: [{
                                    data: preco_produto_valor,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            }
                        });
                    </script>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <div class="col" style="width: 540px; height: 300px">
                    <br>
                    <p><b>Margem de lucro por vendedor</b></p>
                    <canvas id="donut"></canvas>
                    <script>
                        var ctx = document.getElementById('donut').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: lucro_vendedor_entidade,
                                datasets: [{
                                    data: lucro_vendedor_valor,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            }
                        });
                    </script>
                </div>
            </div>
            <div class="col">
                    <div class="col" style="width: 540px; height: 300px">
                    <br>
                    <p><b>Quantidade de lojas abertas por ano</b></p>
                    <canvas id="linha"></canvas>
                    <script>
                        var ctx = document.getElementById('linha').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: quantidade_loja_ano_entidade,
                                datasets: [{
                                    label: 'Lojas',
                                    data: quantidade_loja_ano_valor,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>


  </body>
<footer>Desenvoldido por: Giovanni Paschoal Raphael</footer>

</html>