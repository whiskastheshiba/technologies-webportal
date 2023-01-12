<?php if (count($errMsg) > 0): ?>
    <ul>
        <?php foreach($errMsg as $error): ?>
            <li class="err" ><?=$error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>