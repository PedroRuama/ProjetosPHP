<?php include("./menu.php");
include './controllers/conexao.php';
include("./controllers/chamadas_sql.php");

echo "<br>";
// echo print_r($_SESSION);
echo "<br>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/lancamentos.css">
    <script src="./script/format.js"></script>
</head>
<style>


</style>

<body>

    <div class="container">
        <div class="main">
            <div class="profile">
                <?php
                $simg = mysqli_query($conexao, "SELECT path FROM imgs_users where userID = '" . $_SESSION['userID'] . "'");
                $img = mysqli_fetch_array($simg);
                $row_img = mysqli_num_rows($simg);
                if ($row_img >= 1) {
                    $path = $img['path'];
                } else {
                    $path = './icons/user.png';
                }
                ?>
                <img alt="Profile Picture" src="<?= $path ?>" />
                <h2>
                    <?php echo $_SESSION['user']; ?>
                </h2>
                <p class="balance">
                    R$ <?= $u_financas['saldoAtual_amount']?>
                </p>
                <div class="hrs">
                    <div class="hr1"></div>
                    <div class="hr2"></div>
                </div>
                <br>
                <h3>Mês: <?= $u_financas['mes'] ?>/<?= $u_financas['ano'] ?></h3>
                <br>
            </div>


            <div class="gerencia_financas_div">
                <div class="lancamentos_div">

                    <div class="summary gastos">
                        <h3>
                            GASTOS
                        </h3>
                        <hr>
                        <p class="amount">

                            <span class="currency">R$</span>
                            <span class="value"><?= $u_financas['total_gastos'] ?></span>
                        </p>
                        <hr>
                        <div class="sub" onclick="show(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon+">
                                <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-" style="display: none;">
                                <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="container_cad">

                            <form method="post" action="./controllers/addLancamento.php">
                                <div class="row">
                                    <div class="form-group">
                                        <!-- <label for="valor">R$ Valor</label> -->
                                        <input class="input_cad" type="number" id="valor" oninput="mascaraMoeda(this, event)" name="valor" step="0.01" min="0" placeholder="R$0,00" required>
                                    </div>

                                    <div class="form-group">
                                        <input class="input_cad" type="date" id="data" name="data" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group">
                                        <input class="input_cad" type="text" id="descricao" name="descricao" placeholder="Descrição do gasto" required>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="categoria">Categoria</label> -->
                                        <?php $scat = mysqli_query($conexao, "SELECT * from categorias where (padrao_ys = 1 OR (padrao_ys = 0 AND userID=$userID)) and (tipo = 'gasto' OR tipo='ambos')");
                                        ?>
                                        <select class="select_cad" id="categoria" name="categoria_id" required>
                                            <option value="" disabled selected>Categoria</option>
                                            <?php while ($cat = $scat->fetch_assoc()) {

                                            ?>
                                                <option value="<?= $cat['categoria_id'] ?>"><?= $cat['name'] ?></option>
                                            <?php }; ?>
                                        </select>
                                        <!-- <a href="config.php#addCat"> Add nova categoria + </a> -->
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="objetivo">Objetivo</label>
                                        <select id="objetivo" name="objetivo">
                                            <option value="" selected>Nenhum</option>
                                            <option value="viagem">Viagem</option>
                                            <option value="investimento">Investimento</option>
                                            <option value="emergencia">Fundo de Emergência</option>
                                        </select>
                                    </div> -->
                                </div>

                                <button type="submit" class="button_gasto">Adicionar Gasto</button>
                            </form>
                        </div>
                    </div>
                    <div class="summary recebimentos">
                        <h3>
                            RECEBIMENTOS
                        </h3>
                        <hr>
                        <p class="amount">
                            <span class="currency">R$</span>
                            <span class="value"> <?= $u_financas['total_recebimentos'] ?></span>
                        </p>
                        <hr>
                        <div class="add" onclick="show(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon+">
                                <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-" style="display: none;">
                                <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="container_cad">

                            <form method="post" action="./controllers/addLancamento.php">
                                <div class="row">
                                    <div class="form-group">
                                        <!-- <label for="valor">R$ Valor</label> -->
                                        <input class="input_cad" type="number" oninput="mascaraMoeda(this, event)" id="valor" name="valor" step="0.01" min="0" placeholder="R$0,00" required>
                                    </div>

                                    <div class="form-group">
                                        <input class="input_cad" type="date" id="data" name="data" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group">
                                        <input class="input_cad" type="text" id="descricao" name="descricao" placeholder="Descrição" required>
                                    </div>
                                    <div class="form-group">
                                        <?php $scat = mysqli_query($conexao, "SELECT * from categorias where (padrao_ys = 1 OR (padrao_ys = 0 AND userID=$userID)) and (tipo = 'recebimento' OR tipo='ambos')");
                                        ?>
                                        <select class="select_cad" id="categoria" name="categoria_id" required>
                                            <option value="" disabled selected>Categoria</option>
                                            <?php while ($cat = $scat->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $cat['categoria_id'] ?>"><?= $cat['name'] ?></option>
                                            <?php }; ?>
                                        </select>
                                        <!-- <a href="config.php#addCat"> Add nova categoria +</a> -->
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="objetivo">Objetivo</label>
                                        <select id="objetivo" name="objetivo">
                                            <option value="" selected>Nenhum</option>
                                            <option value="viagem">Viagem</option>
                                            <option value="investimento">Investimento</option>
                                            <option value="emergencia">Fundo de Emergência</option>
                                        </select>
                                    </div> -->
                                </div>

                                <button type="submit" class="button_recebimento">Adicionar Recebimento</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="summary guardado">

                    <h3>
                        GUARDADO
                    </h3>
                    <hr>
                    <p class="amount">
                        <span class="currency">R$</span>
                        <span class="value"> <?= number_format($total_guardado, 2, '.', '') ?></span>
                    </p>
                    <hr>
                    <div class="add guardar" onclick="show(this)">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon+">
                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-" style="display: none;">
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="container_cad">

                        <form method="post" action="./controllers/metas_controller.php">
                            <!-- From Uiverse.io by Yaya12085 -->
                            <div class="radio-inputs">
                                <label class="radio">
                                    <input type="radio" value="guardar_r" name="radio" checked="">
                                    <span class="name">GUARDAR</span>
                                </label>
                                <label class="radio">
                                    <input type="radio" value="resgatar_r" name="radio">
                                    <span class="name">RESGATAR</span>
                                </label>

                                
                            </div>
                            <div class="row">

                                <div class="row">
                                    <div class="form-group">
                                        <!-- <label for="valor">R$ Valor</label> -->
                                        <input class="input_cad" type="number" oninput="mascaraMoeda(this, event)" id="valor" name="valor" step="0.01" min="0" placeholder="R$0,00" required>
                                    </div>

                                    <div class="form-group">
                                        <?php $smeta = mysqli_query($conexao, "SELECT * from metas where userID = $userID");
                                        ?>
                                        <select class="select_cad" name="meta_id" required>
                                            <option value="" disabled selected>EM</option>
                                            <?php while ($meta = $smeta->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $meta['meta_id'] ?>"><?= $meta['name']?>:  <?= $meta['atual_amount']?></option>
                                            <?php }; ?>
                                        </select>
                                        <!-- <a href="config.php#addCat"> Add nova categoria +</a> -->
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="button_guardado">Guardar/Resgatar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="fixed-expense">
                <div class="alert">
                    !
                </div>
                <h3>
                    Próximo Gasto Fixo
                </h3>
                <?php $sGast = mysqli_query($conexao, "SELECT * from gastos_fixos where userID = $userID");

                while ($Gast = $sGast->fetch_assoc()) {
                ?>

                    <div class="next-expense">
                        <p>
                            R$ <?= $Gast['amount']; ?>
                        </p>
                        <p>
                            <?= $Gast['name']; ?>
                        </p>
                        <p class="date">
                            <?= $Gast['start_date']; ?>/<?= $u_financas['mes'] ?>
                        </p>
                    </div>

                <?php } ?>
            </div>

            <div class="expenses">
                <h3>
                    LISTA GASTOS
                </h3>
                <!-- <p class="amount">
                    R$ 537,50
                </p> -->
                <div class="sub">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>
                                R$
                            </th>
                            <th>
                                Desc.
                            </th>
                            <th>
                                Categoria
                            </th>
                            <th>
                                Data
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sgastos = mysqli_query($conexao, "SELECT * FROM transacoes WHERE userID = $userID and mes_id = " . $u_financas['mes_id'] . " AND (tipo = 'gasto' OR tipo is NULL) ORDER BY transacoes_id DESC");
                        while ($gastos = mysqli_fetch_array($sgastos)) {
                        ?>
                            <tr>
                                <td>
                                    R$ <?= $gastos['amount']; ?>
                                </td>
                                <td>
                                    <?= $gastos['name']; ?>
                                </td>
                                <td>
                                    <?= $gastos['categoria']; ?>
                                </td>
                                <td>
                                    <?php echo date('d/m/Y', strtotime($gastos['data_transacao'])) ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

            <div class="monthly-budget">
                <h3>
                    Orçamento Mensal aproximado
                </h3>
                <table>
                    <thead>
                        <tr>
                            <th>
                                R$
                            </th>
                            <th>
                                Descrição
                            </th>
                            <th>
                                Data
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                R$ 700,00
                            </td>
                            <td>
                                Aluguel
                            </td>
                            <td>
                                25/07
                            </td>
                        </tr>
                        <tr>
                            <td>
                                R$ 200,00
                            </td>
                            <td>
                                Água/Luz
                            </td>
                            <td>
                                15/07
                            </td>
                        </tr>
                        <tr>
                            <td>
                                R$ 130,00
                            </td>
                            <td>
                                Academia
                            </td>
                            <td>
                                11/07
                            </td>
                        </tr>
                        <tr>
                            <td>
                                R$ 150,00
                            </td>
                            <td>
                                Investimento
                            </td>
                            <td>
                                05/07
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="total">
                    <p>
                        Total previsto
                    </p>
                    <p>
                        R$ 1180,00
                    </p>
                </div>
                <div class="manage">
                    Gerenciar Gastos Fixos
                </div>
            </div>
        </div>
    </div>
  
    <script>
        let f = 1;

        function show(card) {
            f = f * (-1)
            document.getElementsByClassName
            const isMobile = window.innerWidth <= 768;
            if (f < 0) {
                card.parentElement.classList.add('extendido');
                card.style = "transform: rotate(180deg);"
                card.parentElement.getElementsByClassName('container_cad')[0].style = 'display:flex'
                card.getElementsByClassName('icon+')[0].style = "display: none"
                card.getElementsByClassName('icon-')[0].style = "display: flex"
                //  console.log(card.parentElement.parentElement);


                if (isMobile) {


                    if (card.classList.contains('add')) {
                        card.parentElement.parentElement.style = " flex-direction: column-reverse; height:auto;"
                        card.parentElement.style = " width:90%;"
                    } else {
                        card.parentElement.parentElement.style = "flex-direction: column; height:auto;"
                        card.parentElement.style = " width:90%;"
                    }



                }
            } else {
                card.parentElement.classList.remove('extendido');
                card.style = "transform: rotate(-90deg);"
                card.parentElement.getElementsByClassName('container_cad')[0].style = 'display:none'
                card.getElementsByClassName('icon-')[0].style = "display: none"
                card.getElementsByClassName('icon+')[0].style = "display: flex"
                card.parentElement.parentElement.style = "flex-direction: row; height:auto;"

                if (isMobile) {

                    if (card.classList.contains('guardar')) {
                        card.parentElement.parentElement.style = "flex-direction:;; height:; "
                        card.parentElement.style = " width:;"
                    } else {
                        card.parentElement.parentElement.style = "flex-direction: row; height: 60px;"
                        card.parentElement.style = " width:;"


                    }

                }
            }
            // console.log(f);


        }
    </script>


</body>

</html>