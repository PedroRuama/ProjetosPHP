<?php
    include_once("controllers/conexao.php");
    
    $query = mysqli_query($conexao, "select id from teste order by id desc limit 1");

    $ultimo_cad = mysqli_fetch_array($query);
    $id = $ultimo_cad['id'] + 1;
    
    
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

            <a href="gerenciar.php" class="btn">

                <div  id="cancelar_div">
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
                    <div  class="aling">
                        <div class="inputGroup" id="inp-id">
                            <input type="search" required name="id" autocomplete="off" value="<?= $id ?>"  disabled >
                            <label for="id"> Id</label>
                        </div>
                      
                        <div class="inputGroup" id="inp-nome">
                            <input type="search" required autocomplete="off" name="nome" class="obrigatorio">
                            <label for="name">Name </label>
                            
                        </div>
                        <div class="inputGroup" id="inp-sobrenome">
                            <input type="search" required autocomplete="off" >
                            <label for="">Sobrenome</label>
                        </div>
                    </div>
                    <div class="hr"></div>
                    <div  class="aling">
                        <div class="inputGroup" id="inp-cpf">
                            <input type="search" required value="" autocomplete="off">
                            <label for="id"> CPF</label>
                        </div>
                      
                        <div class="inputGroup" id="inp-rg">
                            <input type="search" required autocomplete="off" >
                            <label for="">RG</label>
                        </div>
                        <div class="inputGroup" id="inp-tel">
                            <input type="search" required autocomplete="off" >
                            <label for="">Telefone</label>
                        </div>                                                
                    </div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-end">
                            <input type="search" required autocomplete="off" >
                            <label for="">Endereço</label>
                        </div>
                        
                        <div class="inputGroup" id="inp-social">
                            <input type="search" required autocomplete="off" >
                            <label for="">@Social</label>
                        </div>     
                    </div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-email">
                            <input type="search" required autocomplete="off" >
                            <label for="">Email</label>
                        </div>     
                    </div>
                    <div class="hr"></div>
                    <div class="aling" id="Emp">
                        <div class="inputGroup" id="inp-valEmp">
                            <input type="search" required autocomplete="off"  oninput="mascaraMoeda(this, event)" class="obrigatorio">
                            <label for="">R$ Valor Emprest</label> 
                            
                        </div>  
                        <div class="inputGroup" id="inp-dataEmp">
                            <input type="date" required autocomplete="off" name="nasc" class="obrigatorio">
                            <label for="">Data Emprestimo</label>
                        </div>  
                                              
                        <div class="inputGroup" id="inp-dataDev">
                            <input type="date" required autocomplete="off" class="obrigatorio">
                            <label for="">Data Devolução</label>
                        </div>
                        <div class="inputGroup" id="inp-juros">
                            <input type="search" required autocomplete="off" class="obrigatorio">
                            <label for="">% Juros</label>
                        </div>
                    </div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-valEmp" class="obrigatorio">
                            <input type="search" required autocomplete="off" oninput="mascaraMoeda(this, event)">
                            <label for="">R$ Devolução</label>
                        </div>  

                        <div class="inputGroup">
                            <p id="pagamento">Forma de pagamento</p> 
                            <select name="pagamento" id="">
                                <option value="Debito"></option>
                                <option value="Debito">Debito</option>
                                <option value="Credito">Credito</option>
                                <option value="Pix">Pix</option>
                                <option value="Transferencia">Trasferencia</option>
                                
                            </select>
                            
                        </div>  

                    </div>
                    <div class="hr"></div>
                    <div class="aling" id="aling_obs">
                        <div class="inputGroup" id="inp-obs">
                            <textarea name="detalhes" id="" cols="30" rows="10" required></textarea>
                            <label for="">Detalhes/Observações</label>
                        </div>
                    </div>
                    <div class="hr"></div>
                    <div class="btns">
                        <button type="submit" onclick="Submit()">Enviar</button>
                        <button type="reset"> Limpar Tudo</button>
                        
                    </div>
                   
                </form>
            </div>  
        
        </div>
    </div>
</body>
</html>