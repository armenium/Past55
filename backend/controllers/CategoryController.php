<?php

namespace backend\controllers;

use common\models\search\SearchProperty;
use Yii;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use common\models\Property;
use common\models\CategoryLink;
use common\models\search\SearchCategory;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {
	
	private $user_id = 0;
	public $default_pageSize = 10;
	public $pageSize_list = [7 => 7, 10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100];
	
	/**
	 * @inheritdoc
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => ['delete', 'edit', 'update'],
				'rules' => [
					[
						'actions' => ['delete', 'edit', 'update'],
						'allow'   => true,
						'roles'   => ['@'],
					],
				
				
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function actions(){
		$this->user_id = Yii::$app->user->identity->getId();
		
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
	
	/**
	 * Lists all Category models.
	 * @return mixed
	 */
	public function actionIndex(){
		
		$pageSize = Yii::$app->request->get('per-page') ? intval(Yii::$app->request->get('per-page')) : $this->default_pageSize;
		
		$searchModel = new SearchCategory();
		
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
		$dataProvider->pagination->pageSize = $pageSize ? $pageSize : $this->default_pageSize;

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'pageSize' => $pageSize,
			'pageSize_list' => $this->pageSize_list,
		]);
	}
	
	/**
	 * Displays a single Category model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id){
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}
	
	/**
	 * Creates a new Category model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$request = Yii::$app->request->post();

		$model = new Category();

		if(!empty($request)){
			#$request['Category']['user_id'] = $this->user_id;
			#$request['Category']['created_at'] = time();
			
			if($model->load($request) && $model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}
		
		return $this->render('create', [
			'model' => $model,
			'templates' => $this->getTemplatesTree(),
		]);
	}
	
	/**
	 * Updates an existing Category model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException
	 */
	public function actionUpdate($id){
		$request = Yii::$app->request->post();
		$model = $this->findModel($id);
		
		if(!empty($request)){
			#$request['Category']['created_at'] = date('Y-m-d H:i:s');

			if($model->load($request) && $model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}
		
		return $this->render('update', [
			'model' => $model,
			'templates' => $this->getTemplatesTree(),
		]);
	}
	
	/**
	 * Deletes an existing Category model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionDelete($id){
		$cats_links = CategoryLink::findAll(['category_id' => $id]);
		$properties = Property::findAll(['category_id' => $id]);
		#VarDumper::dump($properties, 10, 1); exit;
		
		if(count($properties) || count($cats_links)){
			$ids = [];
			if(count($properties)){
				foreach($properties as $property){
					$ids[] = $property->id;
				}
			}
			if(count($cats_links)){
				foreach($cats_links as $link){
					$ids[] = $link->property_id;
				}
			}
			if(!empty($ids)){
				$ids = array_unique($ids);
			}
			Yii::$app->getSession()->setFlash('error', 'This category cannot be deleted, since it is used in the following Properties under ID: '.implode(', ', $ids));
		}else{
			$this->findModel($id)->delete();
		}
		
		return $this->redirect(['index']);
	}
	
	/**
	 * Finds the Category model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Category the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if(($model = Category::findOne($id)) !== null){
			return $model;
		}else{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	public function getTemplatesTree($dir = ''){
		$result = [];
		
		$root = Yii::getAlias('@frontend');
		
		if(empty($dir)){
			#$dir = $root.'/views/main/resources';
			$dir = $root.'/views/category';
		}
		
		$cdir = array_diff(scandir($dir), ['..', '.']);
		//VarDumper::dump($cdir, 10, 1);
		
		foreach($cdir as $key => $value){
			if(is_dir($dir.DIRECTORY_SEPARATOR.$value)){
				if(substr($value, 0, 1) != '_'){
					$result[$value] = $this->getTemplatesTree($dir.DIRECTORY_SEPARATOR.$value);
				}
			}else{
				$path = str_replace($root, '', $dir.DIRECTORY_SEPARATOR.$value);
				$result[$path] = $value;
			}
		}
		
		ksort($result);
		reset($result);
		
		#VarDumper::dump($result, 10, 1);
		
		return $result;
	}
	
}
