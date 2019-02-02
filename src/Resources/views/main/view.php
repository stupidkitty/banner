<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Баннеры';
$this->params['subtitle'] = 'Информация';

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->params['subtitle'];

?>


<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-info-circle" style="color:#337ab7;"></i> Информация</h3>
		<div class="box-tools pull-right">
			<div class="btn-group">
				<?= Html::a('<i class="fa fa-plus text-green"></i> Add', ['create'], ['class' => 'btn btn-default btn-sm', 'title' => 'Add']) ?>
				<?= Html::a('<i class="fa fa-edit text-blue"></i> Update', ['update', 'id' => $banner->getId()], ['class' => 'btn btn-default btn-sm', 'title' => 'Редактирование']) ?>
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
	    <?= DetailView::widget([
	        'model' => $banner,
	        'attributes' => [
	            'banner_id',
	            'name',
	            'code:ntext',
	            [
                    'attribute' =>'code',
                    'label' => 'Preview',
                    'format' => 'raw',
                ],
	            'comment',
                'start_at:datetime',
	            'end_at:datetime',
	            'desktop',
	            'mobile',
	            'enabled',
	            'updated_at:datetime',
	            'created_at:datetime',
	        ],
	    ]) ?>
	</div>
</div>
