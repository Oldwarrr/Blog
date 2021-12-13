<?php
if(!isset($_COOKIE['login'])){
    if(!isset($_SESSION['login'])){
        header('Location: startpage.php');
        die;
    }
}
if(!empty($_GET) &&  isset($_GET['do'])){
    if($_GET['do'] == 'exit'){
        unset($_SESSION['login']);
    setcookie('login','',time()-36000,'/');
    setcookie('password','',time()-36000,'/');
    header('Location: startpage.php');
    die;
    }
}
?>