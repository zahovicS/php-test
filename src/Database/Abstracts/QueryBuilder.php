<?php
namespace Src\DataBase\Abstracts;

use Exception;

class QueryBuilder {

    private $table_selected = "";
    private $rawQuery = "";
    private $mode = "SELECT";
    private $select = ["*"];
    private $where = [];
    private $limit = "";
    private $groupBy = "";
    private $orderBy = "";
    private $updateValues = [];
    private $insertColumns = [];
    private $insertValues = [];
    private $values = [];
    private $join = [];

    private function buildWhereClause() {
        $whereClause = "";
        if (!empty($this->where)) {
            $whereClause = "WHERE ";
            foreach ($this->where as $index => $condition) {
                $column = $condition['column'];
                $operator = $condition['operator'];
                $value = $condition['value'];
                $concatenator = $condition['concatenator'];
                if ($index > 0) {
                    $whereClause .= " $concatenator ";
                }
                $whereClause .= "$column $operator $value";
            }
        }
        return $whereClause;
    }

    private function buildJoinClause() {
        $join = "";
        foreach ($this->join as $key => $value) {
            $join .= strtoupper($value["type"]) . " JOIN " . $value["table"] . " ON " . $value["column1"] . " " . $value["operator"] . " " . $value["column2"];
            if ($key != count($this->join) - 1) {
                $join .= " ";
            }
        }
        return $join;
    }
    protected function getMode(){
        return $this->mode;
    }
    protected function setSelect($table,$columns) {
        $this->table_selected = $table;
        $this->mode = "SELECT";
        $this->select = $columns;
    }

    protected function setUpdate($table) {
        $this->mode = "UPDATE";
        $this->table_selected = $table;
    }

    protected function setDelete($table) {
        $this->table_selected = $table;
        $this->mode = "DELETE";
    }

    protected function setInsert($table) {
        $this->table_selected = $table;
        $this->mode = "INSERT";
    }
    
    protected function setQuery($table,$query) {
        $this->table_selected = $table;
        $this->rawQuery = $query;
        $this->mode = "QUERY";
    }
    protected function setInsertColumns($columns){
        $this->insertColumns[] = $columns;
    }
    protected function setInsertValues($columns){
        $this->insertValues[] = ":$columns";
    }
    protected function setUpdateColumns($columns){
        $this->updateValues[] = "$columns = :$columns";
    }
    protected function setValues($column,$value){
        $this->values[":$column"] = $value;
    }
    protected function getValues(){
        return $this->values;
    }
    protected function setTableSelected($table){
        $this->table_selected = $table;
    }
    public function where($column, $operator, $value, $concatenator = "AND") {
        $this->where[] = [
            "column" => $column,
            "operator" => $operator,
            "value" => ":$column",
            "concatenator" => $concatenator
        ];
        $this->values[":$column"] = $value;
        return $this;
    }

    public function whereIn($column,array $values){
        $vals = implode(",",$values);
        $this->where[] = [
            "column" => $column,
            "operator" => "IN",
            "value" => "({$vals})",
            "concatenator" => "AND"
        ];
        return $this;
    }

    public function whereNotIn($column,array $values){
        $vals = implode(",",$values);
        $this->where[] = [
            "column" => $column,
            "operator" => "NOT IN",
            "value" => "({$vals})",
            "concatenator" => "AND"
        ];
        return $this;
    }

    public function join($table, $column1, $operator, $column2, $type = "") {
        $this->join[] = [
            "table" => $table,
            "column1" => $column1,
            "operator" => $operator,
            "column2" => $column2,
            "type" => $type
        ];
        return $this;
    }

    public function limit($limit) {
        $this->limit = "LIMIT $limit";
        return $this;
    }

    public function orderBy($orderBy) {
        $this->orderBy = "ORDER BY $orderBy";
        return $this;
    }

    public function groupBy($groupBy) {
        $this->groupBy = "GROUP BY $groupBy";
        return $this;
    }
    
    public function build(): string {
        $queryBuilder = "";
        switch ($this->mode) {
            case "SELECT":
                $select = implode(", ", $this->select);
                $where = $this->buildWhereClause();
                $join = $this->buildJoinClause();
                $queryBuilder = "SELECT $select FROM $this->table_selected $join $where $this->groupBy $this->orderBy $this->limit;";
            break;
            case "UPDATE":
                $update = implode(", ",$this->updateValues);
                $where = $this->buildWhereClause();
                $queryBuilder = "UPDATE $this->table_selected SET $update $where;";
            break;
            case "DELETE":
                $where = $this->buildWhereClause();
                $queryBuilder = "DELETE FROM $this->table_selected $where;";
            break;
            case "INSERT":
                $insert = implode(", ",$this->insertColumns);
                $values = implode(", ",$this->insertValues);
                $queryBuilder = "INSERT INTO $this->table_selected ($insert) VALUES ($values);";
            break;
            case "QUERY":
                $queryBuilder = "{$this->rawQuery};";
            break;
            default:
                throw new Exception("No query!");
            break;
        }
        return $queryBuilder;
    }
    public function dd(){
        $query = $this->build();
        dd($query,$this->getValues());
    }
}