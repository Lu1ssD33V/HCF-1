<?php

declare(strict_types=1);

namespace hcf\xchillz\common;

final class File {

    const YAML_TYPE = 0;
    const JSON_TYPE = 1;

    public static function read(string $path, int $type): array {
        switch ($type) {
            case self::YAML_TYPE:
                return yaml_parse_file($path);
            case self::JSON_TYPE:
                return json_decode(file_get_contents($path), true);
            default:
                return [file_get_contents($path)];
        }
    }

    public static function readMany(string $globPath, int $type): array {
        $filesContent = [];

        foreach (glob($globPath) as $path) {
            $filesContent[$path] = self::read($path, $type);
        }

        return $filesContent;
    }

}