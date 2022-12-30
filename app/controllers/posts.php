<?php

include SITE_ROOT . "/app/database/db.php";
if (!$_SESSION){
    header('location: ' . BASE_URL . 'log.php');
}

$errMsg = [];
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';
$topics = selectAll('topics');
$posts = selectAll('posts'); //mass with all posts and topics, which we will use for work

$postsAdm = selectAllFromPostsWithUsers('posts', 'users');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
    //tt($_FILES);
    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $destination = ROOT_PATH . "\assets\posts\\" . $imgName;
        $fileType = $_FILES['img']['type'];

        if(strpos($fileType, 'image') === false){
            array_push($errMsg, "Only images can be uploaded.");
        }else{
            $result = move_uploaded_file($fileTmpName, $destination);
        

            if($result){
                $_POST['img'] = $imgName;

        }else{
            array_push($errMsg, "Error while uploading image");
        }
    }
    
    }else{
        array_push($errMsg, "Error while getting the image");
    }
    $title = trim($_POST['title']); //trims spaces
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0; //if publish is set then it will be 1, or 0 if not


    if($title === '' || $content === '' || $topic === '') {
        array_push($errMsg, "Not all fields are filled!");
    }elseif (mb_strlen($title, 'UTF8') <7){
        array_push($errMsg, "Category should be more than 7 symbols");
    }
    else {
        $post = [
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'id_topic' => $topic
        ];

        $post = insert('posts', $post);
        $post = selectOne('posts', ['id' => $id]);
        header('location: ' . BASE_URL . 'admin/posts/index.php');

    }
    
}
else {
    $id = '';
    $title = ''; //trims spaces
    $content = '';
    $publish = '';
    $topic = '';
}

//edit post

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $post = selectOne('posts', ['id' => $_GET['id']]);
    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $topic = $post['id_topic'];
    $publish = $post['status'];


}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {
    
    $id = $_POST['id'];
    $title = trim($_POST['title']); //trims spaces
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0; //if publish is set then it will be 1, or 0 if not

    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $destination = ROOT_PATH . "\assets\posts\\" . $imgName;
        $fileType = $_FILES['img']['type'];

        if(strpos($fileType, 'image') === false){
            array_push($errMsg, "Only images can be uploaded.");
        }else{
            $result = move_uploaded_file($fileTmpName, $destination);
        

            if($result){
                $_POST['img'] = $imgName;

        }else{
            array_push($errMsg, "Error while uploading image");
        }
    }
    
    }else{
        array_push($errMsg, "Error while getting the image");
    }

    if($title === '' || $content === '' || $topic === '') {
        array_push($errMsg, "Not all fields are filled!");
    }elseif (mb_strlen($title, 'UTF8') <7){
        array_push($errMsg, "Category should be more than 7 symbols");
    }
    else {
        $post = [
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'id_topic' => $topic
        ];

        $post = update('posts', $id, $post);
        header('location: ' . BASE_URL . 'admin/posts/index.php');

    }    
}else {
    $title = isset($_POST['title']) ? 1 : 0; //trims spaces
    $content = isset($_POST['content']) ? 1 : 0;
    $publish = isset($_POST['publish']) ? 1 : 0;
    $topic = isset($_POST['id-topic']) ? 1 : 0;
}

//UPDATE function for 'status' changing
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) { 

    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('posts', $id, ['status' => $publish]);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
    exit();
}


//delete a category
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {

    $id = $_GET['delete_id'];
    delete('posts', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}
