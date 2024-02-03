<?php

namespace Alura\Pdo\Infrastructure\Persistence;
use PDO;

class ConectionCreator
{


    public function createConnection() : PDO {
        $databasePath = __DIR__ .  '/../../../banco.sqlite';
        return new PDO('sqlite:'. $databasePath);
    }


};