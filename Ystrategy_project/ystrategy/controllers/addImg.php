<?php
include('conexao.php');
session_start(); // Faltava iniciar a sessão

error_reporting(E_ALL);
ini_set('display_errors', 1);

function enviarArquivo($error, $name, $tmp_name) {
    include('conexao.php');
    
    if ($error) {
        echo 'Erro ao enviar arquivo de imagem';
        echo "<script>alert('Erro ao enviar arquivo de imagem');</script>";
        echo "<script>history.go(-1)</script>";
        return false;
    }

    if (!isset($_SESSION['userID'])) {
        die("Usuário não autenticado");
    }
    
    echo $id = $_SESSION['userID'];
    echo "<br>";
    echo $pasta = './imgs_users/';
    echo "<br>";
    
    // Verifica e cria a pasta se não existir
    if (!file_exists($pasta)) {
        mkdir($pasta, 0777, true);
    }
    
    echo $extensao = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    echo "<br>";
    
    // if (!in_array($extensao, ["jpg", "png", "jpeg"])) {
    //     die("Tipo de arquivo não aceito. Use PNG, JPG ou JPEG.");
    // }
    
    // Gera um nome único para o arquivo
    echo $novoNomeDoArquivo = uniqid('img_') . '_' . $id . '.' . $extensao;
    echo "<br>";
    echo $caminhoCompleto = $pasta . $novoNomeDoArquivo;
    
  
    if (move_uploaded_file($tmp_name, ".".$caminhoCompleto)) {
        // Primeiro verifica se já existe registro para este ID
        $check_stmt = $conexao->prepare("SELECT userID FROM imgs_users WHERE userID = ?");
        $check_stmt->bind_param("i", $id);
        $check_stmt->execute();
        $check_stmt->store_result();
        
        if ($check_stmt->num_rows > 0) {
            // Já existe registro - faz UPDATE
            $stmt = $conexao->prepare("UPDATE imgs_users SET path = ?, extensao = ? WHERE userID = ?");
            $stmt->bind_param("ssi", $caminhoCompleto, $extensao, $id);
            
            if ($stmt->execute()) {
                echo "Imagem atualizada com sucesso!";
                return true;
            } else {
                echo "Erro ao atualizar no banco de dados: " . $conexao->error;
                return false;
            }
        } else {
            // Não existe registro - faz INSERT
            $stmt = $conexao->prepare("INSERT INTO imgs_users(userID, path, extensao) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $id, $caminhoCompleto, $extensao);
            
            if ($stmt->execute()) {
                echo "Imagem cadastrada com sucesso!";
                return true;
            } else {
                echo "Erro ao cadastrar no banco de dados: " . $conexao->error;
                return false;
            }
        }
    }
}

// Verifica se o arquivo foi enviado (corrigido para o nome do campo do formulário)
if (isset($_FILES['img_perfil_'])) {
    $arquivo = $_FILES['img_perfil_'];
    
    // Verifica se é um upload único (não múltiplo)
    if (is_array($arquivo['name'])) {
        // Para uploads múltiplos (se necessário no futuro)
        foreach ($arquivo['name'] as $index => $arq) {
            $deu_certo = enviarArquivo(
                $arquivo['error'][$index], 
                $arquivo['name'][$index], 
                $arquivo['tmp_name'][$index]
            );
        }
    } else {
        // Para upload único (seu caso atual)
        $deu_certo = enviarArquivo(
            $arquivo['error'], 
            $arquivo['name'], 
            $arquivo['tmp_name']
        );
    }
    
    if ($deu_certo) {
        echo "<script>alert('Imagem cadastrada com sucesso!');</script>";
        echo "<script>location.href='../config.php';</script>";
    } else {
        echo "<script>alert('Falha ao enviar arquivo');</script>";
        echo "<script>history.go(-1);</script>";
    }
} else {
    echo "<script>alert('Nenhum arquivo enviado.');</script>";
    echo "<script>history.go(-1);</script>";
}
?>