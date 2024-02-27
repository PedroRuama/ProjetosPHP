<?php

//executa a query com base na conexão
include_once('controllers/conexao.php');

$select = $_GET['select'];
$valmin = $_GET['rangeMin'];
$valmax = $_GET['rangeMax'];



switch ($select) {
    case 0:
        $query = mysqli_query($conexao, "select * from pessoas where val_emp >= $valmin and val_emp <=$valmax");
        $nomeT = 'Tabela: Todos os cadastros';
        break;
    case 1:
        $query = mysqli_query($conexao, "select * from pessoas where situacao= 'Em Divida' and val_emp >= $valmin and val_emp <= $valmax");
        $nomeT = 'Tabela: Endividados';
        break;
    case 2:
        $query = mysqli_query($conexao, "select * from pessoas where situacao= 'Quitado' and val_emp >= $valmin and val_emp <=$valmax");
        $nomeT = 'Tabela: Quitados';
        break;
}


if (!$query) {
    die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Cadastros</title>
    <link rel="stylesheet" href="styles/gerenciar.css">
    <script src="scripts/gerenciar.js"></script>
    <link rel="icon" href="iconsEmp/caixa.png" type="image/png">
</head>

<body>


    <nav>
        <div class="navbar">

            <ul class="itens">
                <a href="inicial.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>">
                    <li class="btn">Página inicial </li>
                </a>
                <a href="estatisticas.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>">
                    <li class="btn">Estatísticas</li>
                </a>
                <a href="gerenciar.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>">
                    <li class="btn">Gerenciar Cadastros</li>
                </a>
            </ul>
            <a href="cad.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>"><button class="btn">Adicionar Cadastro</button></a>

        </div>
    </nav>

    <div class="aling">

        <div class="container-top">
            <div class="con-title">
                <h1>Gerenciar</h1>
                <h3>Painel de Controle</h3>
            </div>
        </div>


        <div class="div_pesquisa">
            <div id="div_nomeTabela">
                <h3 id="nome_tabela"><?= $nomeT ?></h3>
            </div>
            <div id="div_buscInp">
                <div class="input-group" id="div_busc">
                    <input type="text" name="busc" id="busc" class="input-group_input" onkeyup="buscar()" placeholder="       Pesquisar ">
                    <img src="iconsEmp/lupa.png" alt="lupa" id="lupa">
                </div>
                <img src="iconsEmp/filtro2.png" alt="filtro" class="icon" id="icon_filtro" onclick="filtro(this)">
                <!-- <div class="situacao_busc">
                    <a href="gerenciar.php?select=1"><div id="divida" class="situ"></div></a>
                    <a href="gerenciar.php?select=2"><div id="quitado" class="situ"></div></a>
                  
                </div> -->
            </div>
        </div>

        <input type="number" id="valMin" value="<?= $valmin ?>" style="display: none">
        <input type="number" id="valMax" value="<?= $valmax ?>" style="display: none">

        <div id="div_filtro">
            <div class="filtro">
                <div class="h1_f">
                    Filtro
                </div>
                <div class="container">
                    <form action="gerenciar.php" method="get">
                        <div class="h2_f"> Tabela:</div>
                        
                        <div id="div_radios">
                            <label>
                                <input type="radio" class="radio" name="select" value="0">
                                <span>Todos os cadastros</span>
                            </label>
                            <label>
                                <input type="radio" class="radio" name="select" value="1">
                                <span>Endividados <div id="divida" class="situ_f"></div></span>
                            </label>
                            <label>
                                <input type="radio" class="radio" name="select" value="2">
                                <span>Quitados <div id="quitado" class="situ_f"></div></span>
                            </label>
                           
                        </div>
                        <div class="h2_f"> Intervalo Valor Emprestimo:</div>
                        <div id="output">R$0 - R$5000</div>
                        <br>
                        <div class="h3_f"> Min:
                            <div class="slidecontainer">
                                <input type="range" id="rangeMin" name="rangeMin" class="slider" value="200" min="0" max="10000" step="500" />
                                <div class="sliderticks">
                                    <span></span>
                                    <span>500</span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>2500</span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>5000</span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>7500</span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>10000</span>

                                </div>

                            </div>
                        </div>
                        <div class="h3_f">
                            Max:
                            <div class="slidecontainer">
                                <input type="range" id="rangeMax" name="rangeMax" class="slider" value="5000" min="0" max="10000" step="500" />
                                <div class="sliderticks">
                                    <span></span>
                                    <span>500</span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>2500</span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>5000</span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>7500</span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>10000</span>
                                </div>
                            </div>
                        </div>
                        <script>
                            const rangeMin = document.getElementById('rangeMin');
                            const rangeMax = document.getElementById('rangeMax');
                            const output = document.getElementById('output');
                            
                            // Atualiza o valor exibido quando os controles deslizantes são movidos
                            function updateOutput() {
                                const minValue = parseInt(rangeMin.value, 10);
                                const maxValue = parseInt(rangeMax.value, 10);

                                // Garante que o valor mínimo seja menor ou igual ao valor máximo
                                if (minValue > maxValue) {
                                    rangeMin.value = maxValue;
                                }

                                // Garante que o valor máximo seja maior ou igual ao valor mínimo
                                if (maxValue < minValue) {
                                    rangeMax.value = minValue;
                                }
                                
                                output.textContent = `R$${rangeMin.value} - R$${rangeMax.value}`;
                            }
                            
                            // Adiciona os ouvintes de evento para os controles deslizantes
                            rangeMin.addEventListener('input', updateOutput);
                            rangeMax.addEventListener('input', updateOutput);
                        </script>
                        <div class="btns_filtro">
                            <button type="submit"  class="acoes" id="btn_Subfiltrar">Filtrar</button>
                            <button type="button"  class="acoes" id="btn_CancelarFiltro" onclick="filtro(this)">Cancelar</button>
                            
                        </div>
                        
                    </form>
                </div>

            </div>
        </div>


        <div id="componentes">

            <div id="table">

                <table class="tabela_dados">
                    <tbody id="tbody">
                        <tr>
                            <th>NOME</th>
                            <th>TELEFONE</th>
                            <th>EMPRESTIMO</th>
                            <th>PARCELAS</th>
                            <th>DATA DO <br> EMPRESTIMO</th>
                            <th>PRÓXIMO <br> PAGAMENTO</th>
                            <th></th>
                        </tr>


                        <?php while ($dados = mysqli_fetch_array($query)) { 
                            
                            $x = 0;
                            $dataDev = $dados['data_dev'];
                            $datas_parcelas= [];
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
                            if ($dados['parcelas'] == $dados['parcelas_pagas']) {                        
                                $datas_parcelas[] = $dados['data_dev'];

                            }

                            
                                            
                            $dataAtual = new DateTime(date('Y-m-d'));
                            $data_par = new DateTime(end($datas_parcelas));
                            $diferenca = $dataAtual->diff($data_par);
                            $dias = $diferenca->days;
                            ?>  



                            <tr class="trValue" onclick="trOn(this)">
                                <td class="tdValue" id="select" style="display:none;"><?= $dados['id']?></td>
                                <td class="tdValue"><?= $dados['nome'] ?></td>
                                <td class="tdValue"><?= $dados['tel'] ?></td>
                                <td class="tdValue">R$<?= $dados['val_emp'] ?> <br>(parc.: <?= $dados['val_parcela']?>)</td>
                                <td class="tdValue" ><?= $dados['parcelas_pagas']?>x de <?= $dados['parcelas']?>x</td>
                                <td class="tdValue"><?= date('d/m/Y', strtotime($dados['data_emp'])) ?></td>
                                <td class="tdValue"><?= date('d/m/Y', strtotime(end($datas_parcelas)))?></td>
                                <td class="tdValue">
                                    <div class="situacao">
                                        <?php

                                        if ($dados['situacao'] == 'Em Divida') {
                                            echo '<div id="divida" class="situ"></div>';
                                        }
                                        if ($dados['situacao'] == 'Quitado') {
                                            echo '<div id="quitado" class="situ"></div>';
                                        }


                                        ?>


                                    </div>
                                </td>

                                <!-- <td class="tdValue"><a href="detalhes.php?id=<?= $dados['id'] ?>">detalhes</a></td> -->
                                <!-- ? envia a variavel para outra tela -->
                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
            </div>

            <div id='box_acoes'>
                <div>
                    <a href="cad.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>"> <button class="acoes" id="cad"> Adicionar Cadastro </button> </a>

                    <form action="vermais.php" name="editarProduto" method="get">
                            
                        <input type="txt" name="select" id="select_table" value="<?= $select ?>" style="display: none">
                        <input type="txt" name="rangeMin" value="<?= $valmin ?>" style="display: none">
                        <input type="txt" name="rangeMax" value="<?= $valmax ?>" style="display: none">
                        <input type="txt" name="IdView" id="inputIds_editar" style="display: none">
                        <input class="acoes" id="editar" type="button" value="Ver Detalhes" disabled>
                    </form>

                </div>

                <form action="controllers/excluir.php" name="deleteProduto" method="post">
                    <input type="txt" name="select" id="select_table" value="<?= $select ?>" style="display: none">
                    <input type="txt" name="rangeMin" value="<?= $valmin ?>" style="display: none">
                    <input type="txt" name="rangeMax" value="<?= $valmax ?>" style="display: none">
                    <input type="txt" name="IdsExcluir" id="inputIds_excluir" style="display: none">
                    <input class="acoes" onclick="confirmExcluir(this)" id="excluir" type="button" value="Excluir" disabled>
                </form>
            </div>
            <div style="color: #071A5F; cursor:default">
                Pré-View
                <div Id="preView">
                    <div id="title">
                        <p id="p_title"> </p>
                    </div>
                    <p id="p1"></p>
                    <p id="p2"></p>
                    <p id="p3"></p>
                </div>
            </div>
        </div>


        <?php
        //finaliza a conexao
        mysqli_close($conexao);
        ?>
    </div>



</body>

</html>