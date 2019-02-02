<?php
namespace SK\Banner;

use Yii;
use yii\base\Module as BaseModule;
use yii\i18n\PhpMessageSource;
use yii\console\Application as ConsoleApplication;
use yii\web\Application as WebApplication;

/**
 * This is the main module class of the banner extension.
 */
class Module extends BaseModule
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'SK\Banner\Controller';

    /**
     * @inheritdoc
     */
    public $defaultRoute = 'main/index';

     /**
      * @inheritdoc
      */
     public $layoutPath = '';

     /**
      * @inheritdoc
      */
     public function __construct($id, $parent = null, $config = [])
     {
         $this->setViewPath(__DIR__ . '/Resources/views');

         parent::__construct ($id, $parent, $config);
     }

    public function init()
    {
        parent::init();

        // Контроллеры для консольных команд
        if (Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'SK\Banner\Command';
        }

        // Переводы с языков.
        if (Yii::$app->has('i18n') && empty(Yii::$app->get('i18n')->translations['banner'])) {
            Yii::$app->get('i18n')->translations['banner'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/Resources/i18n',
                'sourceLanguage' => 'en-US',
            ];
        }
    }
}
