<?php

use yii\helpers\Html;

$this->title = Yii::t('banner', 'banners');
$this->params['subtitle'] = Yii::t('banner', 'edit');

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->params['subtitle'];

?>


<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-edit text-blue"></i> <?= Yii::t('banner', 'edit') ?></h3>
		<div class="box-tools pull-right">
			<div class="btn-group">
				<?= Html::a('<i class="fa fa-plus text-green"></i> Add', ['create'], ['class' => 'btn btn-default btn-sm', 'title' => 'Add']) ?>
				<?= Html::a('<i class="fa fa-info-circle text-blue"></i> Info', ['view', 'id' => $banner->getId()], ['class' => 'btn btn-default btn-sm', 'title' => 'Информация о баннере']) ?>
				<?= Html::a('<i class="fa fa-trash-o text-red"></i> Delete', ['delete', 'id' => $banner->getId()], [
		            'class' => 'btn btn-default btn-sm',
		            'title' => 'Удалить баннер',
		            'data' => [
		                'confirm' => 'Действительно хотите удалить этот баннер?',
		                'method' => 'post',
		            ],
		        ]) ?>
			</div>
		</div>
    </div>

	<div class="box-body pad">
        <?= $this->render('_form', [
			'form' => $form,
		]) ?>
	</div>

	<div class="box-footer clearfix">
        <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'form' => 'banner-form']) ?>
		<?= Html::a('Назад', ['index'], ['class' => 'btn btn-warning']) ?>
	</div>
</div>
