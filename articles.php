<?php
require_once 'includes/config.php';
require_once 'includes/header.html';

if(!isset($_COOKIE['login'])){
    if(!isset($_SESSION['login'])){
        header('Location: startpage.php');
        die;
    }
}
if(isset($_GET['do'])){
    if(!empty($_GET) && $_GET['do'] == 'exit'){
        unset($_SESSION['login']);
        setcookie('login','',time()-36000,'/');
        setcookie('password','',time()-36000,'/');
        header('Location: startpage.php');
        die;
    }
}
?>

<?php include 'includes/header.php';






// Определение номера страницы
if(isset($_GET['page'])){
	
	$page = preg_replace('#[^0-9]#i','', $_GET['page']);
}else {
	$page = 1; // Номер страницы
}

$limit = 6; // Макс. количество статей на странице (Для SQL запроса)

// Количество статей в БД
if(isset($_GET['category'])){
    $countOfId = $connection->query("SELECT COUNT(`id`) FROM `articles` WHERE `category_id` =" . (int)$_GET['category']);
}else{
    $countOfId = $connection->query("SELECT COUNT(`id`) FROM `articles`"); 
}
$count = $countOfId->fetch_assoc()['COUNT(`id`)']; // Присвоение переменной значения,  равного количеству статей в БД
$pageCount = ceil($count / $limit); // Количество страниц пагинации

if($page < 1){ // Защита от нулевого значения номер страницы
	$page = 1;
}elseif($page > $pageCount){ // Если вписать значение страницы выше, чем последняя страница, выведет последнюю страницу
	$page = $pageCount;
}
$start = ($page - 1)*$limit; // Порядковый номер комментария, с которого идет отсчет в БД (Для SQL запроса)
$add = $connection->query("SELECT * FROM `articles` ORDER BY `articles` . `id` DESC LIMIT $start, $limit"); // Данные из БД


$centerPages = ""; // В дальнейшем заполняемый (в зависимости от условий) ряд с номерами страниц (пагинация)

// Переменные для управления поведением пагинации
$sub1 = $page - 1;
$sub2 = $page - 2;
$sub3 = $page - 3;
$sub4 = $page - 4;
$add1 = $page + 1;
$add2 = $page + 2;
$add3 = $page + 3;
$add4 = $page + 4;
$disabled = 'disabled';


if(isset($_GET['category'])){
    $articles = $connection->query("SELECT * FROM `articles` WHERE `category_id` = $_GET[category] ORDER BY `id` DESC LIMIT $start,$limit");
    if($pageCount >= 5){
        if($page == 1){
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add1'>$add1</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add2'>$add2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add3'>$add3</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add4'>$add4</a></li>";
        }elseif($page == ($pageCount -1)){
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub3'>$sub3</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub2'>$sub2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub1'>$sub1</a></li>";
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add1'>$add1</a></li>";
        }elseif($page ==$pageCount){
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub4'>$sub4</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub3'>$sub3</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub2'>$sub2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub1'>$sub1</a></li>";
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
        }elseif($page > 2 && $page <($pageCount - 1)){
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub2'>$sub2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub1'>$sub1</a></li>";
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add1'>$add1</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add2'>$add2</a></li>";
        }elseif($page = 2){
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$sub1'>$sub1</a></li>";
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add1'>$add1</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add2'>$add2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?category=$_GET[category]&page=$add3'>$add3</a></li>";
        }
    }
}else{
    $articles = $connection->query("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT $start,$limit");
    if($pageCount >= 5){
        if($page == 1){
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add1'>$add1</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add2'>$add2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add3'>$add3</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add4'>$add4</a></li>";
        }elseif($page == ($pageCount -1)){
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub3'>$sub3</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub2'>$sub2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub1'>$sub1</a></li>";
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add1'>$add1</a></li>";
        }elseif($page ==$pageCount){
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub4'>$sub4</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub3'>$sub3</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub2'>$sub2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub1'>$sub1</a></li>";
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
        }elseif($page > 2 && $page <($pageCount - 1)){
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub2'>$sub2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub1'>$sub1</a></li>";
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add1'>$add1</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add2'>$add2</a></li>";
        }elseif($page = 2){
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub1'>$sub1</a></li>";
            $centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add1'>$add1</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add2'>$add2</a></li>";
            $centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add3'>$add3</a></li>";
        }
    }
}


// if($pageCount >= 5){
// 	if($page == 1){
// 		$centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add1'>$add1</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add2'>$add2</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add3'>$add3</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add4'>$add4</a></li>";
// 	}elseif($page == ($pageCount -1)){
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub3'>$sub3</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub2'>$sub2</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub1'>$sub1</a></li>";
// 		$centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add1'>$add1</a></li>";
// 	}elseif($page ==$pageCount){
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub4'>$sub4</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub3'>$sub3</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub2'>$sub2</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub1'>$sub1</a></li>";
// 		$centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
// 	}elseif($page > 2 && $page <($pageCount - 1)){
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub2'>$sub2</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub1'>$sub1</a></li>";
// 		$centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add1'>$add1</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add2'>$add2</a></li>";
// 	}elseif($page = 2){
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$sub1'>$sub1</a></li>";
// 		$centerPages .= "<li><span class='pagination__page active'>$page</span></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add1'>$add1</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add2'>$add2</a></li>";
// 		$centerPages .= "<li><a class='pagination__page' href='$_SERVER[PHP_SELF]?page=$add3'>$add3</a></li>";
// 	}
// }






?>


