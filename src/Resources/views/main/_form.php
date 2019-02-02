<?php

use yii\widgets\ActiveForm;

?>

<?php $activeForm = ActiveForm::begin([
	'id' => 'banner-form',
]) ?>

	<?= $activeForm->field($form, 'name')->textInput(['maxlength' => true]) ?>

	<?= $activeForm->field($form, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $activeForm->field($form, 'code')->textarea(['rows' => 5, 'maxlength' => true]) ?>

	<?= $activeForm->field($form, 'desktop')->checkbox() ?>

	<?= $activeForm->field($form, 'mobile')->checkbox() ?>

	<?= $activeForm->field($form, 'enabled')->checkbox() ?>

<?php ActiveForm::end() ?>
