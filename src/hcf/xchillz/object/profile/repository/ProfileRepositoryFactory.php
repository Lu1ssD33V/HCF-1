<?php

declare(strict_types=1);

namespace hcf\xchillz\object\profile\repository;

use hcf\xchillz\datasource\IDataSource;
use hcf\xchillz\HCFPlugin;
use hcf\xchillz\object\profile\repository\impl\InMemoryProfileRepository;

final class ProfileRepositoryFactory {

    public static function create(): ProfileRepository
    {
        return self::fromId(HCFPlugin::getInstance()->getDataSource());
    }

    /**
     * @param IDataSource $dataSource
     * @return ProfileRepository|null
     */
    private static function fromId(IDataSource $dataSource) {
        switch ($dataSource->getId()) {
            case IDataSource::IN_MEMORY_ID:
                return new InMemoryProfileRepository($dataSource);
            default:
                return null;
        }
    }

}