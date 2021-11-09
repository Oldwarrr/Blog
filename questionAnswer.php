<?php
require_once 'includes/header.html';
require_once 'includes/db.php';
require_once 'includes/functions.php';

if(!isset($_SESSION['mail'])){
    header('Location: recover.php');
    die;
}

$fields = [
    'answer' => [
        'field_name' => 'Ответ'
    ]
];
$bdQuestion = $mysql->query("SELECT `question` FROM `users` WHERE `email`= '$_SESSION[mail]'");
$bdQuestionResult = $bdQuestion->fetch_assoc();
$bdAnswer = $mysql->query("SELECT `answer` FROM `users` WHERE `email`= '$_SESSION[mail]'");
$bdAnswerResult = $bdAnswer->fetch_assoc();
if(isset($_POST['submit'])){
    $fields = loadValue($fields);
    $_SESSION['errors'] = validate($fields);
    if(empty($_SESSION['errors'])){
        if($bdAnswerResult['answer'] == $_POST['answer']){
            $_SESSION['answer'] = $_POST['answer'];
            header('Location: newpass.php');
            die;
        }else{
            $_SESSION['errors'] .= "<li>- Неверный ответ</li>";
            header('Location: questionAnswer.php');
            die;
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
                    <label for="answer"><?php echo $bdQuestionResult['question']?></label>
                    <input name="answer" id="answer" type="text" autocomplete="off" autofocus>
                </div>
                <button name="submit" class="form__link" type="submit">Отправить</button>
            </form>
        </div>
    </div>
</header>

<?php
require_once 'includes/footer.html';
?>