<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title                   = 'Page';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="card">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-7">
			<h1><?=Html::encode($model->title)?></h1>
		</div>
		<div class="col-md-5 text-right">
			<?=Html::a('<i class="fa fa-chevron-left"></i> '.Yii::t('app', 'Back'), Url::toRoute('pages/index'), ['class' => 'btn btn-warning'])?>
			<?=Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-success'])?>
			<?=Html::a('<i class="fa fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method'  => 'post',
                ],
			])?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?=DetailView::widget([
				'model'      => $model,
				'attributes' => [
					'id',
					[
						'attribute' => 'active',
						'format' => 'html',
						'value' => function($data){
							$class = ($data->active) ? 'badge label-success text-dark' : 'badge label-danger text-light';
							$text = ($data->active) ? 'Publish' : 'Draft';
							return sprintf('<span class="%s">%s</span>', $class, $text);
						},
					],
					'title',
					'slug',
					'template',
					[
						'attribute' => 'meta_noindex',
						'format' => 'html',
						'value' => function($data){
							$class = ($data->meta_noindex) ? 'badge label-danger text-light' : 'badge label-success text-dark';
							$text = ($data->meta_noindex) ? 'Yes' : 'No';
							return sprintf('<span class="%s">%s</span>', $class, $text);
						},
					],
					'meta_title',
					'meta_description',
					'content:html',
				],
			]);?>
		</div>
	</div>
</div>
