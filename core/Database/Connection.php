<?php

namespace Akhaled\Ecommerce\Core\Database;

use Akhaled\Ecommerce\Core\Facade\Config;
use Exception;
use mysqli;
use mysqli_result;

class Connection
{
    private mysqli $conn;

    function __construct()
    {
        $this->activate();
    }

    public function activate(): self
    {
        $this->conn = new mysqli(Config::get('database.host'), Config::get('database.user'), Config::get('database.password'), Config::get('database.name'), Config::get('database.port'));

        return $this;
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }

    public function close(): self
    {
        $this->conn->close();

        return $this;
    }

    public function query(string $sql, array $substitute = [], int $return = 1)
    {
        $q = $this->conn->multi_query(sprintf($sql, ...$substitute));

        if ($this->conn->error) {
            throw new Exception($this->conn->error);
        }

        if ($q instanceof mysqli_result) {
            return $return == 1 ? $q->fetch_row() : $q->fetch_all();
        }

        return $q;
    }
}
