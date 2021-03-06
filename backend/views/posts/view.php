<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title                   = 'Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="card">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-7">
			<h1><?=Html::encode($model->title)?></h1>
		</div>
		<div class="col-md-5 text-right">
			<?=Html::a('<i class="fa fa-chevron-left"></i> '.Yii::t('app', 'Back'), Url::toRoute('posts/index'), ['class' => 'btn btn-warning'])?>
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
					'mainImage:image',
					[
						'attribute'  => 'type',
						'value' => function($data){
							$ret = '';
							switch($data->type){
								case "post":
									$ret = 'Blog post';
									break;
								case "article":
									$ret = 'Category article';
									break;
							}
							return $ret;
						},
					],
					[
						'attribute' => 'user_id',
						'label' => 'Author',
						'value' => is_object($model->users) ? $model->users->name : '',
					],
					'title',
					'slug',
					'ccl_title',
					[
						'attribute' => 'category_id',
						'value' => is_object($model->category) ? $model->category->name : '',
					],
					[
						'attribute' => 'post_category_id',
						'value' => is_object($model->postsCategories) ? $model->postsCategories->title : '',
					],
					'content:html',
					'meta_title',
					'meta_description',
				],
			]);?>
		</div>
	</div>
</div>
