<?php
    session_start(); 
    require('connect.php');

    // Funkcija priekš testēšanas, lai izvadītu datus
    function tt($value) {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
        exit();
    }

    function dbCheckError($query){
        $errInfo = $query->errorInfo();
        if ($errInfo[0] !== PDO::ERR_NONE) {
            echo $errInfo[2];
            exit();
        }
        return true;
    }

    // Visu rakstu datu saņemšana
    function selectAll($table, $params = []) {
        global $pdo;
        $sql = "SELECT * FROM $table";
        if(!empty($params)) {
            $i = 0;
            foreach ($params as $key => $value){
                if (!is_numeric($value)){
                    $value = "'".$value."'";
                }
                if ($i === 0){
                    $sql = $sql . " WHERE $key = $value";
                }
                else {
                    $sql = $sql . " AND $key = $value";
                }
                $i++;
            }
        }
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    // Viena konkrēta datubāzes raksta saņemšana
    function selectOne($table, $params = []) {
        global $pdo;
        $sql = "SELECT * FROM $table";
        if(!empty($params)) {
            $i = 0;
            foreach ($params as $key => $value){
                if (!is_numeric($value)){
                    $value = "'".$value."'";
                }
                if ($i === 0){
                    $sql = $sql . " WHERE $key = $value";
                }
                else {
                    $sql = $sql . " AND $key = $value";
                }
                $i++;
            }
        }
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetch();
    }

    // Funkcija priekš ievietošanas datubāzē
    function insert($table, $params) {
        global $pdo;
        $i = 0;
        $coll = '';
        $mask = '';
        foreach ($params as $key => $value){
            if ($i === 0){
                $coll = $coll . "$key";
                $mask = $mask."'" . "$value"."'";
            }
            else {
                $coll = $coll . ", $key";
                $mask = $mask.", '". "$value"."'";
            }
            $i++;

        }
        $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

        $query = $pdo->prepare($sql);
        $query->execute($params);
        dbCheckError($query);
        return $pdo->lastInsertId();
    }

    // Atajunošanas funkcija
    function update($table, $id, $params) {
        global $pdo;
        $i = 0;
        $str = '';
        foreach ($params as $key => $value){
            if ($i === 0){
                $str = $str . $key . " = '" . $value. "'";
            }
            else {
                $str = $str .", ". $key . " = '" . $value. "'";
            }
            $i++;

        }
        $sql = "UPDATE $table SET $str WHERE id = $id";
        $query = $pdo->prepare($sql);
        $query->execute($params);
        dbCheckError($query);
    }
    $param = [
        'admin' => '0',
    ];

    update('users', 14, $param);


    // Dzēšanas funkcija
    function delete($table, $id) {
        global $pdo;
        $sql = "DELETE FROM $table WHERE id = $id";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
    }

    // JOIN funkcija ar rakstu un lietotāju tabulām autora radīšanai
    function selectAllFromPostsWithUsers($table1, $table2){
        global $pdo;
        $sql = "
        SELECT
        t1.id,
        t1.title,
        t1.img,
        t1.content,
        t1.status,
        t1.id_topic,
        t1.created_date,
        t2.username 
        FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id" ;
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    // JOIN funkcija priekš autora radīšanas izmantojot paģināciju
    function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset){
        global $pdo;
        $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status=1 ORDER by p.created_date DESC LIMIT $limit OFFSET $offset";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    // Autora radīšana pie raksta
    function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id){
        global $pdo;
        $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id=$id";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetch();
    }

    // Meklēšanas funkcija
    function seacrhInTitileAndContent($text, $table1, $table2){
        $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
        global $pdo;
        $sql = "SELECT 
            p.*, u.username 
            FROM $table1 AS p 
            JOIN $table2 AS u 
            ON p.id_user = u.id 
            WHERE p.status=1
            AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    // Rindu skaitīšana tabulā (lapu šķirošanai)
    function countRow($table){
        global $pdo;
        $sql = "SELECT Count(*) FROM $table WHERE status = 1";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchColumn(); // Atgriež vienu kolonnu no rezultātu kopas
    }

    // Funkcija priekš skatītāju skaitu atjaunošanas
    function views_update ($id) {
        global $pdo;
        $sql = "UPDATE posts SET views = views + 1 WHERE id = $id";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
    }

    // Funkcija priekš rakstu šķirošanas pa datumu dilstošā secība 
    function showPostsInDescOrder ($table1) {
        global $pdo;
        $sql = "SELECT * FROM $table1 WHERE status = 1 ORDER by views DESC LIMIT 5";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();

    }

    // Funkcija priekš rakstu šķirošanas nejaušā secībā
    function showRandomPosts ($table1) {
        global $pdo;
        $sql = "SELECT * FROM $table1 WHERE status = 1 ORDER by RAND() LIMIT 5";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    // Funkcija priekš rakstu radīšanas pēc kategorijām galvenā lapā
    function showPostsByCategoriesOnMainPage ($table1) {
        global $pdo;
        $sql = "SELECT * FROM $table1 WHERE status = 1 ORDER by views";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();

    }

?>