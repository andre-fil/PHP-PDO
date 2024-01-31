<?php
use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';


$databasePath= __DIR__ .'/banco.sqlite';

#$pdo = new PDO('sqlite:C:\Users\Andre\Documents\Alura\PHP-BD\php-pdo-projeto-inicial\banco.sqlite');
$pdo = new PDO('sqlite:'. $databasePath);
echo 'conectei!';

$student = new Student(null,'André Barreto', new DateTimeImmutable('2000-02-07'));

/*

$sqlInsert = "INSERT INTO Students (name, birthDate) VALUES ('{$student ->  name()}', '{$student -> birthDate()->format('Y-m-d')}');";

echo $sqlInsert;

var_dump($pdo->exec($sqlInsert));


$sqlInsert = "INSERT INTO Students (name, birthDate) VALUES (?,?)";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(1, $student->name());
$statement->bindValue(2,$student->birthDate()->format("Y-m-d"));

if($statement->execute()){
    echo"Aluno incluído";
}

#pode-se usar nome de parâmetros ao invés de usar acento de ?

$sqlInsert = "INSERT INTO Students (name, birthDate) VALUES (:name,:birthDate)";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birthDate',$student->birthDate()->format("Y-m-d"));
*/

$student2 = new Student(null,"Barreto FIlipe", new DateTimeImmutable("29-02-1996"));
$sqlInsert = "INSERT INTO Students (name, birthDate) VALUES (:name,:birthDate)";
$statement2 = $pdo->prepare($sqlInsert);
$statement2->bindValue(':name', $student2->name());
$statement2->bindValue(':birthDate',$student2->birthDate()->format("Y-m-d"));

$statment2 = $pdo->query("SELECT * FROM Students");
if($statement2->execute()){
    echo"Aluno incluído";
}


#$allStudents = $statment2->fetchAll(PDO::FETCH_ASSOC);
echo"begin";

while ($resultado = $statment2->fetch(PDO::FETCH_ASSOC)){
    $estudante = new Student(
        $resultado["id"],
        $resultado["name"],
        new DateTimeImmutable($resultado["birthDate"])
    );

    echo $estudante->age();
};    

echo "end";

#var_dump($allStudents);

















