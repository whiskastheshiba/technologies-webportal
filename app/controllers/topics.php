<?php

include SITE_ROOT . "/app/database/db.php";


$errMsg = [];
$id = '';
$name = '';
$description = '';
$topics = selectAll('topics');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])) {
    //tt($_POST);
    //exit;
    
    $name = trim($_POST['name']); //trims spaces
    $description = trim($_POST['description']);



    if($name === '' || $description === '') {
        array_push($errMsg, "Not all fields are filled!");
    }elseif (mb_strlen($name, 'UTF8') <2){
        array_push($errMsg, "Category should be more than 2 symbols");
    }
    else {
        $existence = selectOne('topics', ['name' => $name]); //UNIQUE
        if (!empty($existence['name']) && $existence['name'] === $name){
            array_push($errMsg, "This category already exists!");
        }else {
        $topic = [
            'name' => $name,
            'description' => $description,
        ];
    
        $id = insert('topics', $topic);
        $user = selectOne('topics', ['id' => $id]);
        header('location: ' . BASE_URL . 'admin/topics/index.php');
    
    }
    
}
}
else {
    $name = ''; //trims spaces
    $description = '';
}

//edit category

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $id = $_GET['id'];
    $topic = selectOne('topics', ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];

}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])) {
    //tt($_POST);
    //exit;
    
    $name = trim($_POST['name']); //trims spaces
    $description = trim($_POST['description']);



    if($name === '' || $description === '') {
        array_push($errMsg, "Not all fields are filled!");
    }elseif (mb_strlen($name, 'UTF8') <2){
        array_push($errMsg, "Category should be more than 2 symbols");
    }
    else {
        $topic = [
            'name' => $name,
            'description' => $description,
        ];
    
        $id = $_POST['id'];
        $topic_id = update('topics', $id, $topic);
        header('location: ' . BASE_URL . 'admin/topics/index.php');
    
    }
    
}

//delete a category
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {

    $id = $_GET['del_id'];
    delete('topics', $id);
    header('location: ' . BASE_URL . 'admin/topics/index.php');
}
