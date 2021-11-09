<?php
function pre($arr, $mode = 1){
    // echo "<pre>";
    $mode == 1 ? print_r($arr) : var_dump($arr);
    // echo "</pre>";
}
//Загрузка данных формы
function loadValue($data){
    foreach($_POST as $k => $v){
        if(array_key_exists($k, $data)){
            $data[$k]['value'] = trim(strip_tags(stripcslashes(htmlspecialchars($v))));
        }
    }
    return $data;
}
function validate($data){
    $errors = '';
    foreach($data as $k => $v){
        if(empty($data[$k]['value'])){
            $errors .= "<li>- Вы не заполнили поле {$data[$k]['field_name']}</li>";
        }
    }
    if(isset($data['name']['value']) && strlen($data['name']['value']) > 50){
        $errors .= "<li>- Слишком длинный {$data['name']['field_name']}</li>";
    }
    if(isset($data['login']['value']) && strlen($data['login']['value']) > 32){
        $errors .= "<li>- Слишком длинный {$data['login']['field_name']}</li>";
    }
    if(isset($data['password']['value']) && strlen($data['password']['value']) > 32){
        $errors .= "<li>- Слишком длинный {$data['password']['field_name']}</li>";
    }
    if(isset($data['repeatpassword']['value']) && strlen($data['repeatpassword']['value']) > 32){
        $errors .= "<li>- Слишком длинный {$data['repeatpassword']['field_name']}</li>";
    }
    if(isset($data['email']['value']) && strlen($data['email']['value']) > 50){
        $errors .= "<li>- Слишком длинный {$data['email']['field_name']}</li>";
    }
    if(isset($data['answer']['value']) && strlen($data['answer']['value']) > 50){
        $errors .= "<li>- Слишком длинный {$data['answer']['field_name']}</li>";
    }
    return $errors;
}