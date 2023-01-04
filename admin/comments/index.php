<?php 
    include "../../path.php";
    include "../../app/controllers/commentaries.php";
    if(!$_SESSION['admin']) {
        header('location: ' . BASE_URL);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>_name_ everything about technologies!</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet"> 

        <!-- CSS Libraries -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet"> <!-- social media icons -->


        <!-- Template Stylesheet -->
        <link href="../../css/admin.css" rel="stylesheet">
    </head>

    <body>

        <?php include("../../app/include/header-admin.php"); ?>
            <div class="container">
                <?php include "../../app/include/navbar-admin.php"; ?>
                    <div class="posts col-9">
                        <div class="row title-table">
                            <h2>Managing of comments</h2>
                            <div class="col-1">ID</div>
                            <div class="col-5">Text</div>
                            <div class="col-2">Author</div>
                            <div class="col-4">Controlling</div>
                        </div>
                        <?php foreach ($commentsForAdm as $key => $comment): ?>
                        <div class="row post">
                            <div class="id col-1"><?=$comment['id']; ?></div>
                            <div class="title col-5"><?=mb_substr($comment['comment'], 0, 50, 'UTF-8'). '...'  ?></div>
                            <?php // Do not output the email address
                                $user = $comment['email'];
                                $user = explode('@', $user);
                                $user = $user[0];
                            ?>
                            <div class="author col-3"><?=$user . "@"; ?></div>
                            <div class="edit col-1"><a href="edit.php?id=<?=$comment['id'];?>">Edit</a></div>
                            <div class="del col-1"><a href="edit.php?delete_id=<?=$comment['id'];?>">Delete</a></div>
                            <?php if ($comment['status']): ?>
                                <div class="status col-1"><a href="edit.php?publish=0&pub_id=<?=$comment['id'];?>">Draft</a></div>
                            <?php else: ?>
                                <div class="status col-1"><a href="edit.php?publish=1&pub_id=<?=$comment['id'];?>">Publish</a></div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>  
        <?php include("../../app/include/footer.php"); ?>
    </body>
</html>
