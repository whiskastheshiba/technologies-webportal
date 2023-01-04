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
                    <div class="posts col-9">
                        <h2>Edit a post</h2>

                        <div class="row add-post">
                        <?php include "../../app/helps/errorInfo.php"; ?>
                            <form action="edit.php" method="post" enctype="multipart/form-data"> <!-- Will be stored in server's storage !-->
                                <input type="hidden" name="id" value="<?=$id;?>">
                                <div class="col mb-4">
                                    <input value="<?=$post['title']; ?>" name="title" type="text" class="form-control" placeholder="Title" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label for="editor" class="form-label">Post content</label>
                                    <textarea name="content" id="editor" class="form-control" rows="6"><?=$post['content']; ?></textarea>
                                </div>
                                <div class="input-group col mb-4 mt-4">
                                    <input name="img" type="file" class="form-control" id="inputGroupFile02">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                                <select name="topic" class="form-select mb-2" aria-label="Default select example">
                            
                                    <?php foreach($topics as $key => $topic): ?>
                                        <option value="<?=$topic['id'];?>"><?=$topic['name']?></option>
                                    <?php endforeach; ?>
                                </select>

                                <div class="form-check">
                                    <?php if (empty($publish) && $publish == 0): ?>
                                    <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Publish
                                    </label>
                                    <?php else: ?>
                                        <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                        Publish
                                    </label>
                                    <?php endif; ?>
                                </div>
                                <div class="col col-6">
                                    <button name="edit_post" class="btn btn-primary" type="submit">Edit post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        <?php include("../../app/include/footer.php"); ?>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
        <script src="../../js/scripts.js"></script>
    </body>
</html>
