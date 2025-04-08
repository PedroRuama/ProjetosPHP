<?php include("./menu.php");
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
                    Pedro Ruama
                </h2>
                <p class="balance">
                    R$ <?= $u_financas['saldoAtual_amount'] ?>
                </p>
                <div class="hrs">
                    <div class="hr1"></div>
                    <div class="hr2"></div>
                </div>
                <br>
                <h3>Mês: <?= $u_financas['mes'] ?>/<?= $u_financas['ano'] ?></h3>
                <br>
            </div>
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
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div id="container_cad_gasto">

                        <form>
                            <div class="row">
                                <div class="form-group">
                                    <!-- <label for="valor">R$ Valor</label> -->
                                    <input class="input_cad" type="number" id="valor" name="valor" step="0.01" min="0" placeholder="R$0,00" required>
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
                                    <select class="select_cad" id="categoria" name="categoria" required>
                                        <option value="" disabled selected>Categoria</option>
                                        <option value="contas">Contas</option>
                                        <option value="transporte">Transporte</option>
                                        <option value="alimentacao">Alimentação</option>
                                        <option value="lazer">Lazer</option>
                                        <option value="outros">Outros</option>
                                    </select>
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
                    <div class="add">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
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
                <div class="next-expense">
                    <p>
                        R$ 700,00
                    </p>
                    <p>
                        Aluguel
                    </p>
                    <p class="date">
                        25/07
                    </p>
                </div>
                <div class="next-expense">
                    <p>
                        R$ 700,00
                    </p>
                    <p>
                        Aluguel
                    </p>
                    <p class="date">
                        25/07
                    </p>
                </div>
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
                                R$ 16,00
                            </td>
                            <td>
                                Biblioteca
                            </td>
                            <td>
                                17/07
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
                                R$ 93,50
                            </td>
                            <td>
                                Jantar Restaurante
                            </td>
                            <td>
                                11/07
                            </td>
                        </tr>
                        <tr>
                            <td>
                                R$ 24,99
                            </td>
                            <td>
                                Açaí
                            </td>
                            <td>
                                09/07
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
            f = f*(-1)
            if(f<0){
                card.parentElement.classList.add('extendido');
            }else{
                card.parentElement.classList.remove('extendido');
            }
            console.log(f);
            
            
        }
    </script>


</body>

</html>