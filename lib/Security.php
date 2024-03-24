<?php

class Security {

    private static $seed = 'iAN4l6Nas6ZFXCzZfFf8';

    public static function hacher($texte_en_clair)
    {
        $texte_hache = hash('sha256', self::$seed . $texte_en_clair);
        return $texte_hache;
    }

}