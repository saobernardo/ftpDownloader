<?php

require_once __DIR__.'/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$ftp_server = $_ENV['FTP_HOST'];
$ftp_user = $_ENV['FTP_USER'];
$ftp_pswd = $_ENV['FTP_PSWD'];
$remote_file = $_ENV['FTP_FILE'];
$local_file = $_ENV['FTP_DESTINATION'];

$conn = ftp_connect($ftp_server);
$login = ftp_login($conn, $ftp_user, $ftp_pswd);

if(!$login){
  echo 'Login faiô';
  exit();
}

ftp_pasv($conn, true);

echo "Arquivo baixando...\n\n";

if(ftp_get($conn, $local_file, $remote_file, FTP_BINARY)){
  echo "Arquivo baixou com sucesso nessa poarr!";
}
else{
  echo "Faiô ao baixar arquivo, uai";
}

ftp_close($conn);