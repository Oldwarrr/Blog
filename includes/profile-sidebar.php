
<?php
    // Количество статей на модерацию
    $articles_on_moderation = $connection->query("SELECT * FROM `articles_on_moderation` ORDER BY `id` DESC");
    $articles_on_moderation_count = mysqli_num_rows($articles_on_moderation);

    
?>

<ul class="profile__menu">
            

                <li class="profile__menu__item">
                    <a href="profile-info.php" class="profile__menu__link"><img class="profile__sidebar__images" src="/img/profile/profile.png" alt="">Профиль</a>
                </li>
                <li class="profile__menu__item">
                    <a href="profile-articles.php" class="profile__menu__link"><img class="profile__sidebar__images" src="/img/profile/articles.png" alt="">Мои статьи</a>
                </li>
                <li class="profile__menu__item">
                    <a href="profile-comments.php" class="profile__menu__link"><img class="profile__sidebar__images" src="/img/profile/comments.png" alt="">Мои комментарии</a>
                </li>
                <?php
                    if($admin == 1){
                ?>
                <li class="profile__menu__item">
                    <a href="moderation.php" class="profile__menu__link"><img class="profile__sidebar__images" src="/img/profile/moderation.png" alt="">На модерации
                        (   <?php
                                if($articles_on_moderation_count != 0){
                                    echo "<span style= 'color:red; font-size: 19px;'>$articles_on_moderation_count</span>";
                                }else{
                                    echo 0;
                                }
                            ?>
                        )
                    </a>
                </li>
                <?php
                    }
                ?>

            </ul>


            