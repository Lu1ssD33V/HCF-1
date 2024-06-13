<?php

declare(strict_types=1);

namespace hcf\xchillz\cache;

class Cache {

    /** @var array<int|string, mixed> */
    private $data = [];

    public function clear() {
        $this->data = [];
    }

    /**
     * @param int|string $key
     * @param mixed $value
     */
    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function unset($key) {
        if (!isset($this->data[$key])) return;

        unset($this->data[$key]);
    }

    public function get($key) {
        return $this->data[$key] ?? null;
    }

    public function exists($key): bool {
        return isset($this->data[$key]);
    }

}