<div class="container">
    <div class="flex-container">


        <main class="main">

            <!-- Все новые статьи -->
            <section class="main__section art-all">
                <div class="main__section__top">
                    <div class="title">Все статьи
                    <?php
                    
                        if(isset($_GET['category'])){
                            echo " категории -" . $categories[$_GET['category'] - 1]['title'];
                        }
                    
                    ?>
                    </div>
                </div>
                <div class="articles-block">

                    <?php
                        // $articles_category = $connection->query("SELECT * FROM `articles` WHERE `id` = " . (int)$_GET['category']);
                        // if(false){
                        //     echo 'Статья не найдена';
                        // }else 
                        
                        // {
                        
                    ?>




                    <div class="articles-block__content">
                    <?php
                        // $articles = $connection->query("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT $start,$limit");



                        // if(isset($_GET['category'])){
                        //     $articles = $connection->query("SELECT * FROM `articles` WHERE `category_id` =" . (int)$_GET['category']);
                        // }else{
                        //     $articles = $connection->query("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT $start,$limit");
                        // }
                    
                        while($art = mysqli_fetch_assoc($articles))
                        
                        {      
                    ?>

                    <div class="articles-block__article">
                        <div class="articles-block__article__picture">
                            <img src="img/<?=$art['image']?>" alt="">
                        </div>
                        <div class="articles-block__article__info">
                            <a class="articles-block__article__title" href="article.php?id=<?=$art['id']?>"><?=$art['title']?></a>
                            <?php
                                $art_cat = false;
                                foreach($categories as $cat){
                                    if($cat['id'] == $art['category_id']){
                                        $art_cat = $cat;
                                        break;
                                    }
                                }
                            ?>
                            <a href="articles.php?category=<?=$art_cat['id']?>" class="articles-block__article__category">Категория: <?=$art_cat['title']?></a>
                            <p class="articles-block__article__text"><?= mb_substr($art['text'], 0, 65, 'utf-8') . " ..."?></p>
                        </div>
                    </div>
                    <?php
                    
                        }
                        // }
                    ?>
                    </div>



                    <div class="pagination">



                        <?php
                        
                        if($pageCount > 1){

                            //Кнопка перехода на первую страницу
                            if($pageCount > 2){
                                if($page != 1){
                                    $disabled = "";
                                }else{
                                    $disabled = " disabled";
                                }
                                if(isset($_GET['category'])){
                                    echo "
                                    <li>
                                        <a class = 'pagination__page fw $disabled ' href = '?category=$_GET[category]&page=1'>В начало</a>
                                    </li>
                                    ";
                                }else{
                                    echo "
                                    <li>
                                        <a class = 'pagination__page fw $disabled ' href = '?page=1'>В начало</a>
                                    </li>
                                    ";
                                }
                            }
                        

                            
                            //Стрелка назад с блокировкой на стартовой странице
                            if($page != 1){
                                $disabled = "";	
                            }else{
                                $disabled = " disabled";
                            }
                            if(isset($_GET['category'])){
                                echo "
                                <li>
                                    <a class = 'pagination__page $disabled' href = '?category=$_GET[category]&page=$sub1'>«</a>
                                </li>
                            ";
                            }else{
                                echo "
                                    <li>
                                        <a class = 'pagination__page $disabled' href = '?page=$sub1'>«</a>
                                    </li>
                                ";
                            }


                            // Цикл вывода пагинации - СТАРЫЙ
                            if($pageCount < 5){ // Вывод циклом, если страниц меньше 5
                                for($i = 1; $i <= $pageCount; $i++){
                                    if($i > 0){
                                        if($page == $i){		
                                            $classActive = " active";
                                        }else {
                                            $classActive = "";
                                        }
                                        // echo "
                                        // <li>
                                        // <a class = 'pagination__page $classActive' href = '?page=$i'>$i</a>
                                        // </li>
                                        // ";
                                        if(isset($_GET['category'])){
                                            echo "
                                            <li>
                                            <a class = 'pagination__page $classActive' href = '?category=$_GET[category]&page=$i'>$i</a>
                                            </li>
                                            ";
                                        }else{
                                            echo "
                                            <li>
                                            <a class = 'pagination__page $classActive' href = '?page=$i'>$i</a>
                                            </li>
                                            ";
                                        }
                                    }
                                }
                            }else{
                                echo "<br>" . $centerPages;//Вывод пагинации - НОВЫЙ
                            }
                

                            //Стрелка вперед с блокировкой на последней странице
                            if($page != $pageCount){
                                $disabled = "";	
                            }else{
                                $disabled = " disabled";
                            }
                            if(isset($_GET['category'])){
                                echo "
                                <li>
                                    <a class = 'pagination__page $disabled' href = '?category=$_GET[category]&page=$add1'>»</a>
                                </li>
                                ";
                            }else{
                                echo "
                                <li>
                                    <a class = 'pagination__page $disabled' href = '?page=$add1'>»</a>
                                </li>
                                ";
                            }
                            


                            //Кнопка перехода на последнюю страницу
                            if($pageCount > 2){
                                // $disabled = "";	
                                if($page != $pageCount){
                                    $disabled = "";
                                }else{
                                    $disabled = " disabled";
                                }
                                if(isset($_GET['category'])){
                                    echo "
                                <li>
                                    <a class = 'pagination__page fw $disabled ' href = '?category=$_GET[category]&page=$pageCount'>В конец</a>
                                </li>
                                ";
                                }else{
                                    echo "
                                <li>
                                    <a class = 'pagination__page fw $disabled ' href = '?page=$pageCount'>В конец</a>
                                </li>
                                ";
                                }
                            }
                        }
                        
                        ?>

                        </div>


                </div>
                     
            </section>


            


        </main>


        
        <div class="sidebar">
            <?php include 'includes/sidebar.php'?>
        </div>
    </div>
</div>


<?php

require_once 'includes/footer.html';

?>