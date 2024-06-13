<?php

declare(strict_types=1);

namespace hcf\xchillz\cache;

use pocketmine\scheduler\Task;
use pocketmine\Server;

final class TemporalCache extends Cache {

    const SECONDS = 20;
    const MINUTES = self::SECONDS * 60;
    const HOURS = self::MINUTES * 60;

    public function __construct(int $timeToExpire, int $timeType)
    {
        Server::getInstance()->getScheduler()->scheduleDelayedRepeatingTask(new class($this) extends Task {

            /** @var TemporalCache */
            private $temporalCache;

            public function __construct(TemporalCache $temporalCache)
            {
                $this->temporalCache = $temporalCache;
            }

            public function onRun($currentTick)
            {
                $this->temporalCache->clear();
            }

        }, $timeToExpire * $timeType, $timeToExpire * $timeType);
    }

}