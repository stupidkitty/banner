<?php

use yii\helpers\Html;

$this->title = 'Баннеры';
$this->params['subtitle'] = 'Создание';

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->params['subtitle'];

?>


<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-plus text-green"></i> Создание нового баннера</h3>
    </div>

	<div class="box-body pad">
		<?= $this->render('_form', [
			'form' => $form,
		]) ?>
	</div>

	<div class="box-footer clearfix">
		<?= Html::submitButton('Создать', ['class' => 'btn btn-success', 'form' => 'banner-form']) ?>
		<?= Html::a('Назад', ['index'], ['class' => 'btn btn-warning']) ?>
	</div>
</div>
