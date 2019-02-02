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
            ->where(['name' => $name, 'enabled' => 1])
            ->all();

        $deviceDetect = Yii::$container->get('device.detect');
        $isMobile = $deviceDetect->isMobile() || $deviceDetect->isTablet();

        $text = '';
        foreach ($banners as $banner) {
            $showMobile = ($isMobile && $banner->mobile) ? true : false;
            $showDesktop = (!$isMobile && $banner->desktop) ? true : false;

            if ($showMobile || $showDesktop) {
                $text .= $banner->code;
            }
        }

        return $text;
    }
}
