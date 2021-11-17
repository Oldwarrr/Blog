<?php
session_start();
require_once 'includes/functions.php';


$config = [
    'db' => [
        'hostname' => 'blog',
        'username' => 'root',
        'password' => '',
        'database' => 'blog'
    ],

    'admin' => [
        'username' => [
           
            'Alex',
            'Oldwarr'
            ]
    ]
];

require_once 'includes/db.php';

// Проверка на права администратора у пользователя
$admin = 0;
if(isset($_SESSION['login'])){
    if(in_array($_SESSION['login'], $config['admin']['username'])){
        $admin = 1;
    }
    else {
        $admin = 0;
    }
}

