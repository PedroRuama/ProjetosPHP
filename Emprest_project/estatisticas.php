<?php

//executa a query com base na conexão
include_once('controllers/conexao.php');

//executa a query com base na conexão
$query = mysqli_query($conexao, "SELECT * from pessoas");
$Caixa = mysqli_query($conexao, "SELECT * from caixa");
$total = mysqli_query($conexao, "SELECT count(*) as total_cad from pessoas");
$total_cademp = mysqli_query($conexao, "SELECT count(*) as total_cademp from pessoas where situacao = 'Em Divida'");
$total_cadqui = mysqli_query($conexao, "SELECT count(*) as total_cadqui from pessoas where situacao = 'Quitado'");
$ultimo_cad = mysqli_query($conexao, "SELECT * from pessoas order by id desc limit 1");
$penultimo_cad = mysqli_query($conexao, "SELECT * from pessoas order by id desc limit 1, 1");
$antepenultimo_cad = mysqli_query($conexao, "SELECT * from pessoas order by id desc limit 2, 1");
$max_emp = mysqli_query($conexao, "SELECT MAX(val_emp) AS max_emp FROM pessoas;");
$min_emp = mysqli_query($conexao, "SELECT MIN(val_emp) AS min_emp FROM pessoas;");
$max_parc = mysqli_query($conexao, "SELECT MAX(val_parcela) AS max_parc FROM pessoas;");
$min_parc = mysqli_query($conexao, "SELECT MIN(val_parcela) AS min_parc FROM pessoas;");
 
                                   


$caixa = mysqli_fetch_array($Caixa);
$Total_Cad = mysqli_fetch_array($total);
$Total_CadEmp = mysqli_fetch_array($total_cademp);
$Total_CadQui = mysqli_fetch_array($total_cadqui);
$Ultimo_Cad = mysqli_fetch_array($ultimo_cad);
$Penultimo_Cad = mysqli_fetch_array($penultimo_cad);
$Antepenultimo_Cad = mysqli_fetch_array($antepenultimo_cad);
$MaxEmp = mysqli_fetch_array($max_emp);
$MinEmp = mysqli_fetch_array($min_emp);
$MaxParc = mysqli_fetch_array($max_parc);
$MinParc = mysqli_fetch_array($min_parc);
if (!$query) {
    die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
}
date_default_timezone_set('America/Sao_Paulo');

$select = $_GET['select'];
$valmin = $_GET['rangeMin'];
$valmax = $_GET['rangeMax'];



if($Total_Cad['total_cad'] == 0){
    $Total_Cad['total_cad'] = 1.1;
}

$i = 0;
$z = 0;
$somaEmp = 0;
$somaParc = 0;
$somaJuros = 0;
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estatísticas</title>
    <link rel="stylesheet" href="styles/estatisticas.css">
    <script src="scripts/estatisticas.js"></script>
    <link rel="icon" href="iconsEmp/caixa.png" type="image/png">
</head>

