<?php include("./menu.php"); ?>
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
                <img alt="Profile Picture" src="<?= $path ?>"/>
                <h2>
                    Pedro Ruama
                </h2>
                <p class="balance">
                    R$ 722,50
                </p>
                <div class="hrs">
                    <div class="hr1"></div>
                    <div class="hr2"></div>
                </div>
            </div>
            <div class="lancamentos_div">

                <div class="summary gastos">
                    <h3>
                        GASTOS
                    </h3>
                    <p class="amount">
                        <span class="currency">R$</span>
                        <span class="value">1260,00</span>
                    </p>
                    <div class="sub">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
                <div class="summary recebimentos">
                    <h3>
                        RECEBIMENTOS
                    </h3>
                    <p class="amount">
                        <span class="currency">R$</span>
                        <span class="value">1260,00</span>
                    </p>

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
                    GASTO TOTAL
                </h3>
                <p class="amount">
                    R$ 537,50
                </p>
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
</body>

</html>