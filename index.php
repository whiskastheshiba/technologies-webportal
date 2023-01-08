<?php
    include "path.php";
    include "app/controllers/topics.php";

    $page = isset($_GET['page']) ? $_GET['page']: 1;
    $limit = 4;
    $offset = $limit * ($page - 1);
    $total_pages = round(countRow('posts') / $limit, 0);
    $postsDescOrder = showPostsInDescOrder('posts');
    $postsRandom = showRandomPosts('posts');

    $posts = selectAllFromPostsWithUsersOnIndex('posts', 'users', $limit, $offset); //only published posts should be shown
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
                            <input type="text" name="search-term" class="text-input" placeholder="Ievādiet kādu vārdu...">
                        </form>
                            <button><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="cat-news">
            <div class="container">
                <div class="content row">
        <!-- Main Content -->
                    <div class="main-content col-md-8 col-12">
                        <h2>Jaunākās ziņas</h2>
                        <?php foreach ($posts as $post): ?>
                            <div class="post row">
                                <div class="img col-12 col-md-4">
                                    <img src="<?=BASE_URL . 'assets/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail">
                                </div>
                                <div class="post_text col-12 col-md-8">
                                    <h3>
                                        <a href="<?=BASE_URL . 'single-page.php?post=' . $post['id'];?>"><?=substr($post['title'], 0, 80) . '...'  ?></a>
                                    </h3>
                                    <i class="far fa-user"> <?=$post['username'];?></i>
                                    <i class="far fa-calendar"> <?=$post['created_date'];?></i>
                                    <i class="far fa-eye"> <?=$post['views'];?></i>
                                    <p class="preview-text">

                                        <?=mb_substr($post['content'], 0, 55, 'UTF-8'). '...'  ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
            <!-- Pagination -->
            <?php include("app/include/pagination.php"); ?>
            </div>
            <div class="main content col-md-4 col-12">
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
            </div>

        </div>
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
        <div class="main-news">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <?php $category = selectOne('topics', ['id' => '2']); ?>
                            <h2><?=$category['name']; ?>
                        <?php foreach ($posts as $post): ?>
                            <?php if($post['id_topic'] == 2): ?>
                            <div class="col-md-4">
                                <div class="mn-img">
                                <img src="<?=BASE_URL . 'assets/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail">
                                    <div class="mn-title">
                                    <a href="<?=BASE_URL . 'single-page.php?post=' . $post['id'];?>"><?=substr($post['title'], 0, 80) . '...'  ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("app/include/footer.php"); ?>
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    </body>
</html>
