<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

$pageTitleSuffix = ($page > 1) ? Yii::t('banner', 'page_suffix', ['page' => $page]) : '';

$this->title = 'Баннеры';
$this->params['subtitle'] = 'Обзор';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Обзор</h3>
		<div class="box-tools pull-right">
			<div class="btn-group">
				<?= Html::a('<i class="fa fa-plus text-green"></i> Add', ['create'], ['class' => 'btn btn-default btn-sm', 'title' => 'Add']) ?>
			</div>
		</div>
    </div>

    <div class="box-body pad" id="banner-table">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'banner_id',
                    'options' => [
                        'width' => '60px',
                    ],
                ],
                [
                    'attribute' => 'name',
                    'value' => function ($banner) {
                        return Html::a($banner->name, ['update', 'id' => $banner->getId()]);
                    },
                    'format' => 'html',
                ],
                'comment:ntext',
                [
                    'attribute' => 'desktop',
                    'value' => function ($banner) {
                        if ($banner->desktop) {
                            return Html::tag('span', 'Да', ['class' => 'label label-success']);
                        } else {
                            return Html::tag('span', 'Нет', ['class' => 'label label-danger']);
                        }
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'mobile',
                    'value' => function ($banner) {
                        if ($banner->mobile) {
                            return Html::tag('span', 'Да', ['class' => 'label label-success']);
                        } else {
                            return Html::tag('span', 'Нет', ['class' => 'label label-danger']);
                        }
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'enabled',
                    'value' => function ($banner) {
                        if ($banner->enabled) {
                            return Html::tag('span', 'Да', ['class' => 'label label-success']);
                        } else {
                            return Html::tag('span', 'Нет', ['class' => 'label label-danger']);
                        }
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'updated_at',
                    'options' => [
                        'width' => '180px',
                    ],
                    'format' => 'datetime',
                ],
                [
                    'class' => ActionColumn::class,
                    'options' => [
                        'width' => '75px',
                    ],
                ],
            ],
        ]) ?>

	</div>

</div>

<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Справка</h3>
    </div>

    <div class="box-body pad" id="banner-table">

        <h3>Вставка в шаблон</h3>

        <p>
            При вставке в шаблоне указать сверху страницы:
            <code>use SK\Banner\Banner;</code>
        </p>

        <p>
            Затем, в любом месте страницы добавить:
            <code><?= Html::encode('<?= Banner::show(\'banner.name\') ?>') ?></code>
            <br>
            Где <code>banner.name</code> - название баннера.
            <br><br>
            Для вывода нескольких баннеров сразу:
            <code><?= Html::encode('<?= Banner::show([\'banner.name1\', \'banner.name2\']) ?>') ?></code>
        </p>

	</div>

</div>
