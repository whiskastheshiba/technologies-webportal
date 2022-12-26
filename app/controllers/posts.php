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

        $result = move_uploaded_file($fileTmpName, $destination);

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
