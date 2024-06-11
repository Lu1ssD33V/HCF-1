<?php

declare(strict_types=1);

namespace hcf\xchillz\datasource\impl;

use hcf\xchillz\datasource\IDataSource;

final class InMemoryDataSource implements IDataSource {

    const PROFILE_TABLE = 0;

    private $data = [];

    public function add($table, $key, $value) {
        $this->data[$table][$key] = $value;
    }

    public function update($table, $id, $key, $value): bool
    {
        if (!isset($this->data[$table][$id])) return false;

        $this->data[$table][$id][$key] = $value;

        return true;
    }

    public function find($table, $key)
    {
        return $this->data[$table][$key] ?? null;
    }

    public function findAll($table)
    {
        return $this->data[$table];
    }

    public function delete($table, $key)
    {
        unset($this->data[$table][$key]);
    }

}