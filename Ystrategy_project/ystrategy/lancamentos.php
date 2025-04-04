<?php include("./menu.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css">

</head>
<style>

* {
    --primary-color: #1f293b;
    --secondary-color: #e8491d;
    --terciary-color: #8997b7;
    --gray-color: #c4c4c8;
    --lightgray-color: #d3d3d4;
    --darkgray-color: #8d8d8d;
    --hover-color: #fff;
    --white-color: #f5f5f5;
    --backColor: #1f293b;
    /* --backColor: #384972; */
    /* --backColor: #021954; */
    --blue-color: #021954;
    padding: 0;
    margin: 0;
    font-family: "Poppins", serif;
    font-weight: 300;
    font-style: normal;
    font-size: 14px;
    --arrow-width: 10px;
    --arrow-stroke: 2px;
    padding: 0;
    margin: 0;
    font-family: "Poppins", serif;
}


body {
    background-color: var(--lightgray-color);
    /* background-color: red; */
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}


.main {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    width: 100%;
    max-width: 1400px;
    margin-top: 20px;
}


.summary,
.expenses,
.fixed-expense,
.monthly-budget {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    margin: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile {
    flex: 1 1 250px;
    text-align: center;
    display: flex;
    position: relative;
    justify-content: start;
    flex-direction: column;
     align-items: center; /*o align-items esta fazendo sumir o .hrs, por que?; */
}

.profile img {
    border-radius: 50%;
    width: 100px;
    height: 100px;
}

.profile h2 {
    margin: 10px 0;
    font-size: 18px;
    font-weight: 500;
    background-color: white;
    width: 80%;
    border-radius: 10px;
}

.profile .balance {
    font-size: 24px;
    font-weight: 700;
    color: #ff4500;
}
.profile .hrs {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    width: 100%;
}
.profile .hr1 {
    height: 8px;
    width: 70%;
    background-color: #ff4500;
}
.profile .hr2 {
    height: 5px;
    width: 50%;
    background-color: var(--darkgray-color);
}

.summary,
.expenses,
.fixed-expense,
.monthly-budget {
    flex: 1 1 300px;
}

.summary{
    height: 50%;
}

.summary h3,
.expenses h3,
.fixed-expense h3,
.monthly-budget h3 {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 10px;
}

.summary .amount,
.expenses .amount,
.fixed-expense .amount,
.monthly-budget .amount {
    font-size: 36px;
    font-weight: 700;
}

.summary .add,
.summary .sub,
.expenses .add,
.expenses .sub {
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    margin-top: 10px;
    cursor: pointer;
}
.add{
    background-color: rgb(0, 122, 0);
}
.sub{
    background-color: rgb(145, 2, 2);
}



.expenses table,
.monthly-budget table {
    width: 100%;
    border-collapse: collapse;
}

.expenses table th,
.expenses table td,
.monthly-budget table th,
.monthly-budget table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.expenses table th,
.monthly-budget table th {
    background-color: #f5f5f5;
}

.fixed-expense {
    position: relative;
}

.fixed-expense .alert {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: #ff4500;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 12px;
}

.fixed-expense .next-expense {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.fixed-expense .next-expense .date {
    color: #ff4500;
}

.monthly-budget .total {
    display: flex;
}

.monthly-budget .manage {
    background-color: #ff4500;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-align: center;
    margin-top: 10px;* {
        --primary-color: #1f293b;
        --secondary-color: #e8491d;
        --terciary-color: #8997b7;
        --gray-color: #c4c4c8;
        --lightgray-color: #d3d3d4;
        --darkgray-color: #8d8d8d;
        --hover-color: #fff;
        --white-color: #f5f5f5;
        --backColor: #1f293b;
        /* --backColor: #384972; */
        /* --backColor: #021954; */
        --blue-color: #021954;
        padding: 0;
        margin: 0;
        font-family: "Poppins", serif;
        font-weight: 300;
        font-style: normal;
        font-size: 14px;
        --arrow-width: 10px;
        --arrow-stroke: 2px;
        padding: 0;
        margin: 0;
        font-family: "Poppins", serif;
    }
    
    
    body {
        background-color: var(--lightgray-color);
    }
    
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }
    
    
    .main {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        width: 100%;
        max-width: 1200px;
        margin-top: 20px;
    }
    
    .profile,
    .summary,
    .expenses,
    .fixed-expense,
    .monthly-budget {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        margin: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .profile {
        flex: 1 1 250px;
        text-align: center;
    }
   
    .profile img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
    }
    
    .profile h2 {
        margin: 10px 0;
        font-size: 18px;
        font-weight: 500;
    }
    
    .profile .balance {
        font-size: 24px;
        font-weight: 700;
        color: #ff4500;
    }
    .lancamentos_div {
        flex: 50 2 380px;
        text-align: center;
        display: flex;
        width: 100%;
        flex-direction: row;
    }
    
    .summary,
    .expenses,
    .fixed-expense,
    .monthly-budget {
        flex: 1 1 300px;
    }
    
    .summary h3,
    .expenses h3,
    .fixed-expense h3,
    .monthly-budget h3 {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 10px;
    }
    
    .summary .amount,
    .expenses .amount,
    .fixed-expense .amount,
    .monthly-budget .amount {
        font-size: 36px;
        font-weight: 700;
    }
    
    .summary .add, .sub
    .expenses .add {
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-top: 10px;
        cursor: pointer;
    }
    .add{
        background-color: rgb(0, 122, 0);
    }
    .sub{
        background-color: rgb(145, 2, 2);
    }
    
    .expenses table,
    .monthly-budget table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .expenses table th,
    .expenses table td,
    .monthly-budget table th,
    .monthly-budget table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    .expenses table th,
    .monthly-budget table th {
        background-color: #f5f5f5;
    }
    
    .fixed-expense {
        position: relative;
    }
    
    .fixed-expense .alert {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: #ff4500;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
    }
    
    .fixed-expense .next-expense {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
    
    .fixed-expense .next-expense .date {
        color: #ff4500;
    }
    
    .monthly-budget .total {
        display: flex;
    }
    
    .monthly-budget .manage {
        background-color: #ff4500;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
        margin-top: 10px;
        cursor: pointer;
    }
    
    @media (max-width: 768px) {
        .main {
            flex-direction: column;
            align-items: center;
        }
    
        .profile,
        .summary,
        .expenses,
        .fixed-expense,
        .monthly-budget {
            flex: 1 1 100%;
        }
    }
    cursor: pointer;
}

@media (max-width: 768px) {
    .main {
        flex-direction: column;
        align-items: center;
    }

    .profile,
    .summary,
    .expenses,
    .fixed-expense,
    .monthly-budget {
        flex: 1 1 100%;
    }
    .profile{
        width: 80%;
    }

    .lancamentos_div {
        flex: 50 2 380px;
        text-align: center;
        display: flex;
        width: 100%;
        flex-direction: row;
    }
}

</style>

<body>

    <div class="container">
        <div class="main">
            <div class="profile">
                <img alt="Profile Picture" src="https://placehold.co/100x100" />
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

                <div class="summary">
                    <h3>
                        GASTOS ATUAL
                    </h3>
                    <p class="amount ">
                        R$ 1260,00
                    </p>
                    <div class="sub">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
                <div class="summary">
                    <h3>
                        RECEBIMENTOS ATUAL
                    </h3>
                    <p class="amount">
                        R$ 1260,00
                    </p>
                    <div class="add">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="expenses">
                <h3>
                    GASTO TOTAL
                </h3>
                <p class="amount">
                    R$ 537,50
                </p>
                <div class="add">
                    <i class="fas fa-plus">
                    </i>
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