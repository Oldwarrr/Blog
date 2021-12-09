<?php
// session_start();
require_once 'includes/functions.php';

$config = [
    'db' => [
        'username' => 'u1545194_default', //root
        'password' => 'XL8Q6UaLjvDX660z', //''
        'database' => 'u1545194_default',//blog
        'hostname' => 'localhost'//blog
    ],

    'admin' => [
        'username' => [
           
            'Alex',
            'Oldwarr'
            ]
    ]
];

require_once 'includes/db.php';

// Проверка на права администратора у пользователя
$admin = 0;
if(isset($_SESSION['login'])){
    if(in_array($_SESSION['login'], $config['admin']['username'])){
        $admin = 1;
    }
    else {
        $admin = 0;
    }
}

// Допустимые форматы файла картинки
$img_type = ["image/png","image/jpeg","image/gif"];
$img_article_type = ["image/png","image/jpeg"];
$file_max_size = 5242880; // Max Size  = 5 MB



$categories_q = $connection->query("SELECT * FROM `categories`");
$categories = [];
while($cat = mysqli_fetch_assoc($categories_q)){
    $categories[] = $cat;
}
if(isset($_COOKIE['login'])){
    $profile = $connection->query("SELECT * FROM `users` WHERE `login` = '$_COOKIE[login]'");
    $prof = mysqli_fetch_assoc($profile);
}else{
    if(isset($_SESSION['login'])){
        $profile = $connection->query("SELECT * FROM `users` WHERE `login` = '$_SESSION[login]'");
        $prof = mysqli_fetch_assoc($profile);
    }
}




// Добавление или отклонение статьи
if(isset($_GET['details'])){
    $new_article_details = $connection->query("SELECT * FROM `articles_on_moderation` WHERE `id` = '$_GET[id]'");
    $new_art_details = mysqli_fetch_assoc($new_article_details);
}

if(isset($_GET['remove'])){
    if($_GET['remove'] == "add"){
        $new_article_details = $connection->query("SELECT * FROM `articles_on_moderation` WHERE `id` = '$_GET[id]'");
        $new_art_details = mysqli_fetch_assoc($new_article_details);
        $connection->query("INSERT INTO `articles`(`title`, `image`,`text`,`category_id`,`author_id`,`pubdate`) VALUES(
            '$new_art_details[title]',
            '$new_art_details[image]',
            '$new_art_details[text]',
            '$new_art_details[category_id]',
            '$new_art_details[author_id]',
            '$new_art_details[pubdate]'
        )");
    }
    $connection->query("DELETE FROM `articles_on_moderation` WHERE `id` = '$_GET[id]'");
    header("Location: moderation.php");
    die;
}







// Изменение аватарки профиля


if(isset($_POST['upload_image'])){ //Кнопка отправки
    $file_name = $_FILES['avatar']['name'];
    $file_error = $_FILES['avatar']['error'];
    $file_type = $_FILES['avatar']['type'];
    $file_size = $_FILES['avatar']['size'];
    
    

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