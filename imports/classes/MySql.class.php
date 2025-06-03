<?php

class MySql extends mysqli {
    public bool $isConnected;

    public function __construct(array $db_params) {

        parent::__construct($db_params['hostname'], $db_params['username'], $db_params['password'], $db_params['database'], $db_params['port']);
        $this->set_charset($db_params['charset']);
        $this->isConnected = $this->connect_error ?? false;
    }

    public function db_query(string $query_code) {

        $query_result = $this->query($query_code);
        
        return is_bool($query_result) ? $query_result : $query_result->fetch_all(MYSQLI_ASSOC);
    }

    public function unique(string $table, string $field, string $value) {

        $query_result = $this->query("SELECT COUNT($field) FROM `$table` WHERE $field = \"$value\"");
        return $query_result->fetch_assoc()["COUNT($field)"];
    }
}
