
<!-- Top Bar Start -->
<div class="top-bar">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="tb-contact">
                <p><i class="fas fa-envelope"></i>mirka8189@gmail.com</p>
                <p><i class="fas fa-phone-alt"></i>+37120129697</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tb-menu">
                <ul>
                <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <?php echo $_SESSION['login']; ?>
                            </a>
                            
                                <li><a href="<?php echo BASE_URL . "logout.php"; ?>">Log out</a> </li>
</ul>
                    </li>
            </div>
        </div>
    </div>
</div>
</div>