<?php

declare(strict_types=1);

namespace hcf\xchillz\common;

use pocketmine\utils\Config;

final class ConfigData {
    use SingletonTrait {
        setInstance as private;
        reset as private;
    }

    /** @var Config */
    private $config;

    public function loadFromConfig(Config $config) {
        $this->config = $config;
    }

    /**
     * @return string|null
     */
    public function getString(string $key, bool $nested = false, string $default = null) {
        if (!$this->config->exists($key)) return $default;

        if ($nested) {
            return (string) $this->config->getNested($key);
        }

        return (string) $this->config->get($key);
    }

    public function getInteger(string $key, bool $nested = false, int $default = null) {
        if (!$this->config->exists($key)) return $default;

        if ($nested) {
            return (int) $this->config->getNested($key);
        }

        return (int) $this->config->get($key);
    }

    public function getBoolean(string $key, bool $nested = false, bool $default = null) {
        if (!$this->config->exists($key)) return $default;

        if ($nested) {
            return (bool) $this->config->getNested($key);
        }

        return (bool) $this->config->get($key);
    }

}