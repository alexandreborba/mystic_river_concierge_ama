<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../src/Parameters.php";
require_once __DIR__ . "/../../src/Functions.php";
//namespace Src\Tools;

use Src\Models\SysDictionaries;

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
# error_reporting(E_ALL);

class Translator
{
    public static function translate($content, $language = 'en')
    {
        // Normaliza entrada
        $language = strtolower(trim($language));
        $content  = trim($content);

        // 1) Log básico de início
        error_log("[Translator] Translating “{$content}” into “{$language}”");

        try {
            
            $dictionary = (new SysDictionaries())
                ->find(
                    "dictContentEN = :content AND langCode = :lang AND deleted_at IS NULL",
                    "content={$content}&lang={$language}"
                )
                ->fetch();
                if (!$dictionary) {
                    error_log("[Translator] Nenhuma tradução encontrada");
                    return $content;
                }
                
                // 4) Achou tradução
                $translated = $dictionary->dictContentTranslated;
                error_log("[Translator] Tradução obtida: “{$translated}”");

            return $translated;

        } catch (\Throwable $e) {
            // 5) Captura qualquer erro e devolve original
            error_log("[Translator][ERROR] " . $e->getMessage());
            return $content;
        }
    }
}