<?php

namespace frontend\widgets;

use common\models\Posts;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;
use common\models\Category;

class CategoryContentList extends Widget{
	
	private $model;
	public $category_id = null;
	public $category_slug = '';
	public $post_type = 'article';
	public $limit = -1;
	public $title = 'Content';
	
	public function init(){
		parent::init();
		
		if(empty($this->category_slug)){
			$queryParams = Yii::$app->request->getQueryParams();
			$this->category_slug = $queryParams['category'];
		}
		if(empty($this->category_slug) || is_null($this->category_slug)){
			$category = Category::find()->select(['slug'])->where(['id' => $this->category_id])->one();
			$this->category_slug = $category->slug;
		}
		if(is_null($this->category_id)){
			$category = Category::find()->select(['id'])->where(['slug' => $this->category_slug])->one();
			$this->category_id = $category->id;
		}
		
		$fields = ['title', 'slug'];
		
		if(!is_null($this->category_id)){
			$this->model = Posts::find()
				->select($fields)
				->where(['category_id' => $this->category_id, 'type' => $this->post_type])
				->orderBy(['created_at' => 'DESC'])
				->limit($this->limit)
				->all();
		}
		
		#VarDumper::dump($this->model, 10, 1);exit;
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/category-content-list', [
			'model' => $this->model,
			'found' => count($this->model),
			'title' => $this->title,
			'category_slug' => $this->category_slug,
		]);
	}
	
}
