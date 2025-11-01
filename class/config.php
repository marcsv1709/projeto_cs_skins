<?php

// 1. Carrega o autoloader do Composer
require __DIR__ . '/../vendor/autoload.php';

// 2. Carrega o .env APENAS se o arquivo existir (desenvolvimento local)
//    No Railway, este arquivo NÃO deve existir, e as variáveis virão do ambiente.
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

// --- Configurações Não-Sensíveis ---
define('SKIN_LANGUAGE', 'skins_en');
define('WEB_STYLE_DARK', true);

// --- Configurações Sensíveis (Lidas do Ambiente) ---

// O Railway injeta suas próprias variáveis de banco de dados (ex: MYSQL_HOST, MYSQL_DATABASE).
// O código abaixo checa por elas PRIMEIRO. 
// Se não encontrar (ex: no seu PC local), ele usa as variáveis do seu .env (DB_HOST, etc.).

define('DB_HOST', getenv('MYSQL_HOST') ?: getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('MYSQL_PORT') ?: getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('MYSQL_DATABASE') ?: getenv('DB_NAME') ?: 'skins');
define('DB_USER', getenv('MYSQL_USER') ?: getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('MYSQL_PASSWORD') ?: getenv('DB_PASS') ?: '');

// --- Outras Configurações (Lidas do Ambiente) ---
// Estas variáveis você deve adicionar manualmente no painel do Railway

define('STEAM_API_KEY', getenv('STEAM_API_KEY') ?: '');
define('STEAM_DOMAIN_NAME', getenv('STEAM_DOMAIN_NAME') ?: '');
define('STEAM_LOGOUT_PAGE', getenv('STEAM_LOGOUT_PAGE') ?: '');
define('STEAM_LOGIN_PAGE', getenv('STEAM_LOGIN_PAGE') ?: '');