<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\SearchSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-search">
	
	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>
	
	<?=$form->field($model, 'id')?>
	
	<?=$form->field($model, 'setting_name')?>
	
	<?=$form->field($model, 'setting_value')?>
	
	<?=$form->field($model, 'field_type')?>
	
	<?=$form->field($model, 'field_options')?>

	<div class="form-group">
		<?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
		<?=Html::resetButton('Reset', ['class' => 'btn btn-default'])?>
	</div>
	
	<?php ActiveForm::end(); ?>

</div>
