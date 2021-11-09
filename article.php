<?php
require_once 'includes/header.html';
require_once 'includes/db.php';
require_once 'includes/functions.php';
if(!isset($_COOKIE['login'])){
    if(!isset($_SESSION['login'])){
        header('Location: startpage.php');
        die;
    }
}
if(!empty($_GET) &&  isset($_GET['do'])){
    if($_GET['do'] == 'exit'){
        unset($_SESSION['login']);
    unset($_SESSION['password']);
    setcookie('login','',time()-36000,'/');
    setcookie('password','',time()-36000,'/');
    header('Location: startpage.php');
    die;
    }
}
?>

<?php include 'includes/header.php';


?>

<!-- Проверка существования страницы -->
<?php
    $article = $mysql->query("SELECT * FROM `articles` WHERE `id` = " . (int)$_GET['id']);
    if(mysqli_num_rows($article) <= 0){
        echo 'Статья не найдена';
    }else 
    
    {
    $art = mysqli_fetch_assoc($article);
    // Счетчик просмотров
    $mysql->query("UPDATE `articles` SET `views` = `views` + 1 WHERE `id` =" . (int)$art['id']);
?>

<!-- Добавление комментария -->
<?php                     
    if(isset($_POST['submit'])){
        $_SESSION['errors'] = '';
        if(!empty($_POST['comment'])){
            $mysql->query("INSERT INTO `comments`(`author`,`text`,`articles_id`) VALUES('$prof[name]','$_POST[comment]','$art[id]')");
        }else{
            $_SESSION['errors'] .= '<span style="display:block;color:red; margin-top:10px;">Заполните поле комментария!</span>';
            
        }
        header("Location: article.php?id=$art[id]");
            exit;
    }else{
        
    }

?>



<div class="container">
    <div class="flex-container">


        <main class="main">

            <section class="main__section">
                

                <div class="main__section__top">
                    <div class="article-pubdate"><?=$art['pubdate']?></div>
                    <div class="article-views"><?=$art['views']?> просмотров</div>
                </div>
                <img class="article-image" src="img/<?=$art['image']?>" alt="">
                <h1 class="article-title"><?=$art['title']?></h1>
                <p class="article-text"><?=nl2br($art['text'])?></p>           
                 
            </section>

            <section class="main__section" id="comments">
            
                <div class="main__section__top" >
                    

                    


                    <!-- Проверка наличия комментариев -->
                    <?php
                        $comments = $mysql->query("SELECT * FROM `comments` WHERE `articles_id` =  {$art['id']} ORDER BY `id` DESC");
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
                
                <form action="article.php?id=<?=$art['id']?>#comments" method="POST">
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