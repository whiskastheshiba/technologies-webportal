<?php
    include_once SITE_ROOT . "/app/database/db.php";

    $commentsForAdm = selectAll('comments');
    $page = $_GET['post'];
    $email = '';
    $comment = '';
    $text1 = '';
    $pub = '';
    $errMsg = [];
    $status = 0;
    $comments = selectAll('comments', ['page' => $page, 'status' => 1] );

    // Creating a comment
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])){
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
            if ($user['email'] == $email && $user['admin'] == 1){
                $status = 1;
            }
            $comment = [
                'status' => $status,
                'page' => $page,
                'email' => $email,
                'comment' => $comment
            ];
            $comment = insert('comments', $comment);
            $comments = selectAll('comments', ['page' => $page, 'status' => 1] );
        }
    }
    else{
        $email = '';
        $comment = '';
        $comments = selectAll('comments', ['page' => $page, 'status' => 1] );
    }

    //delete a comment
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        delete('comments', $id);
        header('location: ' . BASE_URL . 'admin/comments/index.php');
    }

    // Status change (publish/draft)
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
        $id = $_GET['pub_id'];
        $publish = $_GET['publish'];
        $postId = update('comments', $id, ['status' => $publish]);
        header('location: ' . BASE_URL . 'admin/comments/index.php');
        exit();
    }

    // UPDATE of the comment
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
        $oneComment = selectOne('comments', ['id' => $_GET['id']]);
        $id =  $oneComment['id'];
        $email =  $oneComment['email'];
        $text1 = $oneComment['comment'];
        $pub = $oneComment['status'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])){
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