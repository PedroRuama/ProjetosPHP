

<?php 
if($_POST['cep']){ ?>
            <p>
                <?php  $endereco = get_endereco($_POST['cep']); ?>
                <?php  $endereco->cep; ?>
                <?php  $endereco->logradouro; ?>
                <?php  $endereco->bairro; ?>
                <?php  $endereco->localidade; ?>
                <?php  $endereco->uf; ?>
            </p>

            <?php
}

{?>

            <?php } ?>
