<?php
use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';


$databasePath= __DIR__ .'/banco.sqlite';

#$pdo = new PDO('sqlite:C:\Users\Andre\Documents\Alura\PHP-BD\php-pdo-projeto-inicial\banco.sqlite');
$pdo = new PDO('sqlite:'. $databasePath);
echo 'conectei!';

$student = new Student(null,'André Barreto', new DateTimeImmutable('2000-02-07'));

$sqlInsert = "INSERT INTO Students (name, birthDate) VALUES ('{$student ->  name()}', '{$student -> birthDate()->format('Y-m-d')}');";

echo $sqlInsert;

var_dump($pdo->exec($sqlInsert));