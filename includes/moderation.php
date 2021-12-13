<style>
    *{
        box-sizing: border-box;
    }
    table{
        width: 100%;
        margin-bottom: 50px;
    }
    table,td{
        border: 1px solid black;
        border-collapse: collapse;
    }
    tr:first-child, td:first-child{
        text-align: center;
    }
    td{
        padding: 5px 10px;
    }
    .profile__main{
        display: block;
        padding: 25px 25px;
    }
    .moderation-article__icons-item, .moderation-article__icon img{
        /* display: block; */
        width: 30px;
        height: 30px;
        padding: 0;
    }
    .moderation-article__icon img{
        display: block;
        width: 40px;
        height: 40px;
        padding: 8px;
    }
    .moderation-article__icons-item:hover{
        background-color: gray;
    }

    /* Стиль вывода статьи */

    .article-image{
        max-width: 600px;
    }
    
</style>
<?php
    if($articles_on_moderation_count > 0){
?>
    <table>
        <tr>
            <td>№</td>
            <td>Название статьи</td>
            <td>Категория</td>
        </tr>
        <?php
            $check = 0;
            while($art_on_moderation = mysqli_fetch_assoc($articles_on_moderation)){
            $check++;
            $art_category_id = $art_on_moderation['category_id'] - 1;
            ?>
            <tr>
            <td><?=$check?></td>
            <td><?=$art_on_moderation['title']?></td>
            <td><?=$categories[$art_category_id]['title']?></td>
            <td><a href="moderation.php?id=<?=$art_on_moderation['id']?>&details"><span class="desc-max">Подробнее..</span><span class="desc-min">??</span></a></td>
            <td class="moderation-article__icons-item"><a class="moderation-article__icon" href="moderation.php?id=<?=$art_on_moderation['id']?>&remove=add"><img src="../img/profile/add_article.png" alt=""></a></td>
            <td class="moderation-article__icons-item"><a class="moderation-article__icon" href="moderation.php?id=<?=$art_on_moderation['id']?>&remove=del"><img src="../img/profile/decline_article.png" alt=""></a></td>
            </tr>

            <?php
            }
            ?>
    </table>
<?php
    }else{
        ?>
        <p>Нет статей для модерации</p>
        <?php
            }
?>