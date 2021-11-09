<?php
require_once 'includes/config.php';
require_once 'includes/header.html';

if(!isset($_SESSION['changePass']) && !isset($_SESSION['registration'])){
    header('Location: startpage.php');
    die;
}else{
    header('refresh: 5; url=http://blog/authorization.php');
}

?>

<header class="startpage">
    <div class="container">
        <div class="startpage__content">
            <div class="alertSuccess">
                <?php
                if(isset($_SESSION['registration'])){
                    echo 'Регистрация завершена!';
                }elseif(isset($_SESSION['changePass'])){
                    echo 'Пароль успешно изменён!';
                }
                ?>
                Идёт перенаправление на страницу авторизации...</div>
        </div>
    </div>
</header>

<?php
require_once 'includes/footer.html';
?>
