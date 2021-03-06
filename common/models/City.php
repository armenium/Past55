<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use common\models\State;
use yii\helpers\VarDumper;

/**
 * City model
 * @property string $name
 * @property string $state_id
 * @property double $lat
 * @property double $lng
 * @property string $nearby_cities
 */
class City extends ActiveRecord{
	
	public $states = [];
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'cities';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['name', 'state_id'], 'safe'],
			[['lat', 'lng', 'state_id'], 'number'],
			[['nearby_cities'], 'safe'],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'       => Yii::t('app', 'ID'),
			'name'     => Yii::t('app', 'Name'),
			'state_id' => Yii::t('app', 'State'),
			'lat' => Yii::t('app', 'Lat'),
			'lng' => Yii::t('app', 'Lng'),
			'nearby_cities' => Yii::t('app', 'Nearby cities'),
		];
	}
	
	public static function getAllByName($name){
		return self::find()
		              ->where(['name' => $name])
		              ->orWhere(['name' => str_replace('-', ' ', $name)])
		              ->asArray()
		              ->one();
	}
	
	public static function getIDByName($name){
		$id = 0;
		
		$result = self::find()
		              ->select('id')
		              ->where(['name' => $name])
		              ->orWhere(['name' => str_replace('-', ' ', $name)])
		              ->asArray()
		              ->one();

		if(!is_null($result))
			$id = intval($result['id']);
		
		return $id;
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getState(){
		return $this->hasOne(State::className(), ['id' => 'state_id']);
	}
	
	public function getStates(){
		if(empty($this->states)){
			$list = State::find()->orderBy('name ASC')->all();
			
			$this->states = ArrayHelper::map($list, 'id', 'name');
		}
		
		return $this->states;
	}
	
}
