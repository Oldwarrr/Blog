<?php
require_once 'includes/config.php';
require_once 'includes/header.html';
require_once 'includes/check_login_and_exit.php';
include 'includes/header.php';
?>

<div class="container">
    <div class="profile-block">


        <div class="profile__sidebar">
            <?php require_once 'includes/profile-sidebar.php' ?>
        </div>

        <main class="profile__main">
            <section class="mycomments">
                <?php require_once 'includes/mycomments.php'; ?>
            </section>
        </main>


    </div>
</div>

<?php require_once 'includes/footer.html'?>