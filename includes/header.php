<?php
require_once 'includes/config.php';

$categories_q = $connection->query("SELECT * FROM `categories`");
$categories = [];
while($cat = mysqli_fetch_assoc($categories_q)){
    $categories[] = $cat;
}
if(isset($_COOKIE['login'])){
    $profile = $connection->query("SELECT * FROM `users` WHERE `login` = '$_COOKIE[login]'");
}else{
    $profile = $connection->query("SELECT * FROM `users` WHERE `login` = '$_SESSION[login]'");
}
$prof = mysqli_fetch_assoc($profile);


// Изменение аватарки профиля


// Допустимые форматы файла картинки
$img_type = ["image/png","image/jpeg","image/gif"];


if(isset($_POST['upload_image'])){ //Кнопка отправки
    $file_name = $_FILES['avatar']['name'];
    $file_error = $_FILES['avatar']['error'];
    $file_type = $_FILES['avatar']['type'];
    $file_size = $_FILES['avatar']['size'];
    $file_max_size = 5242880; // Max Size  = 5 MB
    

        if($file_error == 0){ // Нет ошибок
            if(!empty(array_search($file_type,$img_type)) || array_search($file_type,$img_type) == 0){ //Проверка формата файла
                if($file_size < $file_max_size){ // Проверка размера файла
                    if(!is_null($prof['avatar'])){
                        unlink("img/avatars/" . $prof['avatar']);
                    }
                    $nameAvatar = $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], "img/avatars/" . $nameAvatar);
                    $uploadAvatar = $connection->query("UPDATE `users` SET `avatar` = '$nameAvatar' WHERE `id` = '$prof[id]'");
                }else{
                    $_SESSION['file_error'] = "Слишком большой файл!";
                }
            }else{
                $_SESSION['file_error'] = "Неподходящий формат файла!";
            }       
        }elseif($file_error == 4) { // Ошибка №4
            $_SESSION['file_error'] = "Выберете картинку!";
        }
    header("Location: profile-info.php");
    die;   
}


if(isset($_GET['id'])){  
    $author_id = mysqli_fetch_assoc($connection->query("SELECT `author_id` FROM `articles` WHERE `id` = '$_GET[id]'"));
}
// Count of user`s articles
$personalArticlesCount = $connection->query("SELECT * FROM `articles` WHERE `author_id` = '$prof[id]'");
$persArtCount = mysqli_num_rows($personalArticlesCount);
// Count of user`s comments
$personalCommentsCount = $connection->query("SELECT * FROM `comments` WHERE `author_id` = '$prof[id]'");
$persComCount = mysqli_num_rows($personalCommentsCount);

?>


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