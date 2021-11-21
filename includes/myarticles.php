<?php
    $articles = $connection->query("SELECT * FROM `articles` WHERE `author_id` = '$prof[id]' ORDER BY `id` DESC");

    while($art = mysqli_fetch_assoc($articles))
    
    {      
?>

<div class="articles-block__article">
    <div class="articles-block__article__picture">
        <img src="uploads/<?=$art['image']?>" alt="">
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
