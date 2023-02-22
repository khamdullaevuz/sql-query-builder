<?php

class Query
{
    private $query;
    private $table;

    const EQUAL = '=';
    public static function table($table)
    {
        $instance = new static;
        $instance->table = $table;
        return $instance;
    }

    public function select(...$columns)
    {
        $this->query = "SELECT " . implode(', ', $columns) . " FROM {$this->table}";
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->query .= " WHERE {$column} {$operator} {$value}";
        return $this;
    }

    public function andWhere($column, $operator, $value)
    {
        $this->query .= " AND {$column} {$operator} {$value}";
        return $this;
    }

    public function orWhere($column, $operator, $value)
    {
        $this->query .= " OR {$column} {$operator} {$value}";
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->query .= " ORDER BY {$column} {$direction}";
        return $this;
    }

    public function limit($limit)
    {
        $this->query .= " LIMIT {$limit}";
        return $this;
    }

    public function offset($offset)
    {
        $this->query .= " OFFSET {$offset}";
        return $this;
    }

    public function get()
    {
        return $this->query;
    }
}

$query = Query::table('users')
    ->select('id', 'name')
    ->where('id', Query::EQUAL, 1)
    ->andWhere('name', 'LIKE', '%Elbek%')
    ->orWhere('surname', Query::EQUAL, 'Khamdullaev')
    ->orderBy('id', 'DESC')
    ->limit(10)
    ->offset(5)
    ->get();

echo $query;

