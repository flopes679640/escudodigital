<?php
//Página de configuração exemplo para demonstrar o código usado na configuração
date_default_timezone_set('America/Sao_Paulo');

define('DB_HOST', 'localhost');
define('DB_NAME', 'escudo_digital');
define('DB_USER', '***********'); //Usuário fictício
define('DB_PASS', '***********'); //Senha fictícia

// Senha para abrir o painel admin.php
define('ADMIN_PASS', 'uninter2026');

function getPDO(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}