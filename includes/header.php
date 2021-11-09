<?php
require_once 'db.php';

$categories_q = $mysql->query("SELECT * FROM `categories`");
$categories = [];
while($cat = mysqli_fetch_assoc($categories_q)){
    $categories[] = $cat;
}
if(isset($_COOKIE['login'])){
    $profile = $mysql->query("SELECT * FROM `users` WHERE `login` = '$_COOKIE[login]'");
}else{
    $profile = $mysql->query("SELECT * FROM `users` WHERE `login` = '$_SESSION[login]'");
}
$prof = mysqli_fetch_assoc($profile);
?>


<header class="header home">
    <div class="container flex">
        <div class="profile">
            <div class="profile__logo"></div>
            <div class="profile__info"><?=$prof['name']?></div>
            </div>
            <nav class="header__nav">
            <ul class="header__nav__list-category">
                <?php

                foreach($categories as $cat)
                    {

                ?>
                <li class="header__nav__list__item">
                    <a href="articles.php?category=<?=$cat['id']?>&page=1" class="header__nav__list__item__link"><?=$cat['title']?></a>
                </li>

                <?php
                    }
                ?>
            </ul>
        </nav>
    </div>
    
    
    <!-- Убрать style атрибут, ниже тоже убрать у абзаца
    !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
    <div class="container">
        <nav class="header__nav">
            <ul class="header__nav__list">
                <li class="header__nav__list__item">
                    <a href="/" class="header__nav__list__item__link">Главная</a>
                </li>
                <li class="header__nav__list__item">
                    <a href="about_project.php" class="header__nav__list__item__link">О проекте</a>
                </li>
                <li class="header__nav__list__item">
                    <a href="https://vk.com/id99243211" class="header__nav__list__item__link" target="_blank">ВКонтакте</a>
                </li>
                <li class="header__nav__list__item">
                    <a href="home.php?do=exit" class="header__nav__list__item__link">Выход</a>             
                </li>
            </ul>
        </nav>
    </div>
</header>