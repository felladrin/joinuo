<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $level_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $last_vote
 * @property string $join_date
 * @property integer $banned
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Shard[] $shards
 * @property Level $level
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level_id', 'required'),
			array('username, email', 'unique'),
			array('banned, active', 'numerical', 'integerOnly'=>true),
			array('level_id', 'length', 'max'=>10),
			array('username, email, password', 'length', 'max'=>64),
			array('join_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, level_id, username, email, password, last_vote, join_date, banned, active', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
			'shards' => array(self::HAS_MANY, 'Shard', 'user_id'),
			'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'level_id' => 'Level',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'last_vote' => 'Last Vote',
			'join_date' => 'Join Date',
			'banned' => 'Banned',
			'active' => 'Active',
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
		$criteria->compare('level_id',$this->level_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('last_vote',$this->last_vote,true);
		$criteria->compare('join_date',$this->join_date,true);
		$criteria->compare('banned',$this->banned);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
