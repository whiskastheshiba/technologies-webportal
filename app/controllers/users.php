<?php

include SITE_ROOT . "/app/database/db.php";

//$isSubmit = false;
$errMsg = [];
//$regStatus = '';

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

$users = selectAll('users');

// Code for registration form
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
    $admin = 0;
    $login = trim($_POST['login']); //trims spaces
    $email = trim($_POST['mail']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);



    if($login === '' || $email === '' || $passF === '') {
        array_push($errMsg, "Not all fields are filled!");
    }elseif (mb_strlen($login, 'UTF8') <2){
        array_push($errMsg, "Login should be more than 2 symbols");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Password should be equal!");
    }
    
    else {
        $existence = selectOne('users', ['email' => $email]);
        if (!empty($existence['email']) && $existence['email'] === $email){
            array_push($errMsg, "User with that email already exists!");
        }else {
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        $post = [
            'admin' => $admin,
            'username' => $login,
            'email' => $email,
            'password' => $pass
        ];
    
        $id = insert('users', $post);
        $user = selectOne('users', ['id' => $id]);

        userAuth($user);
        //$last_row = selectOne('users',  ['id' => $id]);
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
        array_push($errMsg, "Not all fields are filled!");
    }else {
        $existence = selectOne('users', ['email' => $email]);
        //tt($existence);
        if($existence && password_verify($pass, $existence['password'
        ])) {
        userAuth($existence);
            //Login
        }else{
            array_push($errMsg, "Email or password is incorrect!");
            //Login error
        }
    }
    
}
else {
    $email = '';
}

// Code for adding an admin user
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])) {

    
    $admin = 0;
    $login = trim($_POST['login']); //trims spaces
    $email = trim($_POST['mail']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);



    if($login === '' || $email === '' || $passF === '') {
        array_push($errMsg, "Not all fields are filled!");
    }elseif (mb_strlen($login, 'UTF8') <2){
        array_push($errMsg, "Login should be more than 2 symbols");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Password should be equal!");
    }
    
    else {
        $existence = selectOne('users', ['email' => $email]);
        if (!empty($existence['email']) && $existence['email'] === $email){
            array_push($errMsg, "User with that email already exists!");
        }else {
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        if (isset($_POST['admin'])){
            $admin = 1;
        };
        $user = [
            'admin' => $admin,
            'username' => $login,
            'email' => $email,
            'password' => $pass
        ];
    
        $id = insert('users', $user);
        $user = selectOne('users', ['id' => $id]);

        userAuth($user);
        //$last_row = selectOne('users',  ['id' => $id]);
        //tt($post);
    }
    
}
}
else {
    $login = ''; //trims spaces
    $email = '';
}

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {

    $id = $_GET['delete_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . 'admin/users/index.php');
}

//USER EDIT IN ADMIN PANEL

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {

    $user = selectOne('users', ['id' => $_GET['edit_id']]);
    
    $id = $user['id'];
    $admin = $user['admin'];
    $username = $user['username'];
    $email = $user['email'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])) {
    
    $id = $_POST['id'];
    $mail = trim($_POST['mail']); //trims spaces
    $login = trim($_POST['login']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);
    $admin = isset($_POST['admin']) ? 1 : 0; //if publish is set then it will be 1, or 0 if not

    if($login === '') {
        array_push($errMsg, "Not all fields are filled!");
    }elseif (mb_strlen($login, 'UTF8') <2){
        array_push($errMsg, "Login should be more than 2 symbols");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Password should be equal!");
    }
    else {
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        if (isset($_POST['admin'])){
            $admin = 1;
        };
        $user = [
            'admin' => $admin,
            'username' => $login,
            'password' => $pass
        ];

        $user = update('users', $id, $user);
        header('location: ' . BASE_URL . 'admin/users/index.php');

    }    
}else {
    $login = '';
    $email = '';
}

//UPDATE function for 'status' changing
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) { 

    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('posts', $id, ['status' => $publish]);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
    exit();
}

?>