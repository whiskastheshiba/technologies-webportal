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
    $views = 0;
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
                array_push($errMsg, "Augšupielādēt var tikai attēlus.");
            }
            else{
                $result = move_uploaded_file($fileTmpName, $destination);
                if($result){
                    $_POST['img'] = $imgName;
                }
                else{
                    array_push($errMsg, "Attēls ir obligāts. Mēģiniet vēl reiz.");
                }
            }
        }
        else{
            array_push($errMsg, "Kļūda attēlu apstrādāšanā. Mēģiniet vēl reiz.");
        }
        $title = trim($_POST['title']); //trims spaces
        $content = trim($_POST['content']);
        $topic = trim($_POST['topic']);
        $publish = isset($_POST['publish']) ? 1 : 0; //if publish is set then it will be 1, or 0 if not
        if($title === '' || $content === '' || $topic === '') {
            array_push($errMsg, "Visi lauki ir obligāti.");
        
        }elseif (mb_strlen($title, 'UTF8') <7){
            array_push($errMsg, "Nosaukumam un rakstam ir jābūt lielākiem par 7 simboliem.");
        }
        else {
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'content' => $content,
                'img' => $_POST['img'],
                'status' => $publish,
                'id_topic' => $topic,
                'views' => $views
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
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) { //we use method GET and there is ID
        $post = selectOne('posts', ['id' => $_GET['id']]); 
        $id = $post['id'];
        $title = $post['title'];
        $content = $post['content'];
        $topic = $post['id_topic'];
        $publish = $post['status'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {
        //header('location: ' . BASE_URL . 'admin/posts/edit.php?id=' . $_POST['id']);
        $post = selectOne('posts', ['id' => $_GET['id']]);
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
                array_push($errMsg, "Augšupielādēt var tikai attēlus.");
            }
            else{
                $result = move_uploaded_file($fileTmpName, $destination);
                if($result){
                    $_POST['img'] = $imgName;
                }
                else{
                    array_push($errMsg, "Attēls ir obligāts. Mēģiniet vēl reiz.");
                }
            }
        }
        else{
            array_push($errMsg, "Kļūda attēlu apstrādāšanā. Mēģiniet vēl reiz.");
        }
        if($title === '' || $content === '' || $topic === '') {
            array_push($errMsg, "Visi lauki ir obligāti.");
            
        }
        elseif (mb_strlen($title, 'UTF8') <7){
            array_push($errMsg, "Nosaukumam ir jābūt lielākam par 7 simboliem.");
        }
        else {
            $post = [

                'title' => $title,
                'content' => $content,
                'img' => $_POST['img'],
                'status' => $publish,
                'id_topic' => $topic
            ];
            $post = update('posts', $id, $post);
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }    
    }
    else {
        $title = isset($_POST['title']) ? $_POST['title'] : ''; //trims spaces
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $publish = isset($_POST['publish']) ? 1 : '';
        $topic = isset($_POST['id_topic']) ? $_POST['id_topic'] : '';
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
?>