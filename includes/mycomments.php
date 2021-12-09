<?php
$comments = $connection->query("SELECT * FROM `comments` WHERE `author_id` = '$prof[id]' ORDER BY `id` DESC");
$comments_count = mysqli_num_rows($comments);

        if($comments_count > 0){
            while($comment = mysqli_fetch_assoc($comments))
        
        {
              
    ?>
<div class="articles-block__article w100">
    
        <?php 
        $aricleImage = $connection->query("SELECT `image` FROM `articles` WHERE `id` = '$comment[articles_id]'");
        $aricleImage = mysqli_fetch_assoc($aricleImage);
        ?>
        <a class="mycomments__article-image" href="article.php?id=<?=$comment['articles_id']?>"><img src="uploads/<?=$aricleImage['image']?>" alt=""></a>
    
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
            <p class="articles-block__article__text">
                <?=$comment['text']?>
            </p>
        </div> 
</div>
<?php
    
    }
    }else{
        ?>
        <p>Вы не написали ни одного комментария.</p>
        <?php
        }
    
    ?>