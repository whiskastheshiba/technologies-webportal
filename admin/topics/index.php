<?php include("../../path.php");
    include("../../app/controllers/topics.php");
    if($_SESSION['admin'] != 1) {
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
                    <div class="button row">
                            <a href="<?php echo BASE_URL . "admin/topics/create.php";?>" class ="col-2 btn btn-success">Pievienot kategoriju</a>
                            <span class="col-1"></span>
                            <a href="<?php echo BASE_URL . "admin/topics/index.php";?>" class="col-2 btn btn-warning">Kategoriju pārvaldība</a>
                        </div>
                        <div class="row title-table">
                            <h2>Kategoriju pārvaldība</h2>
                            <div class="col-1">ID</div>
                            <div class="col-5">Nosaukums</div>
                            <div class="col-4">Pārvaldība</div>
                        </div>
                        <?php foreach($topics as $key => $topic): ?>
                        <div class="row post">
                            <div class="id col-1"><?=$key + 1;?></div>
                            <?php if(strlen($topic['name']) > 30): ?>
                                <div class="title col-5"><?=mb_substr($topic['name'], 0, 30, 'UTF-8'). '...'  ?></div>
                            <?php else: ?>
                                <div class="title col-5"><?=$topic['name'];?></div>
                            <?php endif; ?>
                            <div class="red col-2"><a href="edit.php?id=<?=$topic['id'];?>">Rediģēt</a></div>
                            <div class="del col-2"><a href="index.php?del_id=<?=$topic['id'];?>">Dzēst</a></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>  
    </body>
</html>
