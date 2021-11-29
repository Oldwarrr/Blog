
<div class="profile__main__info bold">
    Об аккаунте :
    <p class="profile__main__info__item"><em>Login:</em> <?=$prof['login']?></p>
    <p class="profile__main__info__item"><em>E-mail:</em> <?=$prof['email']?></p>
    <p class="profile__main__info__item"><em>Дата регистрации:</em> <?=$prof['reg_date']?></p>
    <p class="profile__main__info__item bold">
        Активность:
        <p class="profile__main__info__item"><em>Публикаций :</em> <?=$persArtCount?></p>
        <p class="profile__main__info__item"><em>Комментариев :</em> <?=$persComCount?></p>
    </p>

</div>
<div class="profile__main__img">
    <img class="profile__main__avatar" src="/img/<?php echo !empty($prof['avatar']) ? 'avatars/' . $prof['avatar'] : "no_avatar.png" ?>">

    <p style="color: red; font-weight: 700; text-align:center; text-decoration: underline;">
        <?php 
            if(isset($_SESSION['file_error'])){
                echo $_SESSION['file_error'];
            } 
            unset($_SESSION['file_error'])
        ?>
    </p>

    <form class="upload-image" action="" method="POST" enctype="multipart/form-data">
            <input id="upload-avatar" class="profile__main__upload-avatar" type="file" name="avatar">
            <label class="upload-avatar-wrapper" for="upload-avatar">
                <span class="upload-avatar__btn">Изменить аватар</span>
            </label>
            <input class="upload-avatar__btn" type="submit" name="upload_image" value="Загрузить">
    </form>
</div>