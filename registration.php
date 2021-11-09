<?php
require_once 'includes/config.php';
require_once 'includes/header.html';



$fields = 
[
    'name' => [
        'field_name' => 'Имя'
    ],
    'login' => [
        'field_name' => 'Логин'
    ],
    'password' => [
        'field_name' => 'Пароль'
    ],
    'email' => [
        'field_name' => 'E-mail'
    ],
    'secretQuestion' => [
        'field_name' => 'Вопрос'
    ],
    'answer' => [
        'field_name' => 'Ответ'
    ],
    'checkbox' => [
        'field_name' => 'Согласие'
    ]
    
];
?>


<!-- <textarea class="test-php"> -->
    <?php
    // pre($_POST);



    if(isset($_POST['submit'])){
        $fields = loadValue($fields);
        $_SESSION['errors'] = validate($fields);
        if(empty($_SESSION['errors'])){

            // На существование логина
            $login = $fields['login']['value'];
            $checkLogin = $connection->query("SELECT * FROM `users` WHERE `login` = '$login'");
            if($checkLogin->num_rows == 0){
                // На существование E-mail
                $email = $fields['email']['value'];
                $checkEmail = $connection->query("SELECT * FROM `users` WHERE `email` = '$email'");
                if($checkEmail->num_rows == 0){

                    $name = $fields['name']['value'];
                    $password = $fields['password']['value'];             
                    $secretQuestion = $fields['secretQuestion']['value'];
                    $answer = $fields['answer']['value'];

                    // Сохранение в БД
                    $registration = $connection->query("INSERT INTO `users`(`name`, `login`, `password`, `email`, `question`, `answer`) 
                    VALUES(
                        '$name',
                        '$login',
                        '$password',
                        '$email',
                        '$secretQuestion',
                        '$answer'     
                        )");
                    
                    // Редирект на страницу-оповещение
                    $_SESSION['registration'] = 1;
                    header('Location: alertSuccess.php');
                    die;
                }else{
                    $_SESSION['errors'] .= "<li>- Такой E-mail уже существует</li>";
                }
            }else{
                $_SESSION['errors'] .= "<li>- Такой логин уже существует</li>";
            }


            // echo "Все поля заполнены"; // Индикатор исправности
            
            
            
        }else{
            // echo "Заполните все поля!"; // Индикатор исправности
            header('Location: registration.php');
            die;
         
        }
    }else{
        // echo 'Неотправленная форма';  // Индикатор исправности
    }

    // pre($_SESSION);

    ?>
<!-- </textarea> -->



<header class="startpage">
    <div class="container">
        <div class="startpage__content">
            <h1>Регистрация</h1>
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
                    <label for="name">Введите Имя</label>
                    <input name="name" id="name" type="text" autocomplete="off" autofocus>
                </div>
                <div class="form__item">
                    <label for="login">Введите Логин</label>
                    <input name="login" id="login" type="text" autocomplete="off">
                </div>
                <div class="form__item">
                    <label for="password">Введите пароль</label>
                    <input name="password" id="password" type="password">
                </div>
                <div class="form__item">
                    <label for="email">Введите E-mail</label>
                    <input name="email" id="email" type="email" autocomplete="off">
                </div>
                <div class="form__item">
                    <select name="secretQuestion" class="secretQuestion">
                        <option name="question" disabled selected>Выберете секретный вопрос</option>
                        <option name="question" value="Имя любимого преподавателя">Имя любимого преподавателя</option>
                        <option name="question" value="Ваше любимое блюдо">Ваше любимое блюдо</option>
                        <option name="question" value="Девичья фамилия матери">Девичья фамилия матери</option>
                    </select>
                </div>
                <div class="form__item">
                    <label for="answer">Ответ :</label>
                    <input name="answer" id="answer" type="text" autocomplete="off">
                </div>
                <div class="form__item checkbox__block">
                    <input name="checkbox" id="checkbox" type="checkbox">
                    <span class="checkbox-fake"></span>
                    <label for="checkbox" class="ta-right"> Я согласен на обработку моих персональных данных</label>
                </div>
                <div class="form__item">
                    <a href="authorization.php" class="form-transition">У меня уже есть аккаунт</a>
                </div>
                <button name="submit" class="form__link" type="submit" value="1">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</header>

<!-- Testing PHP Scripts -->


<?php
require_once 'includes/footer.html';
?>