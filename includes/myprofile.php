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
<img class="profile__main__avatar" src="/img/<?php echo !empty($prof['avatar']) ? 'avatars/' . $prof['avatar'] : "no_avatar.png" ?>">