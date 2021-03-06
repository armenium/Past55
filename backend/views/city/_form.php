<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
	<div class="col-md-4">
		
		<?php $form = ActiveForm::begin();?>
		
		<?=$form->field($model, 'name')->textInput(['maxlength' => true]);?>
		
		<?=$form->field($model, 'state_id')->dropDownList($model->States);?>

		<?=$form->field($model, 'nearby_cities')->dropDownList($nearby_cities_list, ['size' => 5, 'multiple' => 'multiple']);?>
		
		<div class="form-group">
			<?=Html::submitButton('Save', ['class' => 'btn btn-success']);?>
		</div>
		
		<?php ActiveForm::end(); ?>
	</div>
</div>
