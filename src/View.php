<?php

namespace Leedch\View;

use Leedch\Translate\Translate as T;

/**
 * Class for loading views from templates
 *
 * @author leed
 */
class View
{
    protected $translations;

    /**
     * Loads a Template, inserts Attributes in {{$ }}
     * @param string $file
     * @param array $attributes
     * @return string
     */
    public static function loadView(string $file, array $attributes = []): string
    {
        $content = file_get_contents($file);
        $translator = T::getInstance();
        $arrTranslations = $translator->getTranslations();
        foreach ($attributes as $key => $val) {
            $content = str_replace('{{$'.$key.'}}', $val, $content);
        }
        foreach ($arrTranslations as $key => $val) {
            $content = str_replace('{{t:'.$key.'}}', $val, $content);
        }
        return $content;
    }
}
