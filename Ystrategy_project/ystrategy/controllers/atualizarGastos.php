<?php


require_once 'conexao.php';
require_once 'chamadas_sql.php';

// Verifica se já executou hoje
$lastRunFile = '/var/www/seusite.com/cron/last_run_gastos_fixos.txt';
$today = date('Y-m-d');

if (!file_exists($lastRunFile) || file_get_contents($lastRunFile) !== $today) {
    try {
        $conexao = getDatabaseConnection();
        $_SESSION['userID'] = 1; // ID do admin
        
        $affectedRows = update_is_active_fixos($conexao);
        
        file_put_contents($lastRunFile, $today);
        
        // Log
        file_put_contents(
            '/var/www/seusite.com/logs/gastos_fixos_web.log',
            date('Y-m-d H:i:s') . " - Registros atualizados: " . ($affectedRows !== false ? $affectedRows : 0) . PHP_EOL,
            FILE_APPEND
        );
    } catch (Exception $e) {
        file_put_contents(
            '/var/www/seusite.com/logs/gastos_fixos_web_errors.log',
            date('Y-m-d H:i:s') . " - Erro: " . $e->getMessage() . PHP_EOL,
            FILE_APPEND
        );
    }
}

// Redireciona ou exibe mensagem
header('Location: /'); // Ou exibe uma mensagem
exit;