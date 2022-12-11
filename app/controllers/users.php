<?php

include "app/database/db.php";

$isSubmit = false;
$errMsg = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = 0;
    $login = trim($_POST['login']); //trims spaces
    $email = trim($_POST['mail']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    if($login === '' || $email === '' || $passF === '') {
        $errMsg = "Not all fields are filled!";
    }elseif (mb_strlen($login, 'UTF8') <2){
        $errMsg = "Login should be more than 2 symbols";
    }elseif ($passF !== $passS) {
        $errMsg = "Password should be equal!";
    }
    else {
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        $post = [
            'admin' => $admin,
            'username' => $login,
            'email' => $email,
            'password' => $pass
        ];
    
        //$id = insert('test', $post);
        //$last_row = selectOne('test',  ['id' => $id]);
        tt($post);
    }
    
}

else {
    echo 'GET';
    $login = ''; //trims spaces
    $email = '';
}

?>