<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Infrastructure\Persistence\ConectionCreator;
use Alura\Pdo\Domain\Model\Student;
use PDO;

Class PdoStudentRepository implements StudentRepository
{

    private PDO $connection;

    public function __construct(){
        $this->connection = ConectionCreator::createConnection();
    }

    public function allStudents() :array
    {
        $selectQuery = 'SELECT * FROM Students';
        $stmt = $this->connection->query($selectQuery);

        return $this->hydrateStudentList($stmt);

    }

    public function studentsBirthAt(\DateTimeInterface $birthDate) :array
    {
        $selectBirth = 'SELECT * FROM Students WHERE birthDate = ?;';
        $stmt = $this->connection->prepare($selectBirth);
        $stmt->bindValue(1,$birthDate->format('Y-m-d'));
        $stmt->execute();

        return $this->hydrateStudentList($stmt);
    }

    


    public function save(Student $student) : bool
    {
        if($student->id() === null)
        {
            return $this->insert($student);
        }

        return $this->update($student);
    }

    private function insert(Student $student) :bool
    {
        $insertQuery = 'INSERT INTO Students (name, birthDate) VALUES (:name, :birthDate)';
        $stmt = $this->connection->prepare($insertQuery);
        #método de bindValue alternativo (array associativo)
        $sucess = $stmt->execute([':name' => $student->name(), ':birthDate' => $student->birthDate()->format('Y-m-d')]);

        if($sucess){
            $student->defineId($this->connection->lastInsertId());
        }
        
        return $sucess;

    }

    private function update(Student $student)
    {
        $updateQuery = 'UPDATE Students SET name = :name, birthDate = :birthDate WHERE id = :id';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':name', $student->name(),PDO::PARAM_STR);
        $stmt->bindValue(':birthDate', $student->birthDate()->format('Y-m-d'));
        $stmt->bindValue(':id',$student->id(),PDO::PARAM_INT);

        return $stmt->execute();
    }




    public function remove(Student $student) :bool
    {
        #$this->connection é só uma forma direta de: $pdo = new PDO('sqlite:.$databasePath');
        $stmt = $this->connection->prepare('DELETE FROM Students WHERE id = ?');
        $stmt->bindValue(1,$student->id(),PDO::PARAM_INT);
        return $stmt->execute();
    }
}