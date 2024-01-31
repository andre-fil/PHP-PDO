<?php
use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';


$databasePath= __DIR__ .'/banco.sqlite';

#$pdo = new PDO('sqlite:C:\Users\Andre\Documents\Alura\PHP-BD\php-pdo-projeto-inicial\banco.sqlite');
$pdo = new PDO('sqlite:'. $databasePath);
echo 'conectei!';

#USUALMWNTE USADO
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

$statment3 = $pdo->query('SELECT * FROM Students WHERE id = 8');
$statment3->execute();
$resultadoConsulta = $statment3->fetch(PDO::FETCH_ASSOC);
echo "PIMBA";  
var_dump($resultadoConsulta);
echo "EDNN";
exit();



#FAZENDO CONSULTA COM VÁRIOS REGISTROS COM WHILE
echo "begom";
$statment = $pdo->query('SELECT * FROM Students');

#USADO QUANDO SE TEM MUITOS DADOS

while ($resultado = $statment->fetch(PDO::FETCH_ASSOC)) {
    $estudante = new Student(
        $resultado['id'],
        $resultado['name'],
        new DateTimeImmutable($resultado['birthDate']),

    );

    echo $estudante->age();
    

};
