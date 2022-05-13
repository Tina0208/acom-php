<?php
$db_host = '128.199.180.121';
$db_name = 'acom';
$db_user = 'root';
$db_pass = 'Backend!@#2022Test';

// $db_host = 'localhost';
// $db_name = 'acom';
// $db_user = 'root';
// $db_pass = '1234';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";
$db_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
];
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $db_options);
} catch (PDOException $ex) {
    echo '資料庫錯誤' . $ex->getMessage();
}
