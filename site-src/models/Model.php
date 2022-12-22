<?php

/**
 * @file
 * Model class file.
 */

declare(strict_types=1);

namespace PAWeb\Models;

use PDO;
use PAWeb\Database;

abstract class Model
{
    protected PDO $connection;
    protected string $table;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    protected function generalInsert(array $fields, array $values)
    {
        $query = "INSERT INTO " . $this->table . "(";

        $i = 0;
        foreach ($fields as $value) {
            if ($i > 0) {
                $query .= ', ';
            }
            $query .= $value;

            $i++;
        }
        $query .= ")";

        $prepareString = "(";
        $i = 0;
        foreach ($fields as $value) {
            if ($i > 0) {
                $prepareString .= ', ';
            }
            $prepareString .= '?';
            $i++;
        }

        $prepareString .= ")";

        $query .= " VALUES ";
        $query .= $prepareString;


        $prep = $this->connection->prepare($query);

        if ($prep->execute($values)) {
            return $this->connection->lastInsertId();
        }
        return (-1);
    }


    public function fetchOne($id)
    {
        $prep = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $prep->execute([
            'id' => $id
        ]);

        return $prep->fetch();
    }

    public function fetchAll()
    {
        $prep = $this->connection->prepare("SELECT * FROM " . $this->table);
        $prep->execute();

        return $prep;
    }

    public function deleteOne($id)
    {
        $prep = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        $prep->execute([
            'id' => $id
        ]);

        return $prep->fetch();
    }

    public function deleteAll($column, $value)
    {
        $prep = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE " . $column . " = :value");
        $prep->execute([
            'value' => $value
        ]);

        return $prep;
    }

    public function updateOne($id, $column, $value)
    {
        $prep = $this->connection->prepare("UPDATE " . $this->table . " SET " . $column . " = :value  WHERE id = :id");
        $prep->execute([
            'id' => $id,
            'value' => $value
        ]);

        return $prep;
    }
}
