<?php
require_once 'includes/config.php';
require_once 'includes/header.html';
require_once 'includes/check_login_and_exit.php';
include 'includes/header.php';
?>

<!-- Проверка существования страницы -->
<?php
    $article = $connection->query("SELECT * FROM `articles` WHERE `id` = " . (int)$_GET['id']);
    if(mysqli_num_rows($article) <= 0){
        echo 'Статья не найдена';
    }else 
    
    {
    $art = mysqli_fetch_assoc($article);
    // Счетчик просмотров
    $connection->query("UPDATE `articles` SET `views` = `views` + 1 WHERE `id` =" . (int)$art['id']);
?>

<!-- Добавление комментария -->
<?php                     
    if(isset($_POST['submit'])){
        $_SESSION['errors'] = '';
        if(!empty($_POST['comment'])){
            $connection->query("INSERT INTO `comments`(`author`,`text`,`articles_id`) VALUES('$prof[name]','$_POST[comment]','$art[id]')");
        }else{
            $_SESSION['errors'] .= '<span style="display:block;color:brown; margin-top:10px;">Заполните поле комментария!</span>';
            
        }
        header("Location: article.php?id=$art[id]");
            exit;
    }else{
        
    }
?>



<!-- Удаление статьи -->
<?php

    if(isset($_GET['delete']) &&($admin == 1 || $prof['id'] == $author_id['author_id'])){
        $connection->query("DELETE FROM `comments` WHERE `articles_id` = '$art[id]'");
        unlink("uploads/" . $art['image']);
        $connection->query("DELETE FROM `articles` WHERE `id` = '$art[id]'");
        header("Location: home.php");
        exit;
    }
?>




<div class="container">
    <div class="flex-container">


        <main class="main">

            <section class="main__section">
                

                <div class="main__section__top">
                    <div class="article-pubdate"><?=$art['pubdate']?></div>
                    <div>
                        <?php
                         if($admin == 1 || $prof['id'] == $author_id['author_id']):?>
                        <div class="delete"><a class="color-brown" href="article.php?id=<?=$art['id']?>&delete=true">Удалить статью</a></div>
                        <?php endif?>
                        <div class="article-views"><?=$art['views']?> просмотров</div>
                    </div>
                </div>
                <img class="article-image" src="uploads/<?=$art['image']?>" alt="">
                <h1 class="article-title"><?=$art['title']?></h1>
                <p class="article-text"><?=nl2br($art['text'])?></p>           
                 
            </section>

            <section class="main__section" id="comments">
            
                <div class="main__section__top" >
                    

                    


                    <!-- Проверка наличия комментариев -->
                    <?php
                        $comments = $connection->query("SELECT * FROM `comments` WHERE `articles_id` =  {$art['id']} ORDER BY `id` DESC");
                        if(mysqli_num_rows($comments) > 0){
                    ?>

                    <h3 class="article-title ta-left margTop0">Комментарии:</h3>
                    <a href="#comment-block" class="section__top__view-all">Добавить комментарий</a>
                    
                    <?php
                        }else{
                    ?>

                    <h3 class="article-title ta-left" style="margin: 0;">Комментариев нет.</h3>
                    
                    <?php
                        }
                    ?>


                </div>  


                    <!-- Вывод комментариев -->
                    <?php
                        while($comment = mysqli_fetch_assoc($comments))  
                        {      
                    ?>

                    <div class="articles-block__article w100">
                        <div class="articles-block__article__picture">
                            <img src="img/comment.jpg" alt="">
                        </div>
                        <div class="articles-block__article__info">
                                <a class="articles-block__article__title" href="article.php?id=<?=$comment['articles_id']?>"><?=$comment['author']?></a>
                                <p class="articles-block__article__text"><?=nl2br($comment['text'])?></p>
                            </div> 
                    </div>

                    <?php
                        }
                    ?>

                <?php

                    }
                ?>
            </section>


            <!-- Form -->
            <section class="main__section"  id="comment-block" >
                
                <form class="form-comments" action="article.php?id=<?=$art['id']?>#comments" method="POST">
                    <p class="articles-block__article__title">Добавьте Ваш комментарий :</p>

                    <!-- Вывод ошибки о пустом textarea -->
                    <?php
                        if(!empty($_SESSION['errors'])){
                            echo $_SESSION['errors'];
                        }
                        unset($_SESSION['errors']);
                    ?>

                    <textarea class="comment-form__comment" name="comment" id="comment" cols="30" rows="10"></textarea>
                    <input class="comment-form__submit" name="submit" type="submit">
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