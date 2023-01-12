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
                        <a href="<?php echo BASE_URL . "admin/users/index.php";?>" class="col-2 btn btn-warning">Lietotāju pārvaldība</a>
                    </div>
                    <div class="row title-table">
                        <h2>Lietotāja izveidošana</h2>
                    </div>
                    <div class="row add-post">
                    <?php include "../../app/helps/errorInfo.php"; ?>
                        <form action="create.php" method="post">
                             <div class="col">
                                <label for="formGroupExampleInput" class="form-label">Lietotājvārds</label>
                                <input name ="login" value="<?=$login?>"  type="text" class="form-control" id="formGroupExampleInput" placeholder="ievadiet lietotājvārdu...">
                            </div>
                            <div class="col">
                                <label for="exampleInputEmail1" class="form-label">Epasts</label>
                                <input name ="mail" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ievadiet epastu...">
                            </div>
                            <div class="col">
                                <label for="exampleInputPassword1" class="form-label">Parole</label>
                                <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="ievadiet paroli...">
                            </div>
                            <div class="col">
                                <label for="exampleInputPassword2" class="form-label">Atkārtojiet paroli</label>
                                <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="atkārtojiet paroli...">
                            </div>
                            <div class="col">
                                <input name="author" class="form-check-input" type="checkbox" id="flexCheckChecked" value='2'>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Autors?
                                </label>
                            </div>
                            <div class="col">
                                <button name="create-user" class="btn btn-primary" type="submit">Izveidot</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    </body>
</html>
