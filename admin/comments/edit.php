<?php 
    include "../../path.php";
    include "../../app/controllers/commentaries.php";
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
                <h2>Komentāra rediģēšana</h2>
                <div class="row add-post">
                    <?php include "../../app/helps/errorInfo.php"; ?>
                    <form action="<?=BASE_URL . "admin/comments/edit.php?id=$id"?>" method="post" > <!-- Will be stored in server's storage !-->
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <div class="col mb-4">
                            <input value="<?=$email; ?>" readonly name="title" type="text" class="form-control" placeholder="Title" aria-label="First name">
                        </div>
                        <div class="col">
                            <label for="editor" class="form-label">Komentārs</label>
                            <textarea name="content" id="editor" class="form-control" rows="6"><?=$text1; ?></textarea>
                        </div>
                        <div class="form-check">
                            <?php if($pub) $checked = "checked"; else $checked = "";?>
                            <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked" <?=$checked;?> >
                            <label class="form-check-label" for="flexCheckChecked">
                                Publicēt
                            </label>
                        </div>
                        <div class="col col-6">
                            <button name="edit_comment" class="btn btn-primary" type="submit">Saglabāt</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
        <script src="../../js/scripts.js"></script>
    </body>
</html>
