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
            'admin',
            'Alex'
            ]
    ]
];

require_once 'includes/db.php';
if(isset($_SESSION['login'])){
    if(in_array($_SESSION['login'], $config['admin']['username'])){
        echo "Ты админ";
    }
}

