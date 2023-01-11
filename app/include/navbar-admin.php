<?php if($_SESSION['admin'] == 1): ?>
    <div class="row">
        <div class="sidebar col-3">
            <ul>
                <li>
                    <a href="<?php echo BASE_URL . "admin/posts/index.php";?>">Raksti</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL . "admin/users/index.php";?>">Lietotāji</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL . "admin/topics/index.php";?>">Kategorijas</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL . "admin/comments/index.php";?>">Komentāri</a>
                </li>
            </ul>
        </div>
        
<?php else: ?>

<?php endif; ?>