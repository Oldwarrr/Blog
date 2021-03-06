<?php
require_once 'includes/config.php';
require_once 'includes/header.html';
require_once 'includes/check_login_and_exit.php';
include 'includes/header.php';
?>

<div class="container">
    <div class="flex-container">


        <main class="main">

            <section class="main__section">



                <img class="article-image" src="img/about_project.jpg" alt="">
                <h1 class="article-title">Цель проекта</h1>
                <p class="article-text">
                    Данный форум создан с целью практики и изучения, а так же отработки навыков программирования на языке PHP, таких как:<br>
                    - обновление навыков вёрстки (HTML+CSS)<br>
                    - основные навыки PHP<br>
                    - работа с базой данных и вывод её данных<br>
                    - реализация системы комментариев, а так же пагинации<br>
                    - счетчики просмотров<br>
                    - авторизация и регистрация<br>
                    - восстановление доступа к аккаунту<br>
                    - работа в сессии<br>
                    - сохранение логина и пароля при желании<br>
                </p>   

                      
                 
            </section>


        </main>


        
        <div class="sidebar">
            <?php include 'includes/sidebar.php'?>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.html';
?>