<?php

namespace App\Http\Controllers;

use DeepL\Translator;

class TranslationController extends Controller
{
    protected static $authKey = '5c7fdc2a-9ef6-4b10-9bea-68b4b31a9358:fx';
    protected static $translator;

    public static function init()
    {
        if (self::$translator === null) {
            self::$translator = new Translator(self::$authKey);
        }
    }

    public static function translate($mensaje, $emisor, $receptor)
    {
        self::init();
        $emisor = substr($emisor, 0, 2); // Tomar dos primeras letras para Source Language
        try {
            //dd($mensaje, $emisor, $receptor);
            $result = self::$translator->translateText($mensaje, $emisor, $receptor);
            return $result->text;
        } catch (\Exception $e) {
            return 'Translation failed: ' . $e->getMessage();
        }
    }
}

