<?php
// Arquivo: logout.php
session_start();
$_SESSION = array(); // Limpa as variáveis de sessão
session_destroy();   // Destrói a sessão em si
header("location: index.php");
exit;
?>