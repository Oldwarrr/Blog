<?php
session_start();
$connection = mysqli_connect(
    $config['db']['hostname'],
    $config['db']['username'],
    $config['db']['password'],
    $config['db']['database']
);

