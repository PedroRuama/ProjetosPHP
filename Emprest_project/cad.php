<?php
include_once("controllers/conexao.php");

$query = mysqli_query($conexao, "select id from pessoas order by id desc limit 1");

$ultimo_cad = mysqli_fetch_array($query);
$id = $ultimo_cad['id'] + 1;
$select = $_GET['select'];
$valmin = $_GET['rangeMin'];
$valmax = $_GET['rangeMax'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadasrto</title>
    <link rel="stylesheet" href="styles/cad.css">
    <script src="scripts/cad.js"></script>
</head>

<body>
    <div class="back1">
        <div class="voltar">

            <a href="gerenciar.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>" class="btn">

                <div id="cancelar_div">
                    <img src="icons/seta-azul.png" alt="voltar" id="seta-azul">
                    <p>Cancelar Cadastro</p>

                </div>

            </a>
        </div>
    </div>

    <div class="container">
        <div id="title">
            <h1>Cadastrar</h1>
        </div>
        <div class="cad">
            <div class="forms_div">
                <form action="controllers/incluir.php" method="post">
                    <div class="aling">
                        <div class="inputGroup" id="inp-id">
                            <input type="search" required name="id" autocomplete="off" value="<?= $id ?>" disabled class="disabili">
                            <label for="id"> Id</label>
                        </div>

                        <div class="inputGroup" id="inp-nome">
                            <input type="search" required autocomplete="off" name="nome" class="obrigatorio">
                            <label for="name">Nome </label>

                        </div>
                        <div class="inputGroup" id="inp-sobrenome">
                            <input type="search" name="sobrenome" required autocomplete="off">
                            <label for="">Sobrenome</label>
                        </div>
                    </div>
                    <div class="hr"></div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-cpf">
                            <input type="search" required name="cpf" autocomplete="off" oninput="mascaraCpf(this)">
                            <label for="id"> CPF</label>
                        </div>

                        <div class="inputGroup" id="inp-rg">
                            <input type="search" required name="rg" autocomplete="off" oninput="mascaraRg(this)">
                            <label for="">RG</label>
                        </div>
                        <div class="inputGroup" id="inp-tel">
                            <input type="search" required autocomplete="off" name="tel" oninput="mascaraTel(this)">
                            <label for="">Telefone</label>
                        </div>
                    </div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-end">
                            <input type="search" required autocomplete="off" name="ende">
                            <label for="">Endereço</label>
                        </div>

                        <div class="inputGroup" id="inp-social">
                            <input type="search" required autocomplete="off" name="social">
                            <label for="">@Social</label>
                        </div>
                    </div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-email">
                            <input type="search" required autocomplete="off" name="email">
                            <label for="">Email</label>
                        </div>
                    </div>
                    <div class="hr"></div>
                    <div class="aling" id="Emp">
                        <div class="inputGroup" id="inp-valEmp">
                            <input type="search" required autocomplete="off" id="val_emp" name="val_emp" oninput="mascaraMoeda(this, event)" class="obrigatorio" onkeyup="dev()">
                            <label for="">R$ Valor Emprestimo</label>

                        </div>
                        <div class="inputGroup" id="inp-juros">
                            <input type="search" required autocomplete="off" name="juros" class="obrigatorio" onkeyup="dev()" id="juros" oninput="jurosmascara(this)">
                            <label for="">% Juros</label>
                        </div>
                        <div class="inputGroup" id="inp-dataEmp">
                            <input type="date" required autocomplete="off" name="data_emp" class="obrigatorio" id="data_emp" oninput="dev()">
                            <label for="">Data Emprestimo</label>
                        </div>

                        <div class="inputGroup" id="inp-dataDev">
                            <input type="date" required autocomplete="off" name="data_dev" class="obrigatorio" id="data_dev" oninput="dev()">
                            <label for="">Data Devolução</label>
                        </div>
                    </div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-valEmp">
                            <input type="search" required autocomplete="off" oninput="mascaraMoeda(this, event)" name="val_dev" disabled required id="val_dev" class="disabili">
                            <label for="">R$ Devolução</label>
                        </div>

                        <div class="div_checkbox">
                            <div style="display: flex;">
                                <label class="label_check" id="divida_label" onclick="check(this)">EM DIVIDA
                                    <input type="checkbox" id="inp-divida" name="situacao" value="Em Divida" checked>
                                    <span class="checkmark"></span>
                                </label>
                                <div class="div_img">
                                    <img src="icons/seta-direita.png" alt="seta" id="img_parcela" onclick="divParcelas()">
                                    <div id="div_parcelas">
                                        <div class="inputGroup">
                                            <p class="label_select">Nº Parcelas</p>
                                            <select name="parcelas" id="parcelas" oninput="dev()">
                                                <option value="1x">1x</option>
                                                <option value="2x">2x</option>
                                                <option value="3x">3x</option>
                                                <option value="4x">4x</option>
                                                <option value="5x">5x</option>
                                                <option value="6x">6x</option>
                                                <option value="7x">7x</option>
                                                <option value="8x">8x</option>
                                                <option value="9x">9x</option>
                                                <option value="10x">10x</option>
                                                <option value="11x">11x</option>
                                                <option value="12x">12x</option>
                                            </select>
                                        </div>
                                        <div class="inputGroup">
                                            <p class="label_select"> Nº Pagas</p>
                                            <select name="parcelas_pagas">
                                                <option value="0x">0x</option>
                                                <option value="1x">1x</option>
                                                <option value="2x">2x</option>
                                                <option value="3x">3x</option>
                                                <option value="4x">4x</option>
                                                <option value="5x">5x</option>
                                                <option value="6x">6x</option>
                                                <option value="7x">7x</option>
                                                <option value="8x">8x</option>
                                                <option value="9x">9x</option>
                                                <option value="10x">10x</option>
                                                <option value="11x">11x</option>
                                                <option value="12x">12x</option>
                                            </select>
                                        </div>
                                        <div class="inputGroup" id="inp-valEmp">
                                            <p class="label_select" id="label_valparcela"> R$ da parcela</p>
                                            <input type="search" required autocomplete="off" oninput="mascaraMoeda(this, event)" name="val_parcela" id="val_parcela"  class="disabili">
                                            
                                        </div>
                                        <div class="inputGroup">
                                            <p class="label_select" id="label_diapag"> Todo dia</p>
                                            <input type="search" required autocomplete="off"  name="val_parcela" id="dia_pag"  class="disabili">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="label_check" id="quitado_label" onclick="check(this)">QUITADO
                                <input type="checkbox" id="inp-quitado" name="situacao" value="Quitado">
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <div class="inputGroup">
                            <p class="label_select">Forma de pagamento</p>
                            <select name="pagamento">
                                <option value="vazio"></option>
                                <option value="Debito">Debito</option>
                                <option value="Credito">Credito</option>
                                <option value="Pix">Pix</option>
                                <option value="Transferencia">Trasferencia</option>
                                <option value="Dinheiro">Dinheiro</option>

                            </select>

                        </div>

                    </div>
                    <div class="hr"></div>
                    <div class="aling" id="aling_obs">
                        <div class="inputGroup" id="inp-obs">
                            <textarea name="detalhes" id="detalhes" cols="30" rows="10" required></textarea>
                            <label for="">Detalhes/Observações</label>
                        </div>
                    </div>
                    <div class="hr"></div>
                    <input type="txt" name="select" value="<?= $select ?>" style="display: none">
                    <input type="txt" name="rangeMin" value="<?= $valmin ?>" style="display: none">
                    <input type="txt" name="rangeMax" value="<?= $valmax ?>" style="display: none">
                    <div class="btns">
                        <button type="submit" onclick="Submit()">Enviar</button>

                        <button type="reset"> Limpar Tudo</button>

                    </div>

                </form>

            </div>

        </div>
    </div>
    <?php
    //finaliza a conexao
    mysqli_close($conexao);
    ?>
</body>

</html>