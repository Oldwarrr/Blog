<?php
require_once 'includes/config.php';
require_once 'includes/header.html';


$fields = [
    'email' => [
        'field_name' => 'E-mail'
    ]
];

if(isset($_POST['submit'])){
    $fields = loadValue($fields);
    $email = $_POST['email'];
    $_SESSION['errors'] = validate($fields);
    if(empty($_SESSION['errors'])){
        $bdEmail = $connection->query("SELECT * FROM `users` WHERE `email` = '$email'");
        if($bdEmail->num_rows > 0){
            $_SESSION['mail'] = $email;
            header('Location: questionAnswer.php');
            die;
        }else{
            $_SESSION['errors'] .= "<li>- Неверный или несуществующий E-mail</li>";
            header('Location: recover.php');
            die;
        }

    }else{
        header('Location: recover.php');
        die;
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
                    <label for="email">Введите E-mail, указанный при регистрации</label>
                    <input name="email" id="email" type="email" autocomplete="off" autofocus>
                </div>
                <button name="submit" class="form__link" type="submit">Отправить</button>
            </form>
        </div>
    </div>
</header>

<?php
require_once 'includes/footer.html';
?>