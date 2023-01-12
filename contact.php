<?php
    include "path.php";
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
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
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <!-- Navigācijas joslas sākums -->
        <?php include("app/include/header.php"); ?>
        <div class="brand">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="b-logo">
                            <a href="index.php">
                                <img src="assets/img/logo2.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="b-search">
                            <form action="search.php" method="post">
                                <input type="text" name="search-term" class="text-input" placeholder="Ievādiet kādu vārdu...">
                                <button><i name="search-term" class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigācijas joslas beigums -->
        <!-- Kontaktu formas sākums -->
        <div class="contact">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="contact-form">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" placeholder="Jūsu vārds" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" class="form-control" placeholder="Jūsu e-pasts" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Temats" />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" placeholder="Ziņa"></textarea>
                                </div>
                                <div><button class="btn" type="submit">Uzraktīt</button></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info">
                            <h3>Sazinieties ar mums</h3>
                            <p>
                                Sazinieties ar mums par interesējošiem jautājumiem, kā arī par sadarbību, mēs vienmēr esam priecīgi strādāt kopā!
                            </p>
                            <h4><i class="fa fa-map-marker"></i>Raiņa bulvāris 19, Centra rajons, Rīga, LV-1586</h4>
                            <h4><i class="fa fa-envelope"></i>mirka8189@gmail.com</h4>
                            <h4><i class="fa fa-phone"></i>+37120129697</h4>
                            <div class="social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                                <a href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kontaktu formas beigums -->
        <?php include("app/include/footer.php"); ?>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
