<?php

/**
 * This is the model class for table "shard".
 *
 * The followings are the available columns in table 'shard':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $host
 * @property string $port
 * @property string $description
 * @property string $emulator
 * @property string $website
 * @property string $banner_url
 * @property string $feed_url
 * @property string $youtube_url
 * @property string $era
 * @property string $language
 * @property string $join_date
 * @property integer $online
 * @property string $clients_now
 * @property string $clients_peak
 * @property string $online_peak_datetime
 * @property string $last_online
 * @property string $times_polled
 * @property string $times_online
 * @property string $votes
 * @property string $hits
 * @property integer $premium
 * @property string $premium_expiration
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property History[] $histories
 * @property Screenshot[] $screenshots
 * @property User $user
 */
class Shard extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shard';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
                        array('name', 'unique'),
			array('online, premium, active', 'numerical', 'integerOnly'=>true),
			array('user_id, port, clients_now, clients_peak, times_polled, times_online, votes, hits', 'length', 'max'=>10),
			array('name, host, website, era, language', 'length', 'max'=>64),
			array('emulator', 'length', 'max'=>32),
			array('banner_url, feed_url, youtube_url', 'length', 'max'=>128),
			array('description, join_date, online_peak_datetime, last_online, premium_expiration', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, host, port, description, emulator, website, banner_url, feed_url, youtube_url, era, language, join_date, online, clients_now, clients_peak, online_peak_datetime, last_online, times_polled, times_online, votes, hits, premium, premium_expiration, active', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'shard_id'),
			'histories' => array(self::HAS_MANY, 'History', 'shard_id'),
			'screenshots' => array(self::HAS_MANY, 'Screenshot', 'shard_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'name' => 'Name',
			'host' => 'Host',
			'port' => 'Port',
			'description' => 'Description',
			'emulator' => 'Emulator',
			'website' => 'Website',
			'banner_url' => 'Banner URL',
			'feed_url' => 'Feed RSS URL',
			'youtube_url' => 'Youtube URL',
			'era' => 'Era',
			'language' => 'Language',
			'join_date' => 'Join Date',
			'online' => 'Online',
			'clients_now' => 'Clients Now',
			'clients_peak' => 'Clients Peak',
			'online_peak_datetime' => 'Online Peak Datetime',
			'last_online' => 'Last Online',
			'times_polled' => 'Times Polled',
			'times_online' => 'Times Online',
			'votes' => 'Votes',
			'hits' => 'Hits',
			'premium' => 'Premium',
			'premium_expiration' => 'Premium Expiration',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('host',$this->host,true);
		$criteria->compare('port',$this->port,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('emulator',$this->emulator,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('banner_url',$this->banner_url,true);
		$criteria->compare('feed_url',$this->feed_url,true);
		$criteria->compare('youtube_url',$this->youtube_url,true);
		$criteria->compare('era',$this->era,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('join_date',$this->join_date,true);
		$criteria->compare('online',$this->online,true);
		$criteria->compare('clients_now',$this->clients_now,true);
		$criteria->compare('clients_peak',$this->clients_peak,true);
		$criteria->compare('online_peak_datetime',$this->online_peak_datetime,true);
		$criteria->compare('last_online',$this->last_online,true);
		$criteria->compare('times_polled',$this->times_polled,true);
		$criteria->compare('times_online',$this->times_online,true);
		$criteria->compare('votes',$this->votes,true);
		$criteria->compare('hits',$this->hits,true);
		$criteria->compare('premium',$this->premium);
		$criteria->compare('premium_expiration',$this->premium_expiration);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Shard the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
