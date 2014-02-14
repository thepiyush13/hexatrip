<?php

/**
 * This is the model class for table "location".
 *
 * The followings are the available columns in table 'location':
 * @property integer $id
 * @property string $name
 * @property integer $lat
 * @property integer $long
 * @property string $desc
 * @property integer $status
 * @property string $updated
 * @property string $created
 */
class Location extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, updated', 'required'),
			array('lat, long, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('desc, created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, lat, long, desc, status, updated, created', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'lat' => 'Lat',
			'long' => 'Long',
			'desc' => 'Desc',
			'status' => 'Status',
			'updated' => 'Updated',
			'created' => 'Created',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('long',$this->long);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Location the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
              /**
* Retrieves a list of status types
* @return array an array of available issue types.
*/
        const TYPE_ACTIVE=1;
const TYPE_INACTIVE=0;

public function getStatusOptions()
{
return array(
self::TYPE_ACTIVE=>'Active',
self::TYPE_INACTIVE=>'Inactive',
);
}
}
