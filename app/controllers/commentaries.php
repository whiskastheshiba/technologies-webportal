<?php

$page = $_GET['post'];
$email = '';
$comment = '';
$errMsg = [];
$status = 0;
$comments = [];

//Code for creating a comment
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {

    $email = trim($_POST['email']); //trims spaces
    $comment = trim($_POST['comment']);

    if($email === '' || $comment === '') {
        array_push($errMsg, "Not all fields are filled!");
    }elseif (mb_strlen($comment, 'UTF8') <50){
        array_push($errMsg, "Comment should be longer than 50 symbols");
    }
    else {
        $user = selectOne('users', ['email' => $email]); // if added email is in the database then we can allow to this user leave a comment
        if ($user['email'] == $email) {
            $status = 1;
        }

        $comment = [ //Array to entry data to the database(POST)
            'status' => $status,
            'page' => $page,
            'email' => $email,
            'comment' => $comment
        ];

        $comment = insert('comments', $comment);
        $comments = selectAll('comments', ['page' => $page, 'status' => 1]);

    }
    
}
else { //if not POST then we use method GET to see the information on the screen
    $email = '';
    $comment = ''; //trims spaces
    $comments = selectAll('comments', ['page' => $page, 'status => 1']);
}