<body>

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



    <div class="container">
        <div class="con-title">
            <h1>Estatísticas</h1>
            <h3>Caixa e dados</h3>
            <br>

            <h3>Data de hoje: <?= date('d/m/Y') ?></h3>
            <div class="img_div">
                <img src="imgs/estatisticas.svg" alt="avisos img" class="img">
            </div>
        </div>

        <div class="con-dados">
            <?php
            $val_empT = 0;
            $val_devT = 0;
            $soma_devT =0;
            $montante = $caixa['montante'];
            $exp_montante = 0;
            $lucroDev = 0;
            // $caixa['montante']
            while ($dados = mysqli_fetch_array($query)) {
                $exp_montante += $dados['val_dev'];
                $somaEmp += $dados['val_emp'];
                $somaParc += $dados['val_parcela'];
                $somaJuros += $dados['juros'];
                $soma_devT += $dados['val_dev'];
                

                if ($dados['situacao'] == 'Em Divida') {
                    $val_empT += $dados['val_emp'];
                }   
                if ($dados['situacao'] == 'Quitado') { 
                    $val_devT += $dados['val_dev'];
                    $lucroDev +=  $dados['val_dev'] - $dados['val_emp'];
                }

                if ($dados['parcelas'] > 1 && $dados['situacao'] == 'Em Divida') {
                    $val_empT -= $dados['val_parcela']*$dados['parcelas_pagas'];

                }
            }
            $caixa = ($montante - $val_empT) + $lucroDev;
            $lucro = $soma_devT -  $somaEmp
           
            
            ?>

            <form action="controllers/editCaixa.php" method="post">
                <div class="aling3" id="EditCaixa_div" style="display: none;">
                    <h3 style='color: #f5f5f5; padding: 0 0.4rem;'>Editar Caixa:  R$</h3> 
                    <input type="text" name="editVal" id="editVal" autocomplete="off" oninput="mascaraMoedaIn(this, event)" placeholder="Insira o valor">

                    <input type="txt" name="select" id="select_table" value="<?= $select ?>" style="display: none">
                    <input type="txt" name="rangeMin" value="<?= $valmin ?>" style="display: none">
                    <input type="txt" name="rangeMax" value="<?= $valmax ?>" style="display: none">
                    <input type="number" id="acao" name="acao" value="0" style="display: none">

                    <input type="button" class="btn_" onclick="subFormCaixa(this)" value="Retirar">
                    <input type="button" class="btn_" onclick="subFormCaixa(this)" value="Adicionar">
                </div>
            </form>
            
            
            <div class="aling2">
                <div class="con-infos2">
                    <h2>Em Caixa</h2>
                    <h4 id="caixaTxt">R$ <?=$caixa?></h4>
                </div>
                <div class="con-infos2">
                    <div class="aling">
                     <div>
                            <h5>Total de Cadastros</h5>
                            <p>
                                <?php
                                    if ($Total_Cad['total_cad'] == 1.1) {
                                        echo 0;
                                    } else{ echo $Total_Cad['total_cad'];}
                                ?>
                                

                            </p>
                        </div>
                        <div class="imgIc_div">
                            <img src="iconsEmp/tabela-de-edicao2.png" id="EditCaixa" onclick="editCaixa()" class="imgIc">
                        </div>
                    </div>
                    
                    <div class="aling">
                        <div>
                            <h5 style="color: #CA1717">Endividados</h5>
                            <p>
                                <?= $Total_CadEmp['total_cademp'] ?>
                                
                            
                            </p>
                        </div>
                        <div>
                            <h5 style="color: #008000">Quitados</h5>
                            <p>
                                <?= $Total_CadQui['total_cadqui'] ?>
                                
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aling">
                <div class="con-infos">
                    <h2>Em movimento</h2>
                    <h4>R$ <?= $val_empT ?></h4>

                </div>
                <div class="con-infos">
                    <h2>Expectativa Total</h2>
                    <h4>R$ <?= 
                        $expectativa = $montante + $lucro;
                        $expectativa 
                    
                    ?></h4>

                </div>

            </div> 

            <div class="aling_">
                <div>
                    <h5>Val. médio de empréstimo</h5>
                    <?php                      
                        $mediaEmp =  number_format($somaEmp/$Total_Cad['total_cad'], 2);
                    ?>
                    <p>R$<?=$mediaEmp?></p>
                </div>
                <div>
                    <h5>Val. médio parcela</h5>
                    <?php                      
                        $mediaParc =  number_format($somaParc/$Total_Cad['total_cad'], 2);
                    ?>
                    <p>R$<?=$mediaParc?></p>
                </div>
                <div>
                    <h5>Média juros aplicados</h5>
                    <?php                      
                        $mediaJuros =  number_format($somaJuros/$Total_Cad['total_cad'], 0);
                    ?>
                    <p><?=$mediaJuros?>%</p>
                </div>
            </div>

            <div class="aling_">

                <div class="con-infos">

                    <h5>Último Cadastro</h5>
                    <p><?php 
                        if (isset($Ultimo_Cad['nome'])) {
                           echo $Ultimo_Cad['nome'];
                        } else {echo 'Não Cadastrado';}?>
                    </p>

                    <h5>Penúltimo</h5>
                    <p><?php
                        if (isset($Penultimo_Cad['nome'])) {
                            echo $Penultimo_Cad['nome'];
                        } else {echo 'Não Cadastrado';}?>
                    
                    </p>

                    <h5>Antepenúltimo</h5>
                    <p><?php 
                        if (isset($Antepenultimo_Cad['nome'])) {
                            echo $Antepenultimo_Cad['nome'];
                        } else {echo 'Não Cadastrado';}?>
                    </p>

                </div>
                
                <div>
                    <div class="con-infos">
                        <h5>Maior val. emp.</h5>
                        <p>R$<?= $MaxEmp['max_emp'] ?></p>

                        <h5>Menor val. emp.</h5>
                        <p>R$<?= $MinEmp['min_emp'] ?></p>
                    </div>
                </div>
                <div>
                    <div class="con-infos">

                        <h5>Maior val. parcela</h5>
                        <p>R$<?= $MaxParc['max_parc'] ?></p>

                        <h5>Menor val. parcela</h5>
                        <p>R$<?= $MinParc['min_parc'] ?></p>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <?php
    //finaliza a conexao
    mysqli_close($conexao);
    ?>





</body>

</html>