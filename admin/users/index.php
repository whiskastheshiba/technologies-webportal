<?php 
    include "../../path.php";
    include "../../app/controllers/users.php";
    if($_SESSION['admin'] != 1) {
        header('location: ' . BASE_URL);
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
        <link href="../../css/admin.css" rel="stylesheet">
    </head>
    <body>
        <?php include("../../app/include/header-admin.php"); ?>
        <div class="container">
            <?php include "../../app/include/navbar-admin.php"; ?>
            <div class="posts col-9">
                <div class="button row">
                    <a href="<?php echo BASE_URL . "admin/users/create.php";?>" class ="col-2 btn btn-success">Izveidot lietotāju</a>
                    <span class="col-1"></span>
                    <a href="<?php echo BASE_URL . "admin/users/index.php";?>" class="col-2 btn btn-warning">Lietotāju pārvaldība </a>
                </div>
                <div class="row title-table">
                    <h2>Lietotāju pārvaldība</h2>
                    <div class="col-1">ID</div>
                    <div class="col-2">Lietotājvārds</div>
                    <div class="col-3">Epasts</div>
                    <div class="col-2">Loma</div>
                    <div class="col-4">Pārvaldība</div>
                </div>
                <?php foreach($users as $key => $user) : ?>
                    <div class="row post">
                        <div class="col-1"><?=$user['id'];?></div>
                        <?php if(strlen($user['username']) > 12): ?>
                            <div class="col-2"><?=mb_substr($user['username'], 0, 12, 'UTF-8'). '...'  ?></div>
                        <?php else: ?>
                            <div class="col-2"><?=$user['username']?></div>
                        <?php endif; ?>
                        <?php if(strlen($user['email']) > 20): ?>
                            <div class="col-3"><?=mb_substr($user['email'], 0, 20, 'UTF-8'). '...'  ?></div>
                        <?php else: ?>
                            <div class="col-3"><?=$user['email'];?></div>
                        <?php endif; ?>
                        <?php if($user['admin'] == 1): ?>
                            <div class="col-2">Administrators</div>
                        <?php elseif($user['admin'] == 2): ?>
                            <div class="col-2">Autors</div>
                        <?php else: ?>
                            <div class="col-2">Lietotājs</div>
                        <?php endif; ?>
                        <div class="edit col-2"><a href="edit.php?edit_id=<?=$user['id'];?>">Rediģēt</a></div>
                        <div class="del col-2"><a href="index.php?delete_id=<?=$user['id'];?>">Dzēst</a></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
