<?php

    // header('refresh: 2; url=https://it-forum.oldwarr-projects.site/home.php');


// require_once 'includes/header.html';
// require_once 'includes/header.php';
?>
<div style="width: 100%; height: 100vh; position: absolute; backdrop-filter: blur(5px)"></div>
    <div class="alertSuccess" style="position: absolute; z-index: 1000;">
        <?php
        if(isset($_SESSION['registration'])){
            echo 'Регистрация завершена!';
        }elseif(isset($_SESSION['changePass'])){
            echo 'Пароль успешно изменён!';
        }
        ?>
        Идёт перенаправление на страницу авторизации...</div>
     </div>

<?php
require_once 'post_article.php';
require_once 'includes/footer.html';
?>
