<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

#Conexão de Banco

$caminhoBanco = __DIR__ ."/banco.sqlite";

#Criando instância de banco
$pdo = new PDO('sqlite:'. $caminhoBanco);
echo "conectado!";


#Criando instância de objeto que será adicionado ao BD
$estudante = new Student(null,"André Filipe",new DateTimeImmutable("2002-07-02"));

#Consulta SQL
$sqlInsert = "INSERT INTO Students (name, birthDate) VALUES ('{$estudante -> name()}', '{$estudante->birthDate()->format('Y-m-d')}');";

#Executando consulta
$pdo->exec($sqlInsert);

#Criando a query de busca
$statment = $pdo->query("SELECT * FROM Students");

#Realizando a consulta
$studentDataList = $statment->fetchAll(PDO::FETCH_ASSOC);

var_dump($studentDataList);

#colocando os resultados em uma lista de objetos estudante

foreach ($studentDataList as $studentData) {
    $estudante = new Student(
        $studentData['id'],
        $studentData['name'],
        new DateTimeImmutable( $studentData['birthDate'])
    );




};



