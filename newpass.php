<?php
require_once 'includes/config.php';
require_once 'includes/header.html';



if(!isset($_SESSION['answer'])){
    header('Location: recover.php');
    die;
}

$fields = [
    'password' => [
        'field_name' => 'Пароль'
    ],
    'repeatpassword' => [
        'field_name' => 'повтора пароля'
    ]
];


if(isset($_POST['submit'])){
    $fields = loadValue($fields);
    $_SESSION['errors'] = validate($fields);
    if(empty($_SESSION['errors'])){
        if($_POST['password'] == $_POST['repeatpassword']){
            $changePassword = $connection->query("UPDATE `users` SET `password` = '$_POST[password]' WHERE `email` = '$_SESSION[mail]'");
            $_SESSION['changePass'] = 1;
            header('Location: alertSuccess.php');
            die;
        }else{
            $_SESSION['errors'] .= "<li>- Пароли не совпадают</li>";
        }
    }
}


?>

<header class="startpage">
    <div class="container">
        <div class="startpage__content">
            <h1>Восстановление</h1>
            <form class="form" action="" method="post">
                <?php
                    if(!empty($_SESSION['errors'])){
                            echo "
                            <div class='form__item'>
                            <div class='text'>$_SESSION[errors]</div>
                            </div>
                            ";
                            unset($_SESSION['errors']);
                            
                        }
                ?>
                <div class="form__item">
                    <label for="password">Введите новый пароль</label>
                    <input name="password" id="password" type="password" autocomplete="off" autofocus>
                </div>
                <div class="form__item">
                    <label for="repeatpassword">Повторите пароль</label>
                    <input name="repeatpassword" id="repeatpassword" type="password">
                </div>
                <button name="submit" class="form__link" type="submit">Отправить</button>
            </form>
        </div>
    </div>
</header>

<?php
require_once 'includes/footer.html';
?>