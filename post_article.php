<?php
require_once 'includes/config.php';
require_once 'includes/header.html';
require_once 'includes/check_login_and_exit.php';
include 'includes/header.php';



$fields = 
[
    'category_list' => [
        'field_name' => 'Категория'
    ],
    'category_name' => [
        'field_name' => 'Название статьи'
    ],
    'article_text' => [
        'field_name' => 'Текст'
    ],
    
];



if(isset($_POST['submit'])){
    $_SESSION['errors'] = '';
    $fields = loadValue($fields);
    $_SESSION['errors'] = validate($fields);
    if(empty($_SESSION['errors'])){
        $category_list = $fields['category_list']['value'];
        $category_name = $fields['category_name']['value'];
        $article_text = $fields['article_text']['value'];

        $post_article_image_name = $_FILES['post_article_image']['name'];
        $post_article_image_type = $_FILES['post_article_image']['type'];
        $post_article_image_size = $_FILES['post_article_image']['size'];

        
        
        if(is_numeric(array_search($post_article_image_type, $img_article_type))){
            
            if($post_article_image_size < $file_max_size){
                move_uploaded_file($_FILES['post_article_image']['tmp_name'],"uploads/" . $post_article_image_name);

                $add_article = $connection->query("INSERT INTO `articles_on_moderation`(`title`, `image`,`text`,`category_id`,`author_id`) VALUES(
                    '$category_name',
                    '$post_article_image_name',
                    '$article_text',
                    '$category_list',
                    '$prof[id]'
                )");
                // $id_new_artice = $connection->query("SELECT `id` FROM `articles` WHERE `text` = '$article_text'");
                // $id_art = mysqli_fetch_assoc($id_new_artice);
                header("Location: articles.php");//?id=$id_art[id]
                die;

                $_SESSION['errors'] .= "<li style='color: green'>Форма успешно отправлена!</li>";
            }else{
                $_SESSION['errors'] .= "<li>- Слишком большой файл!</li>";
            }
        }else{
            $_SESSION['errors'] .= "<li>- Неподходящий формат файла для картинки статьи!</li>";
        }


        




    }else {
        // redirect repeat post form
    }
    header("Location: post_article.php");
        die;
    
}

?>




<div class="container">
    <div class="flex-container">


        <main class="main">
            
            <!-- Form -->
            <section class="main__section"  id="comment-block" >
                
                <h1 class="article-title">Новая статья</h1>


                <form class="form-post-article" action="" method="POST" enctype="multipart/form-data">

                    <!-- Вывод ошибки -->
                    <?php
                        if(!empty($_SESSION['errors'])){
                            echo $_SESSION['errors'];
                        }
                        unset($_SESSION['errors']);
                    ?>

                    <label class="marg15_0" for="category_list">Выберете категорию статьи:</label>
                    <select class="category_list" name="category_list" id="category_list">
                        <option name="category_list_name" disabled selected>Категория статьи</option>
                        <option name="category_list_name" value="1">HTML&CSS</option>
                        <option name="category_list_name" value="2">PHP</option>
                        <option name="category_list_name" value="3">JavaScript</option>
                        <option name="category_list_name" value="4">Безопасность</option>
                    </select>

                    <label for="category_name">Введите название статьи:</label>
                    <input class="category_name" type="text" name="category_name" id="category_name" autocomplete="off">

                    <label for="post_article_image">Картинка для статьи:</label>
                    <input class="post_article_image" type="file" name="post_article_image" id="post_article_image" required>
                    
                    <textarea class="comment-form__comment" name="article_text" id="article_text" cols="30" rows="20"></textarea>
                    
                    <input class="comment-form__submit" name="submit" type="submit" value="Опубликовать">

                </form>
                

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