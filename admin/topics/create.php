<?php include("../../assets/path.php");
    include("../../app/database/db.php");
    
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
                            <a href="<?php echo BASE_URL . "admin/topics/create.php";?>" class ="col-2 btn-btn success">Add topic</a>
                            <span class="col-1"></span>
                            <a href="<?php echo BASE_URL . "admin/topics/index.php";?>" class="col-2 btn-btn warning">Manage topic</a>
                        </div>
                        <div class="row title-table">
                            <h2>Creating a topic</h2>
                        </div>
                        <div class="row add-post">
                            <form action="create.php" method="post">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Title" aria-label="Name of topic">
                                </div>
                                <div class="col">
                                    <label for="content" class="form-label">Description of topic</label>
                                    <textarea class="form-control" id="content" rows="3"></textarea>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" type="submit">Create a topic</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        <?php include("../../app/include/footer.php"); ?>
    </body>
</html>
