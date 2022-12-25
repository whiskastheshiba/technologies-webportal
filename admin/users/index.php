<?php include("../../path.php");
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
                            <a href="<?php echo BASE_URL . "admin/users/create.php";?>" class ="col-2 btn-btn success">Create</a>
                            <span class="col-1"></span>
                            <a href="<?php echo BASE_URL . "admin/users/index.php";?>" class="col-2 btn-btn warning">Manage </a>
                        </div>
                        <div class="row title-table">
                            <h2>Managing of posts</h2>
                            <div class="col-1">ID</div>
                            <div class="col-5">Login</div>
                            <div class="col-2">Role</div>
                            <div class="col-4">Controlling</div>
                        </div>
                        <div class="row post">
                            <div class="id col-1">1</div>
                            <div class="title col-5">Ilyatest</div>
                            <div class="author col-2">Admin</div>
                            <div class="edit col-2"><a href="">Edit</a></div>
                            <div class="del col-2"><a href="">Delete</a></div>
                        </div>
                        <div class="row post">
                            <div class="id col-1">2</div>
                            <div class="title col-5">sergeytest</div>
                            <div class="author col-2">User</div>
                            <div class="edit col-2"><a href="">Edit</a></div>
                            <div class="del col-2"><a href="">Delete</a></div>
                        </div>
                    </div>
                </div>
            </div>  
        <?php include("../../app/include/footer.php"); ?>
    </body>
</html>
