<?php

declare(strict_types=1);

namespace hcf\xchillz\profile\service;

use hcf\xchillz\common\SingletonTrait;
use hcf\xchillz\profile\Profile;
use hcf\xchillz\profile\repository\ProfileRepository;
use hcf\xchillz\profile\repository\ProfileRepositoryFactory;
use pocketmine\Player;

final class ProfileService {
    use SingletonTrait {
        setInstance as private;
        reset as private;
    }

    /** @var ProfileRepository */
    private $profileRepository;

    public function __construct() {
        $this->profileRepository = ProfileRepositoryFactory::create();
    }

    public function loadProfile(Player $player): Profile {
        $profile = $this->profileRepository->find(strtolower($player->getName()));

        if ($profile === null) return $this->createProfile($player);

        return $profile;
    }

    public function updateProfile(Player $player) {
        $profile = $this->profileRepository->find(strtolower($player->getName()));

        $this->profileRepository->update($profile);
    }

    private function createProfile(Player $player): Profile {
        $profile = new Profile(strtolower($player->getName()));

        $this->profileRepository->save($profile);

        return $profile;
    }

}