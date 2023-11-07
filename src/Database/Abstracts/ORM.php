<?php

namespace Src\DataBase\Abstracts;

use Exception;
use Src\Database\Database;

abstract class ORM extends QueryBuilder
{

    protected $table = "";
    protected $primaryKey = "id";
    private $conn = null;
    private $columns = [];
    private $query;
    private $result;
    private $bootColumnStatus = false;

    function __construct()
    {
        $this->bootConnection();
    }

    public function get()
    {
        if ($this->getResultOfDB()) {
            $this->result = $this->query->fetchAll();
        }
        $this->resetQuery();
        return $this->result;
    }

    public function first()
    {
        if ($this->getResultOfDB()) {
            $this->result = $this->query->fetch();
        }
        $this->resetQuery();
        return $this->result;
    }

    public function find($id)
    {
        $primaryKey = $this->primaryKey;
        $this->where($primaryKey, "=", $id);
        $this->setValues($primaryKey, $id);
        return $this->first();
    }
    /*
    *
    *   METODOS DE INTERACCION CON LA DB (SAVE,UPDATE,DELETE,TRUNCATE)
    *
    */
    public function select(string ...$values)
    {
        $this->setSelect($this->table, $values);
        return $this;
    }

    public function save(array $values, bool $returnID = true)
    {
        $this->setInsert($this->table);
        $this->verifyColumns($values);
        foreach ($values as $column_name => $value) {
            $this->setInsertColumns($column_name);
            $this->setInsertValues($column_name);
            $this->setValues($column_name, $value);
        }
        $result = $this->generateResponseDB();
        $this->resetQuery();
        if ($returnID) return $this->getLastInsertId();
        return $result;
    }

    public function update(array $values)
    {
        $this->setUpdate($this->table);
        $this->verifyColumns($values);
        foreach ($values as $column_name => $value) {
            $this->setUpdateColumns($column_name);
            $this->setValues($column_name, $value);
        }
        $result = $this->generateResponseDB();
        $this->resetQuery();
        return $result;
    }

    public function delete()
    {
        $this->setDelete($this->table);
        $result = $this->generateResponseDB();
        $this->resetQuery();
        return $result;
    }

    public function truncate()
    {
        $queryBuilder = "TRUNCATE TABLE $this->table";
        $result = $this->getResultOfDB($queryBuilder);
        $this->resetQuery();
        return $result;

    }

    public function getLastInsertId()
    {
        return $this->conn->lastInsertId();
    }

    protected function getResultOfDB($query = null)
    {
        $this->setTableSelected($this->table);
        $query = $query ?? $this->build();
        $prepareValues = $this->getValues();
        try {
            $DB = $this->conn;
            $query = $DB->prepare($query);
            $query->execute($prepareValues);
            $this->query = $query;
            return true;
        } catch (Exception $e) {
            throw new Exception("Error Database: " . $e->getMessage());
        }
    }

    private function getColumns()
    {
        if ($this->table == "") {
            throw new Exception("No table selected!");
        }
        $queryBuilder = "SHOW COLUMNS FROM {$this->table}";
        if ($this->getResultOfDB($queryBuilder)) {
            $this->result = $this->query->fetchAll();
        }
        return $this->result;
    }

    private function generateResponseDB()
    {
        $query = $this->build();
        return $this->getResultOfDB($query);
    }

    private function bootConnection()
    {
        $config = config("database");
        $DB = new Database($config['default']);
        $this->conn = $DB->getConnection();
    }

    private function bootColumns()
    {
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            $this->columns[] = $column->field;
        }
    }

    private function verifyColumns(array $values)
    {
        if (!$this->bootColumnStatus) {
            $this->bootColumns();
            $this->bootColumnStatus = true;
        }
        foreach ($values as $column_name => $value) {
            if (!in_array($column_name, $this->columns)) {
                throw new Exception("Column '$column_name' unknown, check the columns of your table", 1);
            }
        }
    }
}
