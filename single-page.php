<?php
    include "path.php";
    include "app/controllers/topics.php";
    if(!$_SESSION){
        header('location: ' . BASE_URL . "log.php");
    }
    $postsDescOrder = showPostsInDescOrder('posts');
    $postsRandom = showRandomPosts('posts');
    views_update($_GET['post']);
    $post = selectPostFromPostsWithUsersOnSingle('posts', 'users', $_GET['post']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet"> 

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

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
                            <input type="text" name="search-term" class="text-input" placeholder="Ievadiet kādu vārdu...">
                        </form>
                            <button><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Jaunumi</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Jaunākās ziņas</a></li>
                    <li class="breadcrumb-item active">Ziņa</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Single News Start-->
         <div class="single-news">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="sn-container">
                            <div class="sn-img">
                                <img src="<?=BASE_URL . 'assets/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail">
                            </div>
                            <div class="info">
                                <i class="far fa-user"> <?=$post['username'];?></i>
                                <i class="far fa-calendar"> <?=$post['created_date'];?></i>
                            </div>
                            <div class="sn-content">
                                <h1 class="sn-title"><?php echo $post['title']; ?></h1>
                                <?=$post['content'];?>
                            </div>
                        </div>   
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="sidebar-widget">
                                <h2 class="sw-title">Kategorijas</h2>
                                <div class="category">
                                    <ul>
                                        <?php foreach ($topics as $key => $topic): ?>
                                            <li>
                                                <a href="<?=BASE_URL . 'category.php?id=' . $topic['id']; ?>"><?=$topic['name']; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include "app/include/comments.php" ?>     
                </div>
            </div>
        </div>
        <!-- Single News End-->        
        <div class="tab-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#featured">Visvairāk skatīts</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="featured" class="container tab-pane active">
                                <?php foreach ($postsDescOrder as $postsD): ?>
                                    <div class="tn-news">
                                        <div class="tn-img">
                                            <img src="<?=BASE_URL . 'assets/posts/' . $postsD['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail">
                                        </div>
                                        <div class="tn-title">
                                            <a href="<?=BASE_URL . 'single-page.php?post=' . $postsD['id'];?>"><?=substr($postsD['title'], 0, 80) . '...'  ?></a>
                                            <i class="far fa-eye"> <?=$postsD['views'];?></i>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#m-viewed">Nejauši raksti</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="m-viewed" class="container tab-pane active">
                                <?php foreach ($postsRandom as $postsR): ?>
                                    <div class="tn-news">
                                        <div class="tn-img">
                                            <img src="<?=BASE_URL . 'assets/posts/' . $postsR['img'] ?>" alt="<?=$postsR['title']?>" class="img-thumbnail">
                                        </div>
                                        <div class="tn-title">
                                            <a href="<?=BASE_URL . 'single-page.php?post=' . $postsR['id'];?>"><?=substr($postsR['title'], 0, 80) . '...'  ?></a>
                                            <i class="far fa-eye"> <?=$postsR['views'];?></i>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "app/include/footer.php"; ?>
        <!-- JavaScript Libraries -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
