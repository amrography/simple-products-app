<?php

namespace Akhaled\Ecommerce\Core\Database;

use Akhaled\Ecommerce\Core\Database\Concerns\Grammar;
use Akhaled\Ecommerce\Core\Database\Concerns\Queries;
use Akhaled\Ecommerce\Core\Facade\DatabaseConnection;
use mysqli;
use mysqli_result;

abstract class Model
{
    use Grammar, Queries;

    protected string $table;

    private mysqli $conn;
    private mysqli_result|bool $query;
    private $select = [];
    private $where = "";
    private $limit = 0;

    final public function __construct ()
    {
        $this->initialize();
        $this->select("{$this->table}.*");
    }

    private function initialize(): void
    {
        $this->conn = DatabaseConnection::getConnection();
    }

    /**
     * Get tables list of database
     *
     * @return array
     */
    public function tables (): array
    {
        return $this->conn->query("SHOW TABLES")
            ->fetch_all();
    }
}
