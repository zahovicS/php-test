<?php

namespace Src\Database;

use Src\DataBase\Abstracts\ORM;

class Query extends ORM{
    public function table(string $table_name){
        $this->table = $table_name;
        return $this;
    }
    public function query(string $query){
        $this->setQuery($this->table,$query);
        return $this;
    }
    public function prepare(array $values = []){
        foreach ($values as $column => $value) {
            $this->setValues(str_replace(":","",$column),$value);
        }
        return $this;
    }
}