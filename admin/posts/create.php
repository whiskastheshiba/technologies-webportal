<?php 
    include "../../path.php";
    include "../../app/controllers/posts.php";
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
                <!-- Array output with errors -->
                <?php include "../../app/include/navbar-admin.php"; ?>
                    <?php if($_SESSION['admin'] == 1): ?>
                        <div class="posts col-9">
                        <div class="button row">
                                <a href="<?php echo BASE_URL . "admin/posts/create.php";?>" class ="col-3 btn btn-success">Pievienot rakstu</a>
                                <span class="col-1"></span>
                                <a href="<?php echo BASE_URL . "admin/posts/index.php";?>" class="col-3 btn btn-warning">Pārvaldīt rakstus</a>
                            </div>
                            <div class="row title-table">
                                <h2>Rakstu pievienošana</h2>
                            </div>
                            <div class="row add-post">
                            <?php include "../../app/helps/errorInfo.php"; ?>
                                <form action="create.php" method="post" enctype="multipart/form-data"> <!-- Will be stored in server's storage !-->
                                    <div class="col mb-4">
                                        <input value="<?=$title; ?>" name="title" type="text" class="form-control" placeholder="Nosaukums" aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="editor" class="form-label">Teksts</label>
                                        <textarea name="content" id="editor" class="form-control" rows="6"><?=$content; ?></textarea>
                                    </div>
                                    <div class="input-group col mb-4 mt-4">
                                        <input name="img" type="file" class="form-control" id="inputGroupFile02">
                                        <label class="input-group-text" for="inputGroupFile02">Augšupielādēt</label>
                                    </div>
                                    <select name="topic" class="form-select mb-2" aria-label="Default select example">
                            
                                    <?php foreach($topics as $key => $topic): ?>
                                        <option value="<?=$topic['id'];?>"><?=$topic['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                                    <div class="form-check">
                                        <?php if($_SESSION['admin'] == 2): ?>
                                            <input name="publish" class="form-check-input" type="checkbox" value="0" id="flexCheckChecked" hidden>
                                        <?php else: ?>
                                            <input name="publish" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Publicēt
                                            </label>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col col-6">
                                        <button name="add_post" class="btn btn-primary" type="submit">Pievienot rakstu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                        <div class="posts col-12">
                        <div class="row title-table">
                            <h2>Rakstu pievienošana</h2>
                        </div>
                        <div class="row add-post">
                        <?php include "../../app/helps/errorInfo.php"; ?>
                            <form action="create.php" method="post" enctype="multipart/form-data"> <!-- Will be stored in server's storage !-->
                                <div class="col mb-4">
                                    <input value="<?=$title; ?>" name="title" type="text" class="form-control" placeholder="Title" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label for="editor" class="form-label">Teksts</label>
                                    <textarea name="content" id="editor" class="form-control" rows="6"><?=$content; ?></textarea>
                                </div>
                                <div class="input-group col mb-4 mt-4">
                                    <input name="img" type="file" class="form-control" id="inputGroupFile02">
                                    <label class="input-group-text" for="inputGroupFile02">Augšupielādēt</label>
                                </div>
                                <select name="topic" class="form-select mb-2" aria-label="Default select example">
                                    <?php foreach($topics as $key => $topic): ?>
                                        <option value="<?=$topic['id'];?>"><?=$topic['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-check">
                                    <?php if($_SESSION['admin'] == 2): ?>
                                        <input name="publish" class="form-check-input" type="checkbox" value="0" id="flexCheckChecked" hidden>
                                    <?php else: ?>
                                        <input name="publish" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Publicēt
                                        </label>
                                    <?php endif; ?>
                                </div>
                                <div class="col col-6">
                                    <button name="add_post" class="btn btn-primary" type="submit">Pievienot rakstu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>  
        <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
        <script src="../../js/scripts.js"></script>
    </body>
</html>
