<?php
require_once 'includes/config.php';
require_once 'includes/header.html';

if(!isset($_COOKIE['login'])){
    if(!isset($_SESSION['login'])){
        header('Location: startpage.php');
        die;
    }
}
if(!empty($_GET) && $_GET['do'] == 'exit'){
    unset($_SESSION['login']);
    unset($_SESSION['password']);
    setcookie('login','',time()-36000,'/');
    setcookie('password','',time()-36000,'/');
    header('Location: startpage.php');
    die;
}
?>

<?php include 'includes/header.php';


?>


<div class="container">
    <div class="flex-container">


        <main class="main"> 



            <!-- Все новые статьи -->
            <section class="main__section art-all">
                <div class="main__section__top">
                    <div class="title">Последние статьи блога</div>
                    <a href="articles.php" class="section__top__view-all">Все записи</a>
                </div>
                <div class="articles-block fd-row">

                    <?php
                        $articles = $mysql->query("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 6");
                    
                        while($art = mysqli_fetch_assoc($articles))
                        
                        {      
                    ?>

                    <div class="articles-block__article">
                        <div class="articles-block__article__picture">
                            <img src="img/<?=$art['image']?>" alt="">
                        </div>
                        <div class="articles-block__article__info">
                            <a class="articles-block__article__title" href="article.php?id=<?=$art['id']?>"><?=$art['title']?></a>
                            <?php
                                $art_cat = false;
                                foreach($categories as $cat){
                                    if($cat['id'] == $art['category_id']){
                                        $art_cat = $cat;
                                        break;
                                    }
                                }
                            ?>
                            <a href="articles.php?category=<?=$art_cat['id']?>" class="articles-block__article__category">Категория: <?=$art_cat['title']?></a>
                            <p class="articles-block__article__text"><?= mb_substr($art['text'], 0, 65, 'utf-8') . " ..."?></p>
                        </div>
                    </div>
                    <?php
                    
                        }
                    
                    ?>




                </div>         
            </section>


            <!-- Последние в  HTML&CSS-->
            <section class="main__section art-html">
                <div class="main__section__top">
                    <div class="title">HTML&CSS[Последние]</div>
                    <a href="articles.php?category=1&page=1" class="section__top__view-all">Все записи</a>
                </div>
                <div class="articles-block fd-row">
                    


                <?php
                        $articles = $mysql->query("SELECT * FROM `articles` WHERE `category_id` = '1' ORDER BY `id` DESC LIMIT 6");

                        while($art = mysqli_fetch_assoc($articles))
                        
                        {      
                    ?>

                    <div class="articles-block__article">
                        <div class="articles-block__article__picture">
                            <img src="img/<?=$art['image']?>" alt="">
                        </div>
                        <div class="articles-block__article__info">
                            <a class="articles-block__article__title" href="article.php?id=<?=$art['id']?>"><?=$art['title']?></a>
                            <?php
                                $art_cat = false;
                                foreach($categories as $cat){
                                    if($cat['id'] == $art['category_id']){
                                        $art_cat = $cat;
                                        break;
                                    }
                                }
                            ?>
                            <a href="articles.php?category=<?=$art_cat['id']?>" class="articles-block__article__category">Категория: <?=$art_cat['title']?></a>
                            <p class="articles-block__article__text"><?= mb_substr($art['text'], 0, 65, 'utf-8') . " ..."?></p>
                        </div>
                    </div>
                    <?php
                    
                        }
                    
                    ?>



                </div>  
            </section>



            <!-- Последние в PHP -->
            <section class="main__section art-php">
                <div class="main__section__top">
                    <div class="title">PHP[Последние]</div>
                    <a href="articles.php?category=2&page=1" class="section__top__view-all">Все записи</a>
                </div>
                <div class="articles-block fd-row">
                    


                <?php
                        $articles = $mysql->query("SELECT * FROM `articles` WHERE `category_id` = '2' ORDER BY `id` DESC LIMIT 6");

                        while($art = mysqli_fetch_assoc($articles))
                        
                        {      
                    ?>

                    <div class="articles-block__article">
                        <div class="articles-block__article__picture">
                            <img src="img/<?=$art['image']?>" alt="">
                        </div>
                        <div class="articles-block__article__info">
                            <a class="articles-block__article__title" href="article.php?id=<?=$art['id']?>"><?=$art['title']?></a>
                            <?php
                                $art_cat = false;
                                foreach($categories as $cat){
                                    if($cat['id'] == $art['category_id']){
                                        $art_cat = $cat;
                                        break;
                                    }
                                }
                            ?>
                            <a href="articles.php?category=<?=$art_cat['id']?>" class="articles-block__article__category">Категория: <?=$art_cat['title']?></a>
                            <p class="articles-block__article__text"><?= mb_substr($art['text'], 0, 65, 'utf-8') . " ..."?></p>
                        </div>
                    </div>
                    <?php
                    
                        }
                    
                    ?>



                </div>
            </section>



            <!-- Последние в JavaScript-->
            <section class="main__section art-js">
                <div class="main__section__top">
                    <div class="title">JavaScript[Последние]</div>
                    <a href="articles.php?category=3&page=1" class="section__top__view-all">Все записи</a>
                </div>
                <div class="articles-block fd-row">
                    


                <?php
                        $articles = $mysql->query("SELECT * FROM `articles` WHERE `category_id` = '3' ORDER BY `id` DESC LIMIT 6");

                        while($art = mysqli_fetch_assoc($articles))
                        
                        {      
                    ?>

                    <div class="articles-block__article">
                        <div class="articles-block__article__picture">
                            <img src="img/<?=$art['image']?>" alt="">
                        </div>
                        <div class="articles-block__article__info">
                            <a class="articles-block__article__title" href="article.php?id=<?=$art['id']?>"><?=$art['title']?></a>
                            <?php
                                $art_cat = false;
                                foreach($categories as $cat){
                                    if($cat['id'] == $art['category_id']){
                                        $art_cat = $cat;
                                        break;
                                    }
                                }
                            ?>
                            <a href="articles.php?category=<?=$art_cat['id']?>" class="articles-block__article__category">Категория: <?=$art_cat['title']?></a>
                            <p class="articles-block__article__text"><?= mb_substr($art['text'], 0, 65, 'utf-8') . " ..."?></p>
                        </div>
                    </div>
                    <?php
                    
                        }
                    
                    ?>



                </div>               
            </section>



            <!-- Последние в Безопасность -->
            <section class="main__section art-secure">
                <div class="main__section__top">
                    <div class="title">Безопасность[Последние]</div>
                    <a href="articles.php?category=4&page=1" class="section__top__view-all">Все записи</a>
                </div>
                <div class="articles-block fd-row">
                    


                <?php
                        $articles = $mysql->query("SELECT * FROM `articles` WHERE `category_id` = '4' ORDER BY `id` DESC LIMIT 6");

                        while($art = mysqli_fetch_assoc($articles))
                        
                        {      
                    ?>

                    <div class="articles-block__article">
                        <div class="articles-block__article__picture">
                            <img src="img/<?=$art['image']?>" alt="">
                        </div>
                        <div class="articles-block__article__info">
                            <a class="articles-block__article__title" href="article.php?id=<?=$art['id']?>"><?=$art['title']?></a>
                            <?php
                                $art_cat = false;
                                foreach($categories as $cat){
                                    if($cat['id'] == $art['category_id']){
                                        $art_cat = $cat;
                                        break;
                                    }
                                }
                            ?>
                            <a href="articles.php?category=<?=$art_cat['id']?>" class="articles-block__article__category">Категория: <?=$art_cat['title']?></a>
                            <p class="articles-block__article__text"><?= mb_substr($art['text'], 0, 65, 'utf-8') . " ..."?></p>
                        </div>
                    </div>
                    <?php
                    
                        }
                    
                    ?>    



                </div>   
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