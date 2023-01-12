<?php
    // Bibliotēkas izmantošana, lai izveidotu savienojumu ar datu bāzi
    $driver = 'mysql';
    $host = 'localhost';
    $db_name = 'github';
    $db_user = 'root';
    $db_pass = 'mysql';
    $charset = 'utf8mb4';
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // PDO kļūdu ziņošanas režīms, apzīmē kļūdu, ko izraisījis PDO
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ];
    try{
        $pdo = new PDO( // konstruktors, izveido PDO instance, kas attēlo savienojumu ar datu bāzi
            $dsn = "$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options
        );
    }catch (PDOException $i){
        die("MYSQL ERROR");
}