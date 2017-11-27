<?php

namespace luya\bootstrap3;

use Yii;

/**
 * Bootstrap4 Module
 *
 * When adding this module to your configuration the bootstrap4 block will be added to your
 * cmsadministration by running the `import` command.
 *
 * @author Basil Suter <basil@nadar.io>
 */
class Module extends \luya\base\Module
{
    /**
     * @inheritdoc
     */
    public static function onLoad()
    {
        self::registerTranslation('bootstrap3*', static::staticBasePath() . '/messages', [
            'fileMap' => [
                'bootstrap3' => 'bootstrap3.php',
            ],
        ]);
    }
    
    /**
     * Translations
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('bootstrap3', $message, $params);
    }
}
