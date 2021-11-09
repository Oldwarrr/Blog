<?php
require_once 'includes/config.php';
require_once 'includes/header.html';


if(isset($_COOKIE['login']) && isset($_COOKIE['password'])){
    header('Location: home.php');
    die;
}elseif(isset($_SESSION['login']) && isset($_SESSION['password'])){
    header('Location: home.php');
    die;
}

?>

<header class="startpage dark">
    <div class="container">
        <div class="startpage__content">
            <h1>Добро пожаловать на форум!</h1>
            <h3>Просмотр контента форума доступен только зарегистрированным пользователям</h3>
            <div class="startpage__content__links">
                <a href="authorization.php" class="content__links__link">Вход</a>
                <a href="registration.php" class="content__links__link">Регистрация</a>
            </div>
        </div>
    </div>
</header>

<?php
require_once 'includes/footer.html';
?>