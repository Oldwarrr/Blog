<?php
require_once 'includes/config.php';
require_once 'includes/check_login_and_exit.php';


if($admin != 1){
    header("Location: profile-info.php");
    die;
}

require_once 'includes/header.html';
include 'includes/header.php';
?>
<div class="container">
    <div class="profile-block moderation">
        <div class="profile__sidebar moderation">
            <?php require_once 'includes/profile-sidebar.php' ?>
        </div>
        <main class="profile__main">
            <?php require_once 'includes/moderation.php'; ?>
            <?php
                if(isset($_GET['details'])){
                
            ?>
                <div>
                <img class="article-image" src="uploads/<?=$new_art_details['image']?>" alt="">
                <h1 class="article-title"><?=$new_art_details['title']?></h1>
                <p class="article-text"><?=nl2br($new_art_details['text'])?></p>
                </div>
            <?php
                }
            ?>
        </main>

    </div>
</div>

<?php require_once 'includes/footer.html'?>