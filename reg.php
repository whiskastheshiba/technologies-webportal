<?php
    include "path.php";
    include "app/controllers/users.php";
    
?>


<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
<!-- END HEADER -->
<!-- FORM -->
<div class="container reg_form">
    <form action="reg.php" method="post" class="row justify-content-center">
        <h2>Reģistrācijas forma</h2>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <?php include "app/helps/errorInfo.php"; ?>
            <label for="formGroupExampleInput" class="form-label">Jūsu lietotājvārds</label>
            <input name ="login" value="<?=$login?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="ievadiet Jūsu lietotājvārdu...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputEmail1" class="form-label">Epasts</label>
            <input name ="mail" type="email" value="<?=$email?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ievadiet Jūsu epastu...">
            <div id="emailHelp" class="form-text">Jūsu e-pasts netiks izmantots spam sūtīšanai!</div>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Parole</label>
            <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="ievadiet Jūsu paroli...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword2" class="form-label">Atkārtojiet paroli</label>
            <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="atkārtojiet paroli...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button type="submit" class="btn btn-secondary" name="button-reg">Reģistrācija</button>
            <a href="log.php">Ieiet</a>
        </div>
    </form>
</div>
<!-- END FORM -->

<!-- footer -->
<?php include("app/include/footer.php"); ?>
<!-- // footer -->


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
-->
</body>
</html>