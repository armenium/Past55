<?php

use common\components\CustomActionColumn;
use common\models\search\SearchCategoryCityContent;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SearchCategoryCityContent */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categoty & City Content';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
	<div class="js_data_loader bg-loader"></div>

	<div class="pull-right" style="margin-bottom: 10px;">
		<?=Html::a('<i class="fa fa-plus"></i> '.Yii::t('app', 'Add New'), ['create'], ['class' => 'btn btn-success'])?>
	</div>

	<?php Pjax::begin(); ?>
	<div class="page-size-box">
		<?=Html::label('Page size:', 'per-page', array('style' => 'margin: 0 10px 0 0;'));?>
		<?=Html::dropDownList('per-page', $pageSize, $pageSize_list, ['id' => 'per-page', 'class' => 'form-control', 'style' => 'display:inline-block; width:auto']);?>
	</div>
	
	<?=GridView::widget([
		'dataProvider'   => $dataProvider,
		'filterModel'    => $searchModel,
		'filterSelector' => 'select[name="per-page"]',
		'columns' => [
			#['class' => 'yii\grid\SerialColumn'],
			'id',
			[
				'attribute' => 'categoryName',
				'filter'=> $categories,
				'value'=>'category.name',
			],
			[
				'attribute' => 'stateName',
				'filter'=> $states,
				'value'=>'state.name',
			],
			[
				'attribute' => 'cityName',
				'filter'=> $cities,
				'value'=>'city.name',
			],
			'title',
			/*[
				'attribute' => 'url_php_code',
				'header' => 'URL php code',
				'format' => 'text',
				'content' => function($data) use ($searchModel){
					$value = htmlspecialchars("<?=Url::toRoute(['page/view', 'slug' => '".strtolower($data->slug)."']);?>");
					return '<input type="text" class="form-control" readonly="readonly" value="'.$value.'" data-trigger="js_action_focus" data-action="select_text">';
				}
			],*/
			
			[
				'class' => CustomActionColumn::className(),
				'header' => 'Actions',
				'filterContent' => Html::a('<i class="fa fa-refresh"></i>&nbsp;Reset', ['index'], ['class' => 'btn btn-info']),
				'contentOptions' => ['class' => 'actions-col col-130 trans_all'],
				'template' => '<div class="btn-group flex">{update}
						<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li>{view}</li>
							<li>{delete}</li>
						</ul>
					</div>',
				'buttons' => [
					'view' => function ($url, $model){
						return Html::a('<span class="fa fa-eye"></span> View', $url, ['title' => 'View', 'aria-label' => 'View', 'data-pjax' => '0']);
					},
					'update' => function ($url, $model){
						return Html::a('<span class="fa fa-pencil"></span> <span class="btn-label">Edit</span>', $url, ['title' => 'Edit', 'aria-label' => 'Edit', 'data-pjax' => '0', 'class' => 'btn btn-danger', 'role' => 'button']);
					},
					'delete' => function ($url, $model){
						return Html::a('<span class="fa fa-trash"></span> Delete', $url, ['title' => 'Delete', 'aria-label' => 'Delete', 'data-pjax' => '0', 'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post']]);
					},
				],
			],
		],
	]);?>
	<?php Pjax::end(); ?>
</div>