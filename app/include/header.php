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
                <a href="">About</a>
                <a href="">Privacy</a>
                <a href="">Terms</a>
                <a href="">Contact</a>
                <li>
                        <?php if (isset($_SESSION['id'])): ?>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <?php echo $_SESSION['login']; ?>
                            </a>
                            <ul>
                                <?php if ($_SESSION['admin']): ?>
                                    <li><a href="<?php echo BASE_URL . "admin/topics/create.php"; ?>">Admin panel</a> </li>
                                <?php endif; ?>
                                <li><a href="<?php echo BASE_URL . "logout.php"; ?>">Log out</a> </li>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL . "log.php"; ?>">
                                <i class="fa fa-user"></i>
                                Log in
                            </a>
                            <ul>
                                <li><a href="<?php echo BASE_URL . "reg.php"; ?>">Registration</a> </li>
                            </ul>
                        <?php endif; ?>

                    </li>
            </div>
        </div>
    </div>
</div>
</div>