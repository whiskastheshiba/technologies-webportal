<?php   include("path.php");
        include "app/controllers/users.php";
?>
<html lang="ru">
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
        
        <!-- social media icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet"> 

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="tb-contact">
                            <p><i class="fas fa-envelope"></i>mirka8189@gmail.com</p>
                            <p><i class="fas fa-phone-alt"></i>+37120129697</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="tb-menu">
                            <?php if (isset($_SESSION['id'])): ?>
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    <?php echo $_SESSION['login']; ?>
                                </a>
                                <?php if ($_SESSION['admin'] == 1): ?>
                                    <a href="<?php echo BASE_URL . "admin/topics/create.php"; ?>">Sistēmas pārvaldība</a>
                                <?php elseif ($_SESSION['admin'] == 2): ?>
                                    <a href="<?php echo BASE_URL . "admin/posts/create.php"; ?>">Pievienot rakstu</a> 
                                <?php endif; ?>
                                <a href="<?php echo BASE_URL . "logout.php"; ?>">Iziet</a> 
                            <?php else: ?>
                                <a href="<?php echo BASE_URL . "log.php"; ?>">
                                    <i class="fa fa-user"></i>
                                    Autorizēties
                                </a>
                                <a href="<?php echo BASE_URL . "reg.php"; ?>">Reģistrēties</a> 
                            <?php endif; ?>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="brand">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="b-logo">
                            <a href="index.php">
                                <img src="assets/img/logo2.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM -->
        <div class="container reg-form">
            <form class="row justify-content-center" method="post" action="log.php">
                <h2 class="col-12">Autorizēšana</h2>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <?php include "app/helps/errorInfo.php"; ?>
                    <label for="formGroupExampleInput" class="form-label">Jūsu epasts</label>
                    <input name ="mail" type="email" value="<?=$email?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ievadiet Jūsu epastu...">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <label for="exampleInputPassword1" class="form-label">Parole</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="ievadiet Jūsu praoli...">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <button type="submit" name="button-log" class="btn btn-secondary">Ieiet</button>
                    <a href="reg.php">Reģistrēties</a>
                </div>
            </form>
        </div>
        <!-- END FORM -->

        <!-- footer -->
        <?php include("app/include/footer.php"); ?>
        <!-- // footer -->

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
</html>