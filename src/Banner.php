<?php
namespace SK\Banner;

use Yii;
use SK\Banner\Model\Banner as BannerModel;

class Banner
{
    /**
     * Показ одного или несколько баннеров
     *
     * @param string|array $name Название плейсхолдера баннера.
     * @return string
     */
    public static function show($name)
    {
        $banners = BannerModel::find()
            ->select(['id', 'name', 'code', 'mobile', 'desktop'])
            ->where(['name' => $name, 'enabled' => 1])
            ->all();
        
        if (empty($banners)) {
            return '';
        }

        $deviceDetect = Yii::$container->get('device.detect');
        $isMobile = $deviceDetect->isMobile() || $deviceDetect->isTablet();
        $isDesktop = !$isMobile;

        $code = '';
        foreach ($banners as $banner) {
            $showMobile = ($isMobile && $banner->mobile) ? true : false;
            $showDesktop = ($isDesktop && $banner->desktop) ? true : false;

            if ($showMobile || $showDesktop) {
                $code .= $banner->code;
            }
        }

        return $code;
    }
}
