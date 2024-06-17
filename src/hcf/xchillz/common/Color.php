<?php

declare(strict_types=1);

namespace hcf\xchillz\common;

use pocketmine\utils\TextFormat;

final class Color {

    public static function colorize(string $string): string {
        static $colors = [
            '{BLACK}' => TextFormat::BLACK,
            '{DARK_BLUE}' => TextFormat::DARK_BLUE,
            '{DARK_GREEN}' => TextFormat::DARK_GREEN,
            '{DARK_AQUA}' => TextFormat::DARK_AQUA,
            '{DARK_RED}' => TextFormat::DARK_RED,
            '{DARK_PURPLE}' => TextFormat::DARK_PURPLE,
            '{GOLD}' => TextFormat::GOLD,
            '{GRAY}' => TextFormat::GRAY,
            '{DARK_GRAY}' => TextFormat::DARK_GRAY,
            '{BLUE}' => TextFormat::BLUE,
            '{GREEN}' => TextFormat::GREEN,
            '{AQUA}' => TextFormat::AQUA,
            '{RED}' => TextFormat::RED,
            '{LIGHT_PURPLE}' => TextFormat::LIGHT_PURPLE,
            '{YELLOW}' => TextFormat::YELLOW,
            '{WHITE}' => TextFormat::WHITE,
            '{OBSFUCATED}' => TextFormat::OBFUSCATED,
            '{BOLD}' => TextFormat::BOLD,
            '{STRIKETHROUGH}' => TextFormat::STRIKETHROUGH,
            '{UNDERLINE}' => TextFormat::UNDERLINE,
            '{ITALIC}' => TextFormat::ITALIC,
            '{RESET}' => TextFormat::RESET
        ];

        return str_ireplace(array_keys($colors), array_values($colors), $string);
    }

}