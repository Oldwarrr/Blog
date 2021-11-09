<aside class="aside__picture"><img src="img/img.jpg" alt="IMG"></aside>


            <!-- Топ статей -->
            <aside class="aside art-top">
                <div class="title">Топ читаемых статей</div>
                <?php
                        $articles = $mysql->query("SELECT * FROM `articles` ORDER BY `views` DESC LIMIT 5");
                    
                        while($art = mysqli_fetch_assoc($articles))
                        
                        {      
                    ?>
                <div class="articles-block__article w100">
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
            </aside>


            <!-- Последние комментарии -->
            <aside class="aside last-comments"><div class="title">Последние комментарии</div>
            <?php
                        $comments = $mysql->query("SELECT * FROM `comments` ORDER BY `id` DESC LIMIT 5");
                    
                        while($comment = mysqli_fetch_assoc($comments))
                        
                        {      
                    ?>
                <div class="articles-block__article w100">
                    <div class="articles-block__article__picture">
                        <img src="img/comment.jpg" alt="">
                    </div>
                    <div class="articles-block__article__info">
                            <a class="articles-block__article__title" href="article.php?id=<?=$comment['articles_id']?>"><?=$comment['author']?></a>
                            <p class="articles-block__article__text">
                                <?php 
                                echo mb_substr($comment['text'], 0, 65, 'utf-8');
                                if(strlen($comment['text']) > 65){
                                    echo " ...";
                                }
                                ?>
                            </p>
                        </div> 
                </div>
                <?php
                    
                        }
                    
                    ?>
            </aside>