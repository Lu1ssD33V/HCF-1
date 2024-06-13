<?php

declare(strict_types=1);

namespace hcf\xchillz\datasource;

interface IDataSource {

    const IN_MEMORY_ID = 'in-memory';

    public function getId(): string;

}