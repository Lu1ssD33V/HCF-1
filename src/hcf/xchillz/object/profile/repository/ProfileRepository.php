<?php

declare(strict_types=1);

namespace hcf\xchillz\object\profile\repository;

use hcf\xchillz\object\profile\Profile;

interface ProfileRepository {

    public function save(Profile $profile);

    public function update(Profile $profile);

    /**
     * @return Profile|null
     */
    public function find(string $id);

}