<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin();?>
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'name')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_blur', 'data-action' => 'create_slug_n_meta', 'data-target' => '#category-slug', 'data-target2' => '#category-meta_title']);?>
			<?=$form->field($model, 'template')->dropDownList($templates, ['prompt' => 'None']);?>
			<?=$form->field($model, 'h1_title')->textInput(['maxlength' => true]);?>
			<?=$form->field($model, 'h1_title_for_state')->textInput(['maxlength' => true])->hint('Use keyword %STATE%');?>
			<?=$form->field($model, 'h1_title_for_state_city')->textInput(['maxlength' => true])->hint('Use keywords %STATE% & %CITY%');?>
			<?php #=$form->field($model, 'content_list')->textarea(['rows' => 10])->hint('<small>Example: #link|title</small>');?>
			<?php //=$form->field($model, 'type')->dropDownList([ 'residential' => 'Residential', 'commercial' => 'Commercial', ], ['prompt' => '']);?>
			<?php //=$form->field($model, 'icon')->textInput(['maxlength' => true]);?>
		</div>
		<div class="col-md-6">
			<?=$form->field($model, 'slug')->textInput(['maxlength' => true]);?>
			<?=$form->field($model, 'user_id')->dropDownList($model->UsersList);?>
			<?=$form->field($model, 'meta_title')->textInput(['maxlength' => true]);?>
			<?=$form->field($model, 'meta_title_for_state')->textInput(['maxlength' => true])->hint('Use keyword %STATE%');?>
			<?=$form->field($model, 'meta_title_for_state_city')->textInput(['maxlength' => true])->hint('Use keywords %STATE% & %CITY%');?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6"></div>
		<div class="col-md-6">
			<?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);?>
		</div>
	</div>
<?php ActiveForm::end();?>
