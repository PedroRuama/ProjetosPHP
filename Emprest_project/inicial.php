<?php

//executa a query com base na conexão
include_once('controllers/conexao.php');

//executa a query com base na conexão
$query = mysqli_query($conexao, "select * from pessoas");
$aviso = mysqli_query($conexao, "select * from pessoas");
if (!$query) {
    die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
}
date_default_timezone_set('America/Sao_Paulo');

$select = $_GET['select'];
$valmin = $_GET['rangeMin'];
$valmax = $_GET['rangeMax'];

$i = 0;
$z = 0;
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="styles/inicial.css">
    <link rel="icon" href="iconsEmp/caixa.png" type="image/png">
</head>

<body>
    <nav>
        <div class="navbar">

            <ul class="itens">
                <a href="inicial.php?select=<?= $select ?>&rangeMin=<?= $valmin ?>&rangeMax=<?= $valmax ?>">
                    <li class="btn">Página inicial </li>
                </a>
                <a href="estatisticas.php?select=<?= $select ?>&rangeMin=<?= $valmin ?>&rangeMax=<?= $valmax ?>">
                    <li class="btn">Estatísticas</li>
                </a>
                <a href="gerenciar.php?select=<?= $select ?>&rangeMin=<?= $valmin ?>&rangeMax=<?= $valmax ?>">
                    <li class="btn">Gerenciar Cadastros</li>
                </a>
            </ul>
            <a href="cad.php?select=<?= $select ?>&rangeMin=<?= $valmin ?>&rangeMax=<?= $valmax ?>" class="btn">Adicionar Cadastro</a>

        </div>
    </nav>


    <div class="container">
        <div class="con-title">
            <h1>Inicial</h1>
            <h3>Notificações e avisos</h3>
            <br>
            <br>
            <h3>Data de hoje: <?= date('d/m/Y') ?></h3>
            <div class="img_div">
                <img src="imgs/avisos.svg" alt="avisos img" class="img">
            </div>
        </div>

        <div class="con-warning">
            <p id="aviso_label">O prazo de revisão esta chegando na data (7 dias ou menos):</p>

            <div class="avisos_divtr" id="avisos_tr_div" style="display:none">
                <div class="avisos" id="avisos_tr">
                    <img src="iconsEmp/aviso.png" alt="" class="iconAviso" id="img_aviso_tr">
                    <div class="dados_aviso" id="tr">
                        <div class="divider_tr">Nome</div>
                        <!-- <div class="divider_tr">Telefone</div> -->
                        <div class="divider_tr">Parcelas</div>
                        <div class="divider_tr">Valor parcela</div>
                        <div class="divider_tr">Pagamento</div>
                        <div class="divider_tr">Próxima Data</div>
                    </div>
                </div>
            </div>

            <?php while ($dados = mysqli_fetch_array($query)) {


                $x = 0;
                $dataDev = $dados['data_dev'];
                $datas_parcelas = [];
                while ($x < $dados['parcelas']) {
                    $dataParcela = new DateTime("$dataDev");
                    $dataParcela->modify("-$x month");

                    $novoAno = $dataParcela->format('Y');
                    $novoMes = $dataParcela->format('m');
                    $novoDia = $dataParcela->format('d');

                    $newData = "$novoAno-$novoMes-$novoDia";
                    $datas_parcelas[] = $newData;
                    $x++;
                }

                $y = 1;
                while ($y <= $dados['parcelas_pagas']) {
                    array_pop($datas_parcelas);
                    $y++;
                }


                $dataAtual = new DateTime(date('Y-m-d'));
                $data_par = new DateTime(end($datas_parcelas));

                // Calcula a diferença em dias
                $diferenca = $dataAtual->diff($data_par);
                // Obtém a diferença em dias 
                $dias = $diferenca->days;
                  


                // echo $dados['nome'], "-----datadev:", $dias, "////// diapag:", $diferencaDiaPag;
                // echo '<br>';




                if ($dias <= 7 && $dados['situacao'] == 'Em Divida' && $dias > 0) {
                    $i = 1;

            ?>
                    <script>
                        var div_des = document.getElementById('avisos_tr_div')
                        div_des.removeAttribute('style')
                    </script>
                    <div class="avisos_div">
                        <div class="avisos">
                            <img src="iconsEmp/aviso.png" alt="" class="iconAviso">
                            <div class="dados_aviso">
                                <div class="divider"><?= $dados['nome'] ?></div>
                                <!-- <div class="divider"><?= $dados['tel'] ?></div> -->
                                <div class="divider"><?= $dados['parcelas_pagas'] ?>x de <?= $dados['parcelas'] ?>x</div>
                                <div class="divider">R$<?= $dados['val_parcela'] ?></div>
                                <div class="divider">Dia <?= $dados['diapag'] ?> (em <?= $dias ?>d)</div>
                                <div class="divider"><?= date('d/m/Y', strtotime(end($datas_parcelas))) ?></div>

                            </div>
                            <a href="vermais.php?IdView=<?= $dados['id'] ?>&select=<?= $select ?>&rangeMin=<?= $valmin ?>&rangeMax=<?= $valmax ?>"><img src="iconsEmp/seta-direita.png" alt="" class="iconAviso" id="seta"></a>
                        </div>
                    </div>
            <?php }
            }
            if ($i == 0) {
                echo '<div class="pontos">...</div>';
            }
            ?>
            <div class="atencao_div">
                <p id="atencao_label">Atenção ao prazo de revisão (15 dias ou menos)</p>

                <div class="avisos_divtr" id="avisos_tr_div2" style="display:none">
                    <div class="avisos" id="avisos_tr">
                        <img src="iconsEmp/aviso.png" alt="" class="iconAviso" id="img_aviso_tr">
                        <div class="dados_aviso" id="tr">
                            <div class="divider_tr">Nome</div>
                            <div class="divider_tr">Parcelas</div>
                            <div class="divider_tr">Valor parcela</div>
                            <div class="divider_tr">Pagamento</div>
                            <div class="divider_tr">Próxima Data</div>
                        </div>
                    </div>
                </div>
                <div class="avisos_">
                    <img src="iconsEmp/ponto-de-exclamacao.png" alt="" class="iconAviso" id="img_atencao" style='display: none;'>
                    <div class="dados_atencao" style='display: none;' id="div_dados">
                        <?php while ($dados = mysqli_fetch_array($aviso)) {

                            $x = 0;
                            $dataDev = $dados['data_dev'];
                            $datas_parcelas = [];
                            while ($x < $dados['parcelas']) {
                                $dataParcela = new DateTime("$dataDev");
                                $dataParcela->modify("-$x month");

                                $novoAno = $dataParcela->format('Y');
                                $novoMes = $dataParcela->format('m');
                                $novoDia = $dataParcela->format('d');

                                $newData = "$novoAno-$novoMes-$novoDia";
                                $datas_parcelas[] = $newData;
                                $x++;
                            }

                            $y = 1;
                            while ($y <= $dados['parcelas_pagas']) {
                                array_pop($datas_parcelas);
                                $y++;
                            }


                            $dataAtual = new DateTime(date('Y-m-d'));
                            $data_par = new DateTime(end($datas_parcelas));

                            // Calcula a diferença em dias
                            $diferenca = $dataAtual->diff($data_par);
                            // Obtém a diferença em dias
                            $dias = $diferenca->days;


                            if ($dias > 7 && $dados['situacao'] == 'Em Divida' && $dias <= 15) {
                                $z = 1;
                        ?>
                                <script>
                                    var div_desc2 = document.getElementById('avisos_tr_div2')
                                    var div_dados = document.getElementById('div_dados')
                                    var img_atencao = document.getElementById('img_atencao')
                                    div_desc2.removeAttribute('style')
                                    div_dados.removeAttribute('style')
                                    img_atencao.removeAttribute('style')
                                </script>
                                <div class="row_atencao" id="row_atencaoid">
                                    <div class="divider_"><?= $dados['nome'] ?></div>
                                    <div class="divider_"><?= $dados['parcelas_pagas'] ?>x de <?= $dados['parcelas'] ?>x</div>
                                    <div class="divider_">R$<?= $dados['val_parcela'] ?></div>
                                    <div class="divider_">Dia <?= $dados['diapag'] ?> (em <?= $dias ?>d)</div>
                                    <div class="divider_"><?= date('d/m/Y', strtotime(end($datas_parcelas))) ?></div>
                                </div>

                        <?php }
                        }
                        ?>

                    </div>
                </div>
                <?php
                if ($z == 0) {
                    echo '<div class="pontos">...</div>';
                }
                ?>
            </div>






        </div>

    </div>

    <?php
    //finaliza a conexao
    mysqli_close($conexao);
    ?>





</body>

</html>