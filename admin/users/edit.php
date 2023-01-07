<?php include("../../path.php");
    include "../../app/controllers/users.php";
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
                            <a href="<?php echo BASE_URL . "admin/users/create.php";?>" class ="col-2 btn btn-success">Izveidot lietotāju</a>
                            <span class="col-1"></span>
                            <a href="<?php echo BASE_URL . "admin/users/index.php";?>" class="col-2 btn btn-warning">Lietotāju pārvaldība</a>
                        </div>
                        <div class="row title-table">
                            <h2>Lietotāja rediģēšana</h2>
                        </div>
                        <div class="row add-post">
                        <?php include "../../app/helps/errorInfo.php"; ?>
                            <form action="edit.php" method="post">
                            <input name ="id" value="<?=$id;?>" type="hidden">
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">Login</label>
                                    <input name ="login" value="<?=$username?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="ievadiet lietotājvārdu...">
                                </div>
                      
                                
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Parole</label>
                                    <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="ievadiet paroli...">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword2" class="form-label">Atkārtojiet paroli</label>
                                    <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="atkārtojiet paroli...">
                                </div>
                                    <input name="author" class="form-check-input" type="checkbox" id="flexCheckChecked" value='2'>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Autors?
                                    </label>
                                <div class="col">
                                    <button name="update-user" class="btn btn-primary" type="submit">Rediģēt</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
    </body>
</html>
