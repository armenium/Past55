<?php

namespace common\models\search;

use common\models\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Posts;
use common\models\Users;
use yii\helpers\VarDumper;

/**
 * SearchPosts represents the model behind the search form of `common\models\Posts`.
 */
class SearchPosts extends Posts {
	
	public $categoryName;
	public $userName;
	
	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['id', 'user_id', 'category_id', 'post_category_id'], 'integer'],
			[['title', 'slug', 'categoryName', 'userName', 'content', 'type'], 'safe'],
		];
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function scenarios(){
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}
	
	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params){
		$query = Posts::find();
		$query->joinWith(['postsCategories']);
		$query->joinWith(['category']);
		$query->joinWith(['users']);
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		
		$dataProvider->setSort([
			'attributes' => [
				'id',
				'category_id',
				'post_category_id',
				'user_id',
				'title',
				'slug',
				'type',
				'created_at',
			]
		]);
		
		$this->load($params);
		
		if(!$this->validate()){
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		
		// grid filtering conditions
		$query->andFilterWhere([
			'posts.id' => $this->id,
			'posts.post_category_id' => $this->post_category_id,
			'posts.category_id' => $this->category_id,
			'posts.user_id' => $this->user_id,
		]);
		
		$query
			->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'slug', $this->slug])
			->andFilterWhere(['=', Posts::tableName().'.type', $this->type]);
			#->andFilterWhere(['=', Users::tableName().'.id', $this->user_id])
			#->andFilterWhere(['=', Category::tableName().'.id', $this->category_id]);
		
		#VarDumper::dump($query->createCommand()->sql, 10, 1);
		
		return $dataProvider;
	}
}
