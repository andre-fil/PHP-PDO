<?php
use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';


$databasePath= __DIR__ .'/banco.sqlite';

#$pdo = new PDO('sqlite:C:\Users\Andre\Documents\Alura\PHP-BD\php-pdo-projeto-inicial\banco.sqlite');
$pdo = new PDO('sqlite:'. $databasePath);
echo 'conectei!';

/*
$sqlDelete = 'DELETE FROM Students WHERE name = ?';

$stmt = $pdo->prepare($sqlDelete);
$stmt->bindValue(1,'Barreto FIlipe',PDO::PARAM_STR);
if ($stmt->execute()){
    echo 'Aluno deletado!!';
};

*/


$student = new Student(null,'Messi', new DateTimeImmutable("5-06-1987"));

$queryInsertion ='INSERT INTO Students (name,birthDate) VALUES (:nome, :birthDate)';

$preparedStatement = $pdo->prepare($queryInsertion);
$preparedStatement->bindValue(':nome',$student->name(), PDO::PARAM_STR);
$preparedStatement->bindValue(':birthDate',$student->birthDate()->format("Y-m-d"), PDO::PARAM_STR);

if($preparedStatement->execute()){
    echo "Alumo incluído";
};









$statment3 = $pdo->query('SELECT * FROM Students');
$statment3->execute();
$resultadoConsulta = $statment3->fetchAll(PDO::FETCH_ASSOC);
echo "PIMBA";  
var_dump($resultadoConsulta);
echo "EDNN";
exit();


