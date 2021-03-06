<?php
require_once 'includes/config.php';

// Count of user`s articles
$personalArticlesCount = $connection->query("SELECT * FROM `articles` WHERE `author_id` = '$prof[id]'");
$persArtCount = mysqli_num_rows($personalArticlesCount);
// Count of user`s comments
$personalCommentsCount = $connection->query("SELECT * FROM `comments` WHERE `author_id` = '$prof[id]'");
$persComCount = mysqli_num_rows($personalCommentsCount);
?>


<!-- BUTTON BACK_TO_TOP -->

<style>
    .back_to_top {
        position: fixed;
        /* bottom: 200px;
        right: 200px;
        z-index: 9999;
        width: 60px;
        height: 60px;
        font-size: 50px;
        line-height: 60px; */

        bottom: 100px;
        right: 15px;
        width: 45px;
        height: 45px;
        font-size: 35px;
        line-height: 45px;
        text-align: center;
        background: #6e5b5b;
        color: #fff;
        cursor: pointer;
        border-radius: 2px;
        display: none;


        
    }

    .back_to_top:hover {
        background: #332626;
    }

    .back_to_top-show {
        display: block;
    }
</style>
<a class="back_to_top">&uarr;</a>

<!-- ------------------ -->



<div class="header-mobile">
    <div class="header-mobile__menu ">
        Меню
    </div>
    <div class="close-menu"></div>
    <div class="header-mobile__menu__active-main ">
        <ul class="header__nav__list">
            <li class="header__nav__list__item">
                <a href="profile-info.php" class="header__nav__list__item__link">Мой профиль</a>
            </li>
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
                <a href="https://github.com/Oldwarrr?tab=repositories" class="header__nav__list__item__link" target="_blank">GitHub</a>
            </li>
            <li class="header__nav__list__item">
                <a href="home.php?do=exit" class="header__nav__list__item__link">Выход</a>             
            </li>
        </ul>
    </div>
    
    <div class="header-mobile__category">Категории</div>
    <div class="header-mobile__menu__active ">
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
    </div>
    <a href="post_article.php" class="header__nav__list__item__link post_article_link">Опубликовать статью</a>
</div>



<header class="header home">
    <div class="container flex">
        <div class="profile">
            <div class="profile__logo"><img class="profile__logo__image" src="/img/<?php echo !empty($prof['avatar']) ? 'avatars/' . $prof['avatar'] : "no_avatar.png" ?>" alt=""></div>

            <a href="profile-info.php" class="profile__info">
                <?php
                echo $prof['name'];
                if($admin == 1){
                    echo " (A)";
                }
                ?>
            </a>

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

                <li class="header__nav__list__item">
                    <a href="post_article.php" class="header__nav__list__item__link post_article_link">Опубликовать статью</a>
                </li>
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
                    <a href="https://github.com/Oldwarrr?tab=repositories" class="header__nav__list__item__link" target="_blank">GitHub</a>
                </li>
                <li class="header__nav__list__item">
                    <a href="home.php?do=exit" class="header__nav__list__item__link">Выход</a>             
                </li>
            </ul>
        </nav>
    </div>
</header>