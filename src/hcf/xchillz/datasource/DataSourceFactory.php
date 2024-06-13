<?php

declare(strict_types=1);

namespace hcf\xchillz\datasource;

use hcf\xchillz\common\ConfigData;
use hcf\xchillz\datasource\impl\InMemoryDataSource;
use hcf\xchillz\HCFPlugin;

final class DataSourceFactory {

    const DEFAULT_DATASOURCE = IDataSource::IN_MEMORY_ID;

    public static function create(): IDataSource {
        $default = self::DEFAULT_DATASOURCE;

        $dataSourceId = ConfigData::getInstance()->getString('datasource-id', false, $default);

        $dataSource = self::fromId($dataSourceId);

        if ($dataSource === null) {
            HCFPlugin::getInstance()->getLogger()->info($dataSourceId . ' is not a valid id, ' . $default . ' was chosen by default.');
            return self::fromId($default);
        }

        return $dataSource;
    }

    /**
     * @param string $dataSourceId
     * @return IDataSource|null
     */
    private static function fromId(string $dataSourceId) {
        switch ($dataSourceId) {
            case IDataSource::IN_MEMORY_ID:
                return new InMemoryDataSource();
            default:
                return null;
        }
    }

}