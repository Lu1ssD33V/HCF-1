<?php

declare(strict_types=1);

namespace hcf\xchillz\object\profile\repository\impl;

use hcf\xchillz\cache\TemporalCache;
use hcf\xchillz\datasource\impl\InMemoryDataSource;
use hcf\xchillz\object\profile\Profile;
use hcf\xchillz\object\profile\repository\ProfileRepository;

final class InMemoryProfileRepository implements ProfileRepository {

    /** @var TemporalCache */
    private $cache;
    /** @var InMemoryDataSource */
    private $dataSource;

    public function __construct(InMemoryDataSource $dataSource) {
        $this->dataSource = $dataSource;
        $this->cache = new TemporalCache(1, TemporalCache::HOURS);
    }

    public function save(Profile $profile) {
        $this->cache->set($this->getCacheId($profile->getId()), $profile);
        $this->dataSource->add(InMemoryDataSource::PROFILE_TABLE, $profile->getId(), []);
    }

    public function update(Profile $profile) {}

    /**
     * @inheritDoc
     */
    public function find(string $id)
    {
        if ($this->cache->exists($this->getCacheId($id))) {
            return $this->cache->get($this->getCacheId($id));
        }

        $data = $this->dataSource->find(InMemoryDataSource::PROFILE_TABLE, $id);

        if ($data === null) return null;

        $profile = new Profile($id);

        $this->cache->set($this->getCacheId($id), $profile);

        return $profile;
    }

    private function getCacheId(string $id): string {
        return InMemoryDataSource::PROFILE_TABLE . $id;
    }

}