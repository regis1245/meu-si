<?php
// Arquivo: config.php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'meusite');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERRO DE CONEXÃO COM O BANCO DE DADOS: " . $e->getMessage());
}
?>
