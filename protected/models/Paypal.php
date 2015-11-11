<?php

/**
 * This is the model class for table "paypal".
 *
 * The followings are the available columns in table 'paypal':
 * @property string $id
 * @property string $shard_id
 * @property string $amt
 * @property string $transactionid
 * @property string $ordertime
 *
 * The followings are the available model relations:
 * @property Shard $shard
 */
class Paypal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paypal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shard_id', 'required'),
			array('shard_id, amt', 'length', 'max'=>10),
			array('transactionid, ordertime', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shard_id, amt, transactionid, ordertime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'shard' => array(self::BELONGS_TO, 'Shard', 'shard_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shard_id' => 'Shard',
			'amt' => 'Amt',
			'transactionid' => 'Transactionid',
			'ordertime' => 'Ordertime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('shard_id',$this->shard_id,true);
		$criteria->compare('amt',$this->amt,true);
		$criteria->compare('transactionid',$this->transactionid,true);
		$criteria->compare('ordertime',$this->ordertime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paypal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
