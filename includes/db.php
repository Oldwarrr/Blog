<?php
session_start();
$mysql = mysqli_connect(
    $config['db']['hostname'],
    $config['db']['username'],
    $config['db']['password'],
    $config['db']['database']
);

