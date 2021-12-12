<?php
require_once 'includes/config.php';
require_once 'includes/check_login_and_exit.php';


//Проверка существования страницы

$article = $connection->query("SELECT * FROM `articles` WHERE `id` = " . (int)$_GET['id']);
if(mysqli_num_rows($article) <= 0){
    // echo 'Статья не найдена';
}else{
    $art = mysqli_fetch_assoc($article);
    
    
    // Счетчик просмотров
    
    $connection->query("UPDATE `articles` SET `views` = `views` + 1 WHERE `id` =" . (int)$art['id']);
    
    
    //Добавление комментария
    
    if(isset($_POST['submit'])){
        $_SESSION['errors'] = '';
        if(!empty($_POST['comment'])){
            $date = date('d/m/Y H:i');
            $connection->query("INSERT INTO `comments`(`author`,`author_id`,`text`,`pubdate`,`articles_id`) VALUES('$prof[name]','$prof[id]','$_POST[comment]','$date','$art[id]')");
        }else{
            $_SESSION['errors'] .= '<span style="display:block;color:brown; margin-top:10px;">Заполните поле комментария!</span>';
            
        }
        header("Location: article.php?id=$art[id]");
        exit;
    }
    
    //Удаление статьи
    
    if(isset($_GET['delete']) &&($admin == 1 || $prof['id'] == $author_id['author_id'])){
        $connection->query("DELETE FROM `comments` WHERE `articles_id` = '$art[id]'");
        unlink("uploads/" . $art['image']);
        $connection->query("DELETE FROM `articles` WHERE `id` = '$art[id]'");
        header("Location: home.php");
        exit;
    }
    
    
    //Удаление комментария
    
    if(isset($_GET['comment_id'])){
        $author_comment_data = $connection->query("SELECT `author_id` FROM `comments` WHERE `id` = '$_GET[comment_id]'");
        $author_comment = mysqli_fetch_assoc($author_comment_data);
    }
    if(isset($_GET['delete_comment'])  && ($admin == 1 || $prof['id'] == $author_comment['author_id'])){
        $connection->query("DELETE FROM `comments` WHERE `id` = '$_GET[comment_id]'");
        header("Location: article.php?id=$art[id]");
        exit;    
    }
}
?>



<?php 
require_once 'includes/header.html';
include 'includes/header.php';
?>

<!-- -------------------------------------- -->
<!-- -------------------------------------- -->
<!-- -------------------------------------- -->
<!-- -------------------------------------- -->
<!-- -------------------------------------- -->
<!-- -------------------------------------- -->
<!-- -------------------------------------- -->

<!-- Контент -->





<div class="container">
    <div class="flex-container">


        <?php if(isset($art)){?>
            <!-- Условие 1 -->
            <main class="main">

            <section class="main__section">
                

                <div class="main__section__top">
                    <div class="article-pubdate"><?=$art['pubdate']?></div>
                    <div>
                        <?php
                         if($admin == 1 || $prof['id'] == $author_id['author_id']):?>
                        <div class="delete"><a class="color-brown" href="article.php?id=<?=$art['id']?>&delete=true">Удалить статью</a></div>
                        <?php endif?>
                        <div class="article-views" style="margin-top: 10px;">
                            <!-- Склонение слова "просмотры" -->
                            <?php
                                $declension = substr($art['views'], -1);
                                echo $art['views'];
                                if($declension == 1){
                                    echo " просмотр";
                                }elseif($declension >= 2 && $declension <= 4){
                                    echo " просмотра";
                                }else {
                                    echo " просмотров";
                                }
                            ?>
                        </div>
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

                    <div class="articles-block__article w100 comments">
                        <div class="articles-block__article__picture">

                    <?php
                        $authorAvatar = $connection->query("SELECT `avatar` FROM `users` WHERE `id` = '$comment[author_id]'");
                        $avatar = mysqli_fetch_assoc($authorAvatar);
                        if(!empty($avatar['avatar'])){
                    ?>
                        <img src="img/avatars/<?=$avatar['avatar']?>" alt="">
                    <?php
                        }else{
                    ?>
                        <img src="img/no_avatar.png" alt="">
                    <?php
                        }
                    ?>

                        </div>

                        <div class="articles-block__article__info">
                                <a class="articles-block__article__title" href="article.php?id=<?=$comment['articles_id']?>"><?=$comment['author']?></a>
                                <span><?=$comment['pubdate']?></span>
                                <p class="articles-block__article__text"><?=nl2br($comment['text'])?></p>
                            </div> 
                            <?php
                                if($admin == 1 || $prof['id'] == $comment['author_id'])
                                {
                            ?>
                            <a href="article.php?id=<?="$art[id]&delete_comment=true&comment_id=$comment[id]"?>" class="delete_comment-link">Удалить</a>
                            <?php
                                }
                            ?>
                    </div>

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
        <?php }else{?>
            <!-- Условие 2 -->
            <main class="main">
    
                <section class="main__section">
                    
                    <p>Статья не найдена!</p>        
                     
                </section>

            </main>
        <?php }?>

        
        <div class="sidebar">
            <?php include 'includes/sidebar.php'?>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.html';
?>