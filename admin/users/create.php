<?php include("../../path.php");
    include "../../app/controllers/users.php"
    
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
                            <h2>User creation</h2>
                        </div>
                        <div class="row add-post">
                        <?php include "../../app/helps/errorInfo.php"; ?>
                            <form action="create.php" method="post">
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">Your login</label>
                                    <input name ="login"  type="text" class="form-control" id="formGroupExampleInput" placeholder="enter your login...">
                                </div>
                                
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input name ="mail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your email...">
                                </div>
                                
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="enter your password...">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword2" class="form-label">Repeat the password</label>
                                    <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="repeat the password...">
                                </div>
                                <input name="admin" class="form-check-input" type="checkbox" id="flexCheckChecked" value='1'>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Admin?
                                    </label>
                                <div class="col">
                                    <button name="create-user" class="btn btn-primary" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        <?php include("../../app/include/footer.php"); ?>

    </body>
</html>
