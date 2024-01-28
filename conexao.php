<?php

$databasePath = __DIR__ .'/banco.sqlite';

#$pdo = new PDO('sqlite:C:\Users\Andre\Documents\Alura\PHP-BD\php-pdo-projeto-inicial\banco.sqlite');
$pdo = new PDO('sqlite:'. $databasePath);
echo 'conectei!';


$pdo->exec('CREATE TABLE Students (id INTEGER PRIMARY KEY, name TEXT, birthDate TEXT )');
