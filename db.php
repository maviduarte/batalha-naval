<?php
// Configurações do banco de dados
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'batalha_naval_db';

// Tenta conectar ao banco de dados
try {
    // Conexão com PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Define o modo de erro do PDO para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Caso ocorra erro, exibe a mensagem
    echo "Erro de conexão: " . $e->getMessage();
}
?>
