<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
	<div class="col-md-4">
		<?php $form = ActiveForm::begin(); ?>
		<?=$form->field($model, 'name')->textInput(['maxlength' => true]);?>
		<?=$form->field($model, 'iso_code')->textInput(['maxlength' => true]);?>
		<?=$form->field($model, 'phonecode')->textInput();?>
	
		<div class="form-group">
			<?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
		</div>
		
		<?php ActiveForm::end(); ?>
	</div>
</div>
