<?php

/**
 * This is the model class for table "screenshot".
 *
 * The followings are the available columns in table 'screenshot':
 * @property string $id
 * @property string $shard_id
 * @property string $filename
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Shard $shard
 */
class Screenshot extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'screenshot';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('shard_id, filename', 'required'),
            array('active', 'numerical', 'integerOnly' => true),
            array('shard_id', 'length', 'max' => 10),
            array('filename', 'length', 'max' => 64),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, shard_id, filename, active', 'safe', 'on' => 'search'),
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
            'filename' => 'Filename',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('shard_id', $this->shard_id, true);
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('active', $this->active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchFromShard($shard_id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('shard_id', $shard_id);
        $criteria->compare('active', 1);
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Screenshot the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
