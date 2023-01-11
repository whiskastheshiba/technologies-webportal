<?php
    include SITE_ROOT . "/app/database/db.php";

    $errMsg = [];
    $id = '';
    $name = '';
    $description = '';
    $topics = selectAll('topics');

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])) {
        $name = trim($_POST['name']); //trims spaces
        $description = trim($_POST['description']);

        if($name === '' || $description === '') {
            array_push($errMsg, "Visi lauki ir obligāti.”");
        }
        elseif (mb_strlen($name, 'UTF8') <2){
            array_push($errMsg, "Nosaukumam ir jābūt lielākam par 2 simboliem");
        }
        else {
            $existence = selectOne('topics', ['name' => $name]); //UNIQUE
            if (!empty($existence['name']) && $existence['name'] === $name){
                array_push($errMsg, "Tāda kategorija jau eksistē datubāzē.");
            }
            else {
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
        $name = trim($_POST['name']); //trims spaces
        $description = trim($_POST['description']);

        if($name === '' || $description === '') {
            array_push($errMsg, "Visi lauki ir obligāti.");
        }
        elseif (mb_strlen($name, 'UTF8') <2){
            array_push($errMsg, "Nosaukumam ir jābūt lielākam par 2 simboliem");
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
?>