<?php

// 1. Carrega o autoloader do Composer (para ter acesso à biblioteca dotenv)
require __DIR__ . '/vendor/autoload.php';

// 2. Carrega o arquivo .env da raiz do projeto
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// --- Configurações Não-Sensíveis ---
// Você pode manter valores que não são secretos aqui
define('SKIN_LANGUAGE', 'skins_en');
define('WEB_STYLE_DARK', true);

// --- Configurações Sensíveis (Lidas do .env) ---
// Usamos getenv() para ler o valor. 
// O '?:' define um valor padrão caso a variável não exista no .env

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'skins');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: ''); // Padrão é senha vazia
define('STEAM_API_KEY', getenv('STEAM_API_KEY'));

// --- Outras Configurações (Lidas do .env) ---
define('STEAM_DOMAIN_NAME', getenv('STEAM_DOMAIN_NAME') ?: '');
define('STEAM_LOGOUT_PAGE', getenv('STEAM_LOGOUT_PAGE') ?: '');
define('STEAM_LOGIN_PAGE', getenv('STEAM_LOGIN_PAGE') ?: '');

?>