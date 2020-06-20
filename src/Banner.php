<?php
namespace SK\BannerModule;

use Yii;
use yii\web\View;
use yii\di\Instance;
use SK\BannerModule\Model\Banner as BannerModel;

class Banner
{
    private $view;
    private $deviceDetect;
    public $templatesPath;

    /**
     * Banner constructor
     *
     * @param View $view
     * @return void
     */
    public function __construct(View $view)
    {
        $this->view = $view;
        $this->deviceDetect = Instance::ensure('device.detect');
    }

    /**
     * Show banners
     *
     * @param string|array $name
     * @param array $options
     * @return void
     */
    protected function show($name = '', array $options = [])
    {
        $banners = BannerModel::find()
            ->select(['banner_id', 'name', 'code', 'mobile', 'desktop'])
            ->where(['name' => $name, 'enabled' => 1])
            ->all();

        if (empty($banners)) {
            return '';
        }

        $isMobile = $this->isMobile();
        $isDesktop = !$isMobile;

        $code = '';
        foreach ($banners as $banner) {
            $showMobile = ($isMobile && $banner->mobile) ? true : false;
            $showDesktop = ($isDesktop && $banner->desktop) ? true : false;

            if ($showMobile || $showDesktop) {
                $code .= $banner->code;
            }
        }

        if (isset($options['template']) &&  $code !== '') {
            if ($this->templatesPath) {
                $template = "{$this->templatesPath}/{$options['template']}";
            } else {
                $template = $options['template'];
            }

            return $this->view->render($template, ['code' => $code]);
        }

        return $code;
    }

    /**
     * Check user device.
     *
     * @return boolean
     */
    private function isMobile(): bool
    {
        return $this->deviceDetect->isMobile() || $this->deviceDetect->isTablet();
    }

    /**
     * Static facade
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = Yii::$container->get(__CLASS__);

        return $instance->$method(...$args);
    }
}
