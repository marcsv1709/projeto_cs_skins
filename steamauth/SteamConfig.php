<?php
// Carrega as variáveis de ambiente (chaves de API, etc.) do .env
// Ajuste o caminho se sua estrutura de pastas for diferente
require_once __DIR__ . '/../class/config.php';

//Version 3.2
$steamauth['apikey'] = STEAM_API_KEY; // Your Steam WebAPI-Key found at https://steamcommunity.com/dev/apikey
$steamauth['domainname'] = STEAM_DOMAIN_NAME; // The main URL of your website displayed in the login page
$steamauth['logoutpage'] = STEAM_LOGOUT_PAGE; // Page to redirect to after a successfull logout (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!
$steamauth['loginpage'] = STEAM_LOGIN_PAGE; // Page to redirect to after a successfull login (from the directory the SteamAuth-folder is located in) - NO slash at theestringm_LOGIN_PAGE']' Array. </div>");}
if (empty($steamauth['domainname'])) {$steamauth['domainname'] = $_SERVER['SERVER_NAME'];}
if (empty($steamauth['logoutpage'])) {$steamauth['logoutpage'] = $_SERVER['PHP_SELF'];}
if (empty($steamauth['loginpage'])) {$steamauth['loginpage'] = $_SERVER['PHP_SELF'];}
?>