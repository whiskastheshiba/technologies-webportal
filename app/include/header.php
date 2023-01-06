<!-- Top Bar Start -->
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

<div class="nav-bar">
            <div class="container">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="<?php echo BASE_URL; ?>" class="nav-item nav-link active">Home</a>
                            <a href="contact.html" class="nav-item nav-link">Contact Us</a>
                        </div>
                        <div class="social ml-auto">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>