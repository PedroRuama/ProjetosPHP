<?php
    include_once("controllers/conexao.php");
    $id = $_GET['IdView'];
    $query = mysqli_query($conexao, "select * from pessoas where id = $id");

    $dados = mysqli_fetch_array($query);
   
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadasrto</title>
    <link rel="stylesheet" href="styles/cad.css">
    <script src="scripts/vermais.js"></script>
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
                            <input type="search" required name="id" autocomplete="off" value="<?= $id ?>"  disabled  class="disabili">
                            <label for="id"> Id</label>
                        </div>
                      
                        <div class="inputGroup" id="inp-nome">
                            <input type="search" required autocomplete="off" name="nome" value="<?= $dados['nome']?>" class="obrigatorio" disabled>
                            <label for="name">Nome </label>
                            
                        </div>
                        <div class="inputGroup" id="inp-sobrenome">
                            <input type="search" name="sobrenome" required autocomplete="off" value="<?= $dados['sobrenome']?>" disabled>
                            <label for="">Sobrenome</label>
                        </div>
                    </div>
                    <div class="hr"></div>
                    <div  class="aling">
                        <div class="inputGroup" id="inp-cpf">
                            <input type="search" required name="cpf" autocomplete="off" oninput="mascaraCpf(this)"  value="<?= $dados['cpf']?>" disabled>
                            <label for="id"> CPF</label>
                        </div>
                      
                        <div class="inputGroup" id="inp-rg">
                            <input type="search" required name="rg" autocomplete="off"  value="<?= $dados['rg']?>" disabled>
                            <label for="">RG</label>
                        </div>
                        <div class="inputGroup" id="inp-tel">
                            <input type="search" required autocomplete="off" name="tel" oninput="mascaraTel(this)"  value="<?= $dados['tel']?>" disabled>
                            <label for="">Telefone</label>
                        </div>                                                
                    </div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-end">
                            <input type="search" required autocomplete="off" name="ende"  value="<?= $dados['ende']?>" disabled>
                            <label for="">Endereço</label>
                        </div>
                        
                        <div class="inputGroup" id="inp-social">
                            <input type="search" required autocomplete="off" name="social"  value="<?= $dados['social']?>" disabled>
                            <label for="">@Social</label>
                        </div>     
                    </div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-email">
                            <input type="search" required autocomplete="off" name="email"  value="<?= $dados['email']?>" disabled>
                            <label for="">Email</label>
                        </div>     
                    </div>
                    <div class="hr"></div>
                    <div class="aling" id="Emp">
                        <div class="inputGroup" id="inp-valEmp">
                            <input type="search" required autocomplete="off" id="val_emp" name="val_emp" oninput="mascaraMoeda(this, event)"
                             class="obrigatorio" onkeyup="dev()" value="<?= $dados['val_emp']?>" disabled>
                            <label for="">R$ Valor Emprestimo</label> 
                            
                        </div>  
                        <div class="inputGroup" id="inp-juros">
                            <input type="search" required autocomplete="off" name="juros" class="obrigatorio" onkeyup="dev()"
                             id="juros" oninput="jurosmascara(this)"  value="<?= $dados['juros']?>" disabled>
                            <label for="">% Juros</label>
                        </div>
                        <div class="inputGroup" id="inp-dataEmp">
                            <input type="date" required autocomplete="off" name="data_emp" class="obrigatorio" id="data_emp" oninput="dev()"
                            value="<?= $dados['data_emp']?>" disabled>
                            <label for="">Data Emprestimo</label>
                        </div>  
                                              
                        <div class="inputGroup" id="inp-dataDev">
                            <input type="date" required autocomplete="off" name="data_dev" class="obrigatorio" id="data_dev" oninput="dev()"
                            value="<?= $dados['data_dev']?>" disabled>
                            <label for="">Data Devolução</label>
                        </div>
                    </div>
                    <div class="aling">
                        <div class="inputGroup" id="inp-valEmp">
                            <input type="search" required autocomplete="off" oninput="mascaraMoeda(this, event)" name="val_dev" disabled required id="val_dev" class="disabili"
                            value="<?= $dados['val_dev']?>" >
                            <label for="">R$ Devolução</label>
                        </div>  

                        <div class="div_checkbox" id="disabili">
                            <div style="display: flex;">
                                <label class="label_check"  id="divida_label" onclick="check(this)">EM DIVIDA
                                    <input type="checkbox" id="inp-divida" name="situacao" value="Em Divida" checked>
                                    <span class="checkmark"></span>
                                </label>
                                <div class="div_img" onclick="divParcelas()">
                                    <img src="icons/seta-direita.png" alt="seta" id="img_parcela">
                                    <div id="div_parcelas">
                                        <div class="inputGroup">
                                            <p class="label_select">Nº Parcelas</p> 
                                            <select name="parcela">
                                                <option value="1x">1x</option>
                                                <option value="2x">2x</option>
                                                <option value="3x">3x</option>
                                                <option value="6x">6x</option>
                                                <option value="12x">12x</option>
                                            </select>
                                        </div> 
                                        <div class="inputGroup">
                                            <p class="label_select"> Nº Pagas</p> 
                                            <select name="par_pagas">
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
                                    </div>
                                </div>
                            </div>
                            
                            <input type="text" id="situacao" value="<?= $dados['situacao']?>" style="display: none">

                            <label class="label_check" id="quitado_label" onclick="check(this)" >QUITADO
                                <input type="checkbox" id="inp-quitado" name="situacao" value="Quitado">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        
                        <div class="inputGroup">
                            <p class="label_select">Forma de pagamento</p> 
                            <input type="text" id="pag" value="<?= $dados['pagamento']?>" style="display: none">
                            <select name="pagamento" id="pagamento" disabled>
                                <option value="vazio"></option>
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
                            <textarea name="detalhes" id="detalhes" cols="30" rows="10" required disabled></textarea>
                            <label for="">Detalhes/Observações</label>
                        </div>
                    </div>
                    <div class="hr"></div>
                    <div class="btns">
                        <button type="button" onclick="editar()">Editar Dados</button>
                        <button type="submit" onclick="Submit()">Salvar</button>
                    </div>
                    
                </form>
               
                <form action="controllers/excluir.php" name="" method="post" class="btns" id="forms_ex"> 
                    <input type="txt" name="IdsExcluir" id="inputIds_excluir" style="display: none" value="<?= $id ?>">
                    <button class="acoes" onclick="confirmExcluir(this)" id="excluir" type="button">Excluir </button>
                </form>
            </div>  
        
        </div>
    </div>
</body>
</html>