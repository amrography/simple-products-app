<?php

namespace Akhaled\Ecommerce\Core\Database\Concerns;

trait Grammar
{
    public function select(...$args): self
    {
        $this->select = $args;

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function where($start, $op, $end = null): self
    {
        if (is_null($end)) {
            $end = $op;
            $op = "=";
        }

        if (strlen($this->where) > 0) {
            $this->where .= " AND";
        }

        if (strtolower($op) == 'in') {
            $end = "(". implode(", ", $end) .")";
        } else {
            $end = '"'.$end.'"';
        }

        $this->where .= sprintf('`%s`.`%s` %s %s', $this->table, $start, $op, $end);

        return $this;
    }
}
