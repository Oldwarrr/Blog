<?php
require_once 'includes/config.php';

unset($_SESSION['mail']);
unset($_SESSION['answer']);
unset($_SESSION['changePass']);
unset($_SESSION['registration']);

if(isset($_COOKIE['login'])){
    header('Location: home.php');
    die;
}elseif(isset($_SESSION['login'])){
    header('Location: home.php');
    die;
}


$fields = [
    'login' => [
        'field_name' => 'Логин'
    ],
    'password' => [
        'field_name' => 'Пароль'
    ]
];
if(isset($_POST['submit'])){
    $fields = loadValue($fields);
    $_SESSION['errors'] = validate($fields);
    
    if(empty($_SESSION['errors'])){ //Если ошибок нет , пройдена валидация, то....
        
        $login = $fields['login']['value']; // введенный логин
        $checkLogin = $connection->query("SELECT * FROM `users` WHERE `login` = '$login'"); // Проверка через num_rows наличие логина
        if($checkLogin->num_rows > 0){
            $password = $fields['password']['value'];
            $dbPassword = $connection->query("SELECT `password` FROM `users` WHERE `login` = '$login'");
            $checkPassword = $dbPassword->fetch_assoc();
            if(password_verify($password, $checkPassword['password'])){
                if(isset($_POST['checkbox'])){
                    setcookie('login',$login,time()+36000,'/');
                }
                $_SESSION['login'] = $login;
                header('Location: home.php');
                die;
            }else{
                $_SESSION['errors'] .= "<li>- Неверный логин или пароль</li>";
            }
        }else{
            $_SESSION['errors'] .= "<li>- Неверный логин или пароль</li>";
        }

        


        
    }else{
        header('Location: authorization.php');
        die;
    }
}


require_once 'includes/header.html';

?>

<header class="startpage">
    <div class="container">
        <div class="startpage__content">
            <h1>Авторизация</h1>
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
                    <label for="login">Введите Логин</label>
                    <input name="login" id="login" type="text" autocomplete="off" autofocus>
                </div>
                <div class="form__item">
                    <label for="password">Введите пароль</label>
                    <input name="password" id="password" type="password">
                </div>
                <div class="form__item checkbox__block .ai-center">
                    <input name="checkbox" id="checkbox" type="checkbox">
                    <span class="checkbox-fake"></span>
                    <label for="checkbox">Запомнить меня</label>
                </div>
                <div class="form__item">
                    <a href="recover.php" class="form-transition">Забыл пароль?</a>
                    <a href="registration.php" class="form-transition">У меня нет аккаунта</a>
                </div>
                <button name="submit" class="form__link" type="submit">Войти</button>
            </form>
        </div>
    </div>
</header>

<?php
require_once 'includes/footer.html';
?>