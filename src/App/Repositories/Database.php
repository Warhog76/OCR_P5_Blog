<?php
namespace App\Repositories;

use PDO;

Class Database
{
    /*private $pdo;

    public function __construct($login, $password, $database_name, $host = 'localhost'){
        $this->pdo = new PDO("mysql:dbname=$database_name;host=$host", $login, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }*/

    public function getPdo() :PDO {

        $dbhost = 'localhost:8889';
        $dbname = 'OCR_P5_Blog';
        $dbuser = 'root';
        $dbpswd = 'root';

        $pdo = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8',$dbuser,$dbpswd,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);

        return $pdo;
    }

    /*public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }*/

}
