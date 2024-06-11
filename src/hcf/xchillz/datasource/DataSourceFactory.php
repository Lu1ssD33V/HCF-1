<?php

declare(strict_types=1);

namespace hcf\xchillz\datasource;

use hcf\xchillz\common\ConfigData;
use hcf\xchillz\datasource\impl\InMemoryDataSource;
use hcf\xchillz\HCFPlugin;

final class DataSourceFactory {

    const IN_MEMORY_DATASOURCE = 'in-memory';

    public static function create(): IDataSource {
        $default = self::IN_MEMORY_DATASOURCE;

        $dataSourceId = ConfigData::getInstance()->getString('datasource-id', false, $default);

        $dataSource = self::fromId($dataSourceId);

        if ($dataSource === null) {
            HCFPlugin::getInstance()->getLogger()->info($dataSourceId . ' is not a valid id, ' . $default . ' was chosen by default.');
            return self::fromId($default);
        }

        return $dataSource;
    }

    private static function fromId(string $dataSourceId) {
        switch ($dataSourceId) {
            case self::IN_MEMORY_DATASOURCE:
                return new InMemoryDataSource();
            default:
                return null;
        }
    }

}