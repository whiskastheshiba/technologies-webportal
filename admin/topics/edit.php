<?php 
    include "../../path.php";
    include "../../app/controllers/topics.php";
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
                    <a href="<?php echo BASE_URL . "admin/topics/create.php";?>" class ="col-2 btn btn-success">Pievienot kategoriju</a>
                    <span class="col-1"></span>
                    <a href="<?php echo BASE_URL . "admin/topics/index.php";?>" class="col-2 btn btn-warning">Kategoriju pārvaldība</a>
                </div>
                <div class="row title-table">
                    <h2>Kategoriju rediģēšana</h2>
                </div>
                <div class="row add-post">
                    <div class="mb-12 col-12 col-md-12 err">
                        <?php include "../../app/helps/errorInfo.php"; ?>
                    </div>
                    <form action="<?=BASE_URL . "admin/topics/edit.php?id=$id"?>" method="post">
                        <input name="id" value="<?=$id;?>" type="hidden">
                        <div class="col">
                            <input name="name" value="<?=$topic['name'];?>" type="text" class="form-control" placeholder="Title" aria-label="Name of topic">
                        </div>
                        <div class="col">
                            <label for="content" class="form-label">Kategorju apraksts</label>
                            <textarea name="description" class="form-control" id="content" rows="3"><?=$topic['description'];?></textarea>
                        </div>
                        <div class="col">
                            <button name="topic-edit"class="btn btn-primary" type="submit">Rediģēt kategoriju</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </body>
</html>
