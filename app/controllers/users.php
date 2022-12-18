<?php

include "app/database/db.php";

$isSubmit = false;
$errMsg = '';
$regStatus = '';

function userAuth($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    if($_SESSION['admin']){
        header('location: ' . BASE_URL . "admin/posts/index.php");
    }else{
        header('location: ' . BASE_URL);
    }
}

// Code for registration form
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
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
        $existence = selectOne('test', ['email' => $email]);
        if (!empty($existence['email']) && $existence['email'] === $email){
            $errMsg = "User with that email already exists!";
        }else {
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        $post = [
            'admin' => $admin,
            'username' => $login,
            'email' => $email,
            'password' => $pass
        ];
    
        $id = insert('test', $post);
        $user = selectOne('test', ['id' => $id]);

        userAuth($user);
        //$last_row = selectOne('test',  ['id' => $id]);
        //tt($post);
    }
    
}
}
else {
    $login = ''; //trims spaces
    $email = '';
}

//Code for authorisation from
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
    $email = trim($_POST['mail']); //trims spaces
    $pass = trim($_POST['password']);

    if($email === '' || $pass === '') {
        $errMsg = "Not all fields are filled!";
    }else {
        $existence = selectOne('test', ['email' => $email]);
        //tt($existence);
        if($existence && password_verify($pass, $existence['password'
        ])) {
        userAuth($existence);
            //Login
        }else{
            $errMsg = "Email or password is incorrect!";
            //Login error
        }
    }
    
}
else {
    $email = '';
}

?>