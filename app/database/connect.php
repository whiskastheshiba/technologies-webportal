<?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'github';
$db_user = 'root';
$db_pass = 'mysql';
$charset = 'utf8mb4';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try{
    $pdo = new PDO(
        $dsn = "$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options
    );
}catch (PDOException $i){
    die("MYSQL ERROR");
}