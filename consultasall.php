<?php
use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';


$databasePath= __DIR__ .'/banco.sqlite';

#$pdo = new PDO('sqlite:C:\Users\Andre\Documents\Alura\PHP-BD\php-pdo-projeto-inicial\banco.sqlite');
$pdo = new PDO('sqlite:'. $databasePath);
echo 'conectei!';

$statment = $pdo->query('SELECT * FROM Students');
$studentDataList = $statment->fetchAll(PDO::FETCH_ASSOC);

#var_dump($studentDataList); 



$studentList = [];



foreach($studentDataList as $studentData){
    $studentList = new Student(
        $studentData['id'],
        $studentData['name'],
        new DateTimeImmutable($studentData['birthDate']),
    );
var_Dump($studentList);



}
echo"end";



#FAZENDO CONSULTAS UNITÁRIAS

$statment = $pdo->query('SELECT * FROM Students WHERE id = 1');
$resultadoConsulta = $statment->fetch(PDO::FETCH_ASSOC);
var_dump($resultadoConsulta); exit();



