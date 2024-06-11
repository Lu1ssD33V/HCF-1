<?php

declare(strict_types=1);

namespace hcf\xchillz;

use hcf\xchillz\common\ConfigData;
use hcf\xchillz\common\SingletonTrait;
use hcf\xchillz\datasource\DataSourceFactory;
use hcf\xchillz\datasource\IDataSource;
use pocketmine\plugin\PluginBase;

final class HCFPlugin extends PluginBase {
    use SingletonTrait {
        setInstance as private;
        reset as private;
    }

    /** @var IDataSource */
    private $dataSource;

    public function onLoad() {
        self::setInstance($this);
    }

    public function onEnable() {
        $this->saveDefaultConfig();

        ConfigData::getInstance()->loadFromConfig($this->getConfig());

        $this->dataSource = DataSourceFactory::create();
    }

    public function getDataSource(): IDataSource
    {
        return $this->dataSource;
    }

}