<?php
    include_once SITE_ROOT . "/app/database/db.php";

    $commentsForAdm = selectAll('comments');
    $email = '';
    $comment = '';
    $text1 = '';
    $pub = '';
    $errMsg = [];
    $status = 0;

    // Komentāru izveidošana
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])){
        $page = $_GET['post'];
        $comments = selectAll('comments', ['page' => $page, 'status' => 1] );
        $email = trim($_POST['email']);
        $comment = trim($_POST['comment']);

        if($email === '' || $comment === ''){
            array_push($errMsg, "Visi lauki ir obligāti");
        }
        elseif (mb_strlen($comment, 'UTF8') < 50){
            array_push($errMsg, "Komentāram ir jābūt lielākam par 50 simboliem");
        }
        else{
            $user = selectOne('users', ['email' => $email]);
            $comment = [
                'status' => $status,
                'page' => $page,
                'email' => $email,
                'comment' => $comment
            ];
            $comment = insert('comments', $comment);
        }
    }
    else{
        $email = '';
        $comment = '';
    }

    // Komentāru dzēšana
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        delete('comments', $id);
        header('location: ' . BASE_URL . 'admin/comments/index.php');
    }

    // Komentāra stāvokļu maiņa (publicēts/nepublicēts)
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
        $id = $_GET['pub_id'];
        $publish = $_GET['publish'];
        $postId = update('comments', $id, ['status' => $publish]);
        header('location: ' . BASE_URL . 'admin/comments/index.php');
        exit();
    }

    // Dabūjam komentāra datus priekš rediģēšanas
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
        $oneComment = selectOne('comments', ['id' => $_GET['id']]);
        $id =  $oneComment['id'];
        $email =  $oneComment['email'];
        $text1 = $oneComment['comment'];
        $pub = $oneComment['status'];
    }

    // Komentāra rediģēšāna
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])){
        $oneComment = selectOne('comments', ['id' => $_GET['id']]);
        $id =  $_POST['id'];
        $text = trim($_POST['content']);
        $publish = isset($_POST['publish']) ? 1 : 0;

        if($text === ''){
            array_push($errMsg, "Visi lauki ir obligāti.");
        }
        elseif (mb_strlen($text, 'UTF8') < 50){
            array_push($errMsg, "Komentāram ir jābūt garākām par 50 simboliem.");
        }
        else{
            $com = [
                'comment' => $text,
                'status' => $publish
            ];
            $comment = update('comments', $id, $com);
            header('location: ' . BASE_URL . 'admin/comments/index.php');
        }
    }
    else{
        $text = isset($_POST['content']) ? 1 : '';
        $publish = isset($_POST['publish']) ? 1 : 0;
    }
?>