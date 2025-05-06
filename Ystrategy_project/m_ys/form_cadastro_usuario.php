<?php

include('menu.php');

?>

<?php

$user = $_SESSION['usuario'];

// VISÃO consulta pedido em aberto

$sessin_tabela =  mysqli_query($conexao, "select * from cadastro where USUARIO = '$user' and (sessao = 'USUARIO' or sessao = 'ADMINISTRADOR')") or die($mysqli_error);

while ($pagina = $sessin_tabela->fetch_assoc()) {

    $row = mysqli_num_rows($sessin_tabela);

    $_SESSION['pagina'] =  $pagina['USUARIO'];
}

?>







<body>


    <script type='text/javascript'>
        $(document).ready(function() {

            $("input[name='nome_cliente']").blur(function() {

                var $telefone_cliente_pedido = $("input[name='telefone_cliente']");

                var $email_cliente = $("input[name='email_cliente']");

                var $senha_cliente = $("input[name='senha_cliente']");



                $.getJSON('f_usuario.php', {

                    matricula: $(this).val()

                }, function(json) {

                    $telefone_cliente_pedido.val(json.telefone_cliente);

                    $senha_cliente.val(json.senha_cliente);

                    $email_cliente.val(json.email_cliente);

                    $com.val(json.com);

                });

            });

        });
    </script>

    <div class="Box-Dashbord">
        <div class="Conteudo-Dashbord">


            <div class="cadastrar">

                <div class="ativo onn">

                    <div class="form">

                        <h1>&nbsp;&nbsp;Cadastro de Usuario</h1>

                        <br>

                        <form action="cadastrar_usuario.php" method="post">

                            &nbsp;&nbsp;

                            <label>Usuario</label>

                            <input size="30" onkeyup="maiuscula(this)" minlength="3" maxlength="45" type="name"

                                name="nome_cliente" id="nome2" value="" required>

                            &nbsp;&nbsp;

                            <label>Senha</label>

                            <input minlength="6" maxlength="12" type="password" name="senha_cliente" id="senha2" value=""

                                required>

                            &nbsp;&nbsp;

                            <label>Email</label>

                            <input size="25" minlength="1" onkeyup="minuscula(this)" maxlength="35" type="email"

                                name="email_cliente" id="email_cliente" value="" required>&nbsp;&nbsp;&nbsp;

                            <label>Telefone de contato</label>

                            <input size="10" minlength="11" maxlength="11" type="numero" name="telefone_cliente" id="telefone"

                                value="" required>



                            <!-- <label for="acesso">Acesso:</label>

                    <select id="acesso" name="acesso">

                        <option value="ATERRO">ATERRO</option>

                        <option value="CACAMBA">CAÇAMBA</option>

                        <option value="CLIENTES">CLIENTES</option>

                        <option value="MOTORISTA">MOTORISTA</option>

                        <option value="VALORES">VALORES</option>

                        <option value="VEICULOS">VEICULOS</option>

                        <option value="MOTORISTA_SERVICO">MOTORISTA_SERVIÇO</option>

                                               <option value="PEDIDO">PEDIDO</option>

                        <option value="CONTAS_RECEBER">CONTAS_RECEBER</option>

                        <option value="USUARIO">USUARIO</option>

                        <option value="Administrador">ADMINISTRADOR</option>

                    </select>

                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <label for="admin">Tipo:</label>

                    <select id="admin" name="admin">

                        <option value="USUARIO">USUARIO</option>

                        <option value="ADMIN">ADMIN</option>

                    </select> -->

                            &nbsp;&nbsp;

                            <label for="permissao">Permissão:</label>

                            <select id="permissao" name="permissao" required>

                                <option value=""></option>

                                <option value="Geral">Geral</option>

                                <option value="Usuario">Usuario</option>

                            </select><br><br>

                            &nbsp;&nbsp;&nbsp;&nbsp;<button input type="submit" name="acao">ADICIONAR</button>

                        </form>

                        <body>

                            <br>

                            <div class="table-wrapper">

                                <table BORDER="1" cellpadding="15">



                                    <thead>



                                        <tr>

                                            <th>USUARIO</th>

                                            <th>TELEFONE</th>

                                            <!-- <th>ACESSO</th>

                        <th>TIPO</th> -->

                                            <th>PERMISSÃO</th>

                                            <th>EMAIL</th>

                                            <th>&nbsp;❌&nbsp;</th>

                                    </thead>

                                    <tbody>

                                        <?php



                                        $user_s =  mysqli_query($conexao, "select * from cadastro  order by USUARIO") or die($mysqli_error);

                                        while ($cad = $user_s->fetch_assoc()) {

                                        ?>

                                            <tr>



                                                <td><a>&nbsp;&nbsp;<?php echo $cad['USUARIO']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                                                <td><a>&nbsp;&nbsp;<?php echo $cad['telefone']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                                                <!--  <td><a>&nbsp;&nbsp;<?php echo $cad['sessao']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                        <td><a>&nbsp;&nbsp;<?php echo $cad['acao']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td> -->

                                                <td><a>&nbsp;&nbsp;<?php echo $cad['acao']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                                                <td><a>&nbsp;&nbsp;<?php echo $cad['email']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                                                <th><a href="?update_usuario=<?PHP echo $cad['Codigo_cliente'] ?>">&nbsp;🗑️&nbsp;</a></th>







                                            </tr>



                                        <?php

                                        }



                                        ?>

                                    </tbody>

                                </table>

                        </body>



                    </div>

                </div>



            </div>





            <script src="./js/mudar.js"></script>
        </div>
    </div>
</body>

<?php


?>