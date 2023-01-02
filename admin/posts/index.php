<?php 
    include "../../path.php";
    include "../../app/controllers/posts.php"
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
                        <div class="button row">
                            <a href="<?php echo BASE_URL . "admin/posts/create.php";?>" class ="col-2 btn btn-success">Add Post</a>
                            <span class="col-1"></span>
                            <a href="<?php echo BASE_URL . "admin/posts/index.php";?>" class="col-2 btn btn-warning">Manage Posts</a>
                        </div>
                        <div class="row title-table">
                            <h2>Managing of posts</h2>
                            <div class="col-1">ID</div>
                            <div class="col-5">Name of post</div>
                            <div class="col-2">Author</div>
                            <div class="col-4">Controlling</div>
                        </div>
                        <?php foreach ($postsAdm as $key => $post): ?>
                        <div class="row post">
                            <div class="id col-1"><?=$key +1; ?></div>
                            <div class="title col-5"><?=mb_substr($post['title'], 0, 50, 'UTF-8'). '...'  ?></div>
                            <div class="author col-2"><?=$post['username']; ?></div>
                            <div class="edit col-1"><a href="edit.php?id=<?=$post['id'];?>">Edit</a></div>
                            <div class="del col-1"><a href="edit.php?delete_id=<?=$post['id'];?>">Delete</a></div>
                            <?php if ($post['status']): ?>
                                <div class="status col-2"><a href="edit.php?publish=0&pub_id=<?=$post['id'];?>">Draft</a></div>
                            <?php else: ?>
                                <div class="status col-2"><a href="edit.php?publish=1&pub_id=<?=$post['id'];?>">Publish</a></div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>  
        <?php include("../../app/include/footer.php"); ?>
    </body>
</html>
