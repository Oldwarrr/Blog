<?php
session_start();
require_once 'includes/functions.php';

$config = [
    'db' => [
        'hostname' => 'blog',
        'username' => 'root',
        'password' => '',
        'database' => 'blog'
        ]
    ];

require_once 'includes/db.php';