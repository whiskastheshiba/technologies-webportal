<?php if (count($errMsg) > 0): ?>
    <ul>
        <?php foreach($errMsg as $error): ?>
            <li class="error-message" ><?=$error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>