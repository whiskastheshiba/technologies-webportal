<?php
    include "path.php";
    include SITE_ROOT . "/app/database/db.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])) {
        $posts = seacrhInTitileAndContent($_POST['search-term'], 'posts', 'users');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Geeknews - everything about technologies!</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet"> 

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet"> <!-- social media icons -->


        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <?php include("app/include/header.php"); ?>
        <div class="brand">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="b-logo">
                            <a href="index.php">
                                <img src="assets/img/logo2.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="b-search">
                            <form action="search.php" method="post">
                                <input type="text" name="search-term" class="text-input" placeholder="Iev??diet k??du v??rdu...">
                                <button><i name="search-term" class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cat-news">
            <div class="container">
                <div class="content row">
                    <!-- Main Content -->
                    <div class="main-content col-12">
                        <h2>Mekl????anas '<?=$_POST['search-term'] ;?>' rezult??ts</h2>
                        <?php foreach ($posts as $post): ?>
                            <?php if($post['status'] == 1): ?>
                                <div class="post row">
                                    <div class="img col-12 col-md-4">
                                        <img src="<?=BASE_URL . 'assets/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail">
                                    </div>
                                    <div class="post_text col-12 col-md-8">
                                        <h3>
                                        <?php if(strlen($post['title']) > 80): ?>
                                            <h3>
                                                <a href="<?=BASE_URL . 'single-page.php?post=' . $post['id'];?>"><?=substr($post['title'], 0, 80) . '...'  ?></a>
                                            </h3>
                                        <?php else: ?>
                                            <h3>
                                                <a href="<?=BASE_URL . 'single-page.php?post=' . $post['id'];?>"><?=$post['title'] ?></a>
                                            </h3>
                                        <?php endif; ?>
                                        </h3>
                                        <i class="far fa-user"> <?=$post['username'];?></i>
                                        <i class="far fa-calendar"> <?=$post['created_date'];?></i>
                                        <i class="far fa-calendar"> <?=$post['views'];?></i>
                                        <p class="preview-text">
                                            <?=mb_substr($post['content'], 0, 55, 'UTF-8'). '...'  ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include("app/include/footer.php"); ?>
    </body>
</html>
