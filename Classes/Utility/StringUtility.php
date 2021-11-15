<?php

namespace Libeo\LboGlossaire\Utility;

class StringUtility
{
    /**
     * Remove accents, trimmed and lower case a string
     * @param string $string
     * @return string
     */
    public static function normalize(string $string): string
    {
        $normalized = \iconv('utf-8', 'us-ascii//TRANSLIT', $string) ?: $string;
        return strtolower(trim($normalized));
    }
}
