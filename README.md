# Banners
Yii2 banners module

## App configure module
```
'modules' => [
    'banner' => [
        'class' => SK\BannerModule\Module::class,
    ],
],
'container' => [
    'singletons' => [
        'SK\BannerModule\Banner' => [
            'class' => \SK\BannerModule\Banner::class,
            'templatesPath' => '@app/views/banners' // path for ad spots templates
        ]
    ]
]
```

## Migrations
```
config:
'controllerMap' => [
    'migrate' => [
        'class' => yii\console\controllers\MigrateController::class,
        'migrationNamespaces' => [],
        'migrationPath' => [
            '@vendor/stupidkitty/banner/src/Migration',
        ],
    ],
],
```
or composer:
```
"scripts": {
    "post-update-cmd": [
        "yes | php yii migrate --migrationPath=@vendor/stupidkitty/banner/src/Migration"
    ],
    "post-install-cmd": [
        "yes | php yii migrate --migrationPath=@vendor/stupidkitty/banner/src/Migration"
    ]
}
```

## Usage
In template:
```
<?php
use SK\BannerModule\Banner;

//...
// single
<?= Banner::show('banner.name') ?>

// or multiple
<?= Banner::show(['banner.first', 'banner.second']) ?>

// Spot template. Template should exists.
<?= Banner::show(['banner.first', 'banner.second'], ['template' => 'default']) ?>
```
