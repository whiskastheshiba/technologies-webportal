<?php

include SITE_ROOT . "/app/database/db.php";

$errMsg = '';
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';
$topics = selectAll('topics');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
    
    $title = trim($_POST['title']); //trims spaces
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);

    if($title === '' || $content === '' || $topic === '') {
        $errMsg = "Not all fields are filled!";
    }elseif (mb_strlen($title, 'UTF8') <7){
        $errMsg = "Category should be more than 7 symbols";
    }
    else {
        $post = [
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => 1,
            'id_topic' => $topic
        ];
    
        $post = insert('posts', $post);
        $post = selectOne('posts', ['id' => $id]);
        header('location: ' . BASE_URL . 'admin/posts/index.php');

    }
    
}
else {
    $title = ''; //trims spaces
    $content = '';
}

// //edit category

// if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

//     $id = $_GET['id'];
//     $topic = selectOne('topics', ['id' => $id]);
//     $id = $topic['id'];
//     $name = $topic['name'];
//     $description = $topic['description'];

// }

// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])) {
//     //tt($_POST);
//     //exit;
    
//     $name = trim($_POST['name']); //trims spaces
//     $description = trim($_POST['description']);



//     if($name === '' || $description === '') {
//         $errMsg = "Not all fields are filled!";
//     }elseif (mb_strlen($name, 'UTF8') <2){
//         $errMsg = "Category should be more than 2 symbols";
//     }
//     else {
//         $topic = [
//             'name' => $name,
//             'description' => $description,
//         ];
    
//         $id = $_POST['id'];
//         $topic_id = update('topics', $id, $topic);
//         header('location: ' . BASE_URL . 'admin/topics/index.php');
    
//     }
    
// }

// //delete a category
// if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {

//     $id = $_GET['del_id'];
//     delete('topics', $id);
//     header('location: ' . BASE_URL . 'admin/topics/index.php');
// }
