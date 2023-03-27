<?php

namespace Akhaled\Ecommerce\Core\Database\Concerns;

use mysqli_result;

trait Queries
{
    public function get()
    {
        $result = $this->execute(sprintf(
            "SELECT %s FROM `%s`%s%s",
            implode(",", $this->select),
            $this->table,
            (strlen($this->where) > 0 ? " WHERE {$this->where}": ""),
            ($this->limit > 0 ) ? " LIMIT {$this->limit}" : "",
        ));

        $this->where = "";
        $this->limit = 0;
        $this->select = "{$this->table}.*";

        return $result;
    }

    public function create(array $data)
    {
        $this->execute(sprintf(
            "INSERT INTO `%s` (%s) VALUES ('%s')",
            $this->table,
            implode(', ', array_keys($data)),
            implode("', '", array_values($data))
        ));

        return $this->where("id", $this->conn->insert_id)
            ->limit(1)
            ->get();
    }

    public function update(array $data)
    {
        $data = array_reduce(array_keys($data), function($carry, $col) use ($data) {
            return $carry .= "`{$this->table}`.`{$col}` = \"{$data[$col]}\",";
        }, "");

        $this->execute(sprintf(
            "UPDATE `%s` SET %s%s",
            $this->table,
            rtrim($data, ","),
            strlen($this->where) > 0 ? " WHERE {$this->where}" : ""
        ));

        return $this->limit($this->conn->affected_rows)
            ->get();
    }

    public function delete(): bool
    {
        $result = $this->execute(sprintf(
            "DELETE FROM `%s`",
            $this->table,
            strlen($this->where) > 0 ? " WHERE {$this->where}" : ""
        ));

        $this->where = "";

        return $result;
    }

    public function execute(string $sql): array| bool
    {
        $this->query = $this->conn->query($sql);

        if ($this->query instanceof mysqli_result) {
            return $this->limit == 1 ? $this->query->fetch_row() : $this->query->fetch_all();
        }

        return $this->query;
    }
}
