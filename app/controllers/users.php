<?php
    include SITE_ROOT . "/app/database/db.php";

    $errMsg = [];

    // Sesiju izveidošana, kad cilvēks ieiet savā kontā
    function userAuth($user){
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['username'];
        $_SESSION['admin'] = $user['admin'];
        if($_SESSION['admin'] == 1){
            header('location: ' . BASE_URL . "admin/users/index.php");
        }
        else{
            header('location: ' . BASE_URL);
        }
    }

    $users = selectAll('users');

    // Reģistrācijas funkcija
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {

        $admin = 0;
        $login = trim($_POST['login']); //trims spaces
        $email = trim($_POST['mail']);
        $passF = trim($_POST['pass-first']);
        $passS = trim($_POST['pass-second']);

        if($login === '' || $email === '' || $passF === '') {
            array_push($errMsg, "Visi lauki ir obligāti!");
        }
        elseif (mb_strlen($login, 'UTF8') <2){
            array_push($errMsg, "Lietotājvārdam ir jābūt garākām par 2 simboliem.");
        }
        elseif ($passF !== $passS) {
            array_push($errMsg, "Paroles nesakrīt.");
        }
        elseif (strlen($passF) < 8) {
            array_push($errMsg, "Parolei jābūt vismaz 9 simbolus garai.");
        }
        else {
            $existence = selectOne('users', ['email' => $email]);
            if (!empty($existence['email']) && $existence['email'] === $email){
                array_push($errMsg, "Lietotājs ar tādu e-pastu jau eksistē.");
            }
            else {
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
            }
        }
    }
    else {
        $login = ''; //trims spaces
        $email = '';
    }

    // Autentifikācijas funkcija
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
        $email = trim($_POST['mail']); //trims spaces
        $pass = trim($_POST['password']);

        if($email === '' || $pass === '') {
            array_push($errMsg, "Visi lauki ir obligāti!");
        }
        else {
            $existence = selectOne('users', ['email' => $email]);
            //tt($existence);
            if($existence && password_verify($pass, $existence['password'])) {
                userAuth($existence);
                //Login
            }
            else{
                array_push($errMsg, "Nepareizi ievadīts e-pasts vai parole!");
                //Login error
            }
        }
    }
    else {
        $email = '';
    }
    // Lietotāju izveidošanas funkcijas
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])) {
        $admin = 0;
        $login = trim($_POST['login']); //trims spaces
        $email = trim($_POST['mail']);
        $passF = trim($_POST['pass-first']);
        $passS = trim($_POST['pass-second']);

        if($login === '' || $email === '' || $passF === '') {
            array_push($errMsg, "Visi lauki ir obligāti.");
        }
        elseif (mb_strlen($login, 'UTF8') <2){
            array_push($errMsg, "Lietotājvārdam ir jābūt garākām par 2 simboliem.");
        }
        elseif ($passF !== $passS) {
            array_push($errMsg, "Paroles nesakrīt.");
        }
        elseif (strlen($passF) < 8) {
            array_push($errMsg, "Parolei jābūt vismaz 9 simbolus garai.");
        }
        else {
            $existence = selectOne('users', ['email' => $email]);
            if (!empty($existence['email']) && $existence['email'] === $email){
                array_push($errMsg, "Lietotājs ar tādu e-pastu jau eksistē.");
            }
            else {
                $pass = password_hash($passF, PASSWORD_DEFAULT);
                if (isset($_POST['author'])){
                    $admin = 2;
                };
                $user = [
                    'admin' => $admin,
                    'username' => $login,
                    'email' => $email,
                    'password' => $pass
                ];
                $id = insert('users', $user);
                $user = selectOne('users', ['id' => $id]);
                header('location: ' . BASE_URL . 'admin/users/index.php');
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

    // Dabūjam datus priekš rediģēšanas
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
        $user = selectOne('users', ['id' => $_GET['edit_id']]);
        $id = $user['id'];
        $admin = $user['admin'];
        $username = $user['username'];
        $email = $user['email'];
    }

    // Lietotāju rediģēšana
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])) {
        $user = selectOne('users', ['id' => $_GET['edit_id']]); 
        $username = $user['username'];
        $id = $_POST['id'];
        //$mail = trim($_POST['mail']); //trims spaces
        $login = trim($_POST['login']);
        $passF = trim($_POST['pass-first']);
        $passS = trim($_POST['pass-second']);
        $admin = isset($_POST['admin']) ? 1 : 0; //if publish is set then it will be 1, or 0 if not

        if($login === '') {
            array_push($errMsg, "Lietotājvārds ir obligāts.");

        }elseif (mb_strlen($login, 'UTF8') <2){
            array_push($errMsg, "Lietotājvārdam ir jābūt garākām par 2 simboliem.");
        }elseif ($passF !== $passS) {
            array_push($errMsg, "Paroles nesakrīt.");
        }
        elseif (strlen($passF) < 8) {
            array_push($errMsg, "Parolei jābūt vismaz 9 simbolus garai.");
        }
        else {
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            if (isset($_POST['author'])){
                $admin = 2;
            };
          
            $user = [
                'admin' => $admin,
                'username' => $login,
                'password' => $pass
            ];
            $user = update('users', $id, $user);
            header('location: ' . BASE_URL . 'admin/users/index.php');

        }    
    }
    else {
        $login = '';
        $email = '';
    }
?>