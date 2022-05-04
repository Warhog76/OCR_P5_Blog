<?php

function getPdo() :PDO {

    $dbhost = 'localhost:8889';
    $dbname = 'OCR_P5_Blog';
    $dbuser = 'root';
    $dbpswd = 'root';

    $pdo = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8',$dbuser,$dbpswd,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    return $pdo;
}