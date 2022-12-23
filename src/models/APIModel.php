<?php

namespace APP\Models;

class APIModel extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->table = "USERS";
    }

    public function insert(array $values)
    {
        return $this->generalInsert(
            array(
                "value"
            ),
            $values
        );
    }
}
