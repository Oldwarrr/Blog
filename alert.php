<?php
require_once 'includes/config.php';
if(!isset($_SESSION['alert'])){
    header('Location: home.php');
}
unset($_SESSION['alert']);
header('refresh: 5; url=https://it-forum.oldwarr-projects.site/home.php');



require_once 'includes/header.html';
?>

<header class="startpage">
    <div class="container">
        <div class="startpage__content">
            <div class="alertSuccess">Ваша статья отправлена на модерацию! Идёт перенаправление на главную страницу...</div>
        </div>
    </div>
</header>

<?php
require_once 'includes/footer.html';
?>
