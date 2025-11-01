<?php

// 1. Carrega o autoloader do Composer
require __DIR__ . '/../vendor/autoload.php';

// 2. Carrega o .env APENAS se o arquivo existir (desenvolvimento local)
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

// --- Configurações Não-Sensíveis ---
define('SKIN_LANGUAGE', 'skins_en');
define('WEB_STYLE_DARK', true);

// --- Configurações Sensíveis (Lidas do Ambiente) ---

// Lógica de conexão inteligente para Local / Railway

// PRIMEIRO: Tenta usar as variáveis separadas do Railway (forma preferida)
if (getenv('MYSQL_HOST')) {
    define('DB_HOST', getenv('MYSQL_HOST'));
    define('DB_PORT', getenv('MYSQL_PORT') ?: '3306');
    define('DB_NAME', getenv('MYSQL_DATABASE'));
    define('DB_USER', getenv('MYSQL_USER'));
    define('DB_PASS', getenv('MYSQL_PASSWORD'));
} 
// SEGUNDO: Se não achar, tenta usar a URL de conexão (outra forma do Railway)
elseif (getenv('DATABASE_URL') || getenv('MYSQL_URL')) {
    // Pega qualquer variável de URL que existir
    $dbUrl = getenv('DATABASE_URL') ?: getenv('MYSQL_URL');
    
    // Faz o "parse" da URL para extrair as partes
    $dbConfig = parse_url($dbUrl);
    
    define('DB_HOST', $dbConfig['host']);
    define('DB_PORT', $dbConfig['port'] ?? '3306');
    define('DB_NAME', ltrim($dbConfig['path'], '/')); // Remove a barra "/" inicial
    define('DB_USER', $dbConfig['user']);
    define('DB_PASS', $dbConfig['pass']);
} 
// TERCEIRO: Se não achar nada, usa as variáveis do .env (desenvolvimento local)
else {
    define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('DB_PORT', getenv('DB_PORT') ?: '3306');
    define('DB_NAME', getenv('DB_NAME') ?: 'skins');
    define('DB_USER', getenv('DB_USER') ?: 'root');
    define('DB_PASS', getenv('DB_PASS') ?: ''); // Padrão é senha vazia
}

// --- Outras Configurações (Lidas do .env ou Railway) ---
define('STEAM_API_KEY', getenv('STEAM_API_KEY') ?: '');
define('STEAM_DOMAIN_NAME', getenv('STEAM_DOMAIN_NAME') ?: '');
define('STEAM_LOGOUT_PAGE', getenv('STEAM_LOGOUT_PAGE') ?: '');
define('STEAM_LOGIN_PAGE', getenv('STEAM_LOGIN_PAGE') ?: '');