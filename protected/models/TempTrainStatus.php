<?php

/**
 * This is the model class for table "temp_train_status".
 *
 * The followings are the available columns in table 'temp_train_status':
 * @property integer $id
 * @property integer $location_from
 * @property string $location_from_name
 * @property integer $location_to
 * @property string $location_to_name
 * @property string $date
 * @property string $type
 * @property integer $train_id
 * @property string $train_name
 * @property integer $available
 * @property string $desc
 * @property string $updated
 * @property string $created
 */
class TempTrainStatus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'temp_train_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('location_from, location_to', 'required'),
			array('location_from, location_to, train_id, available', 'numerical', 'integerOnly'=>true),
			array('location_from_name, location_to_name, type, train_name', 'length', 'max'=>255),
			array('date, desc, created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, location_from, location_from_name, location_to, location_to_name, date, type, train_id, train_name, available, desc, updated, created', 'safe', 'on'=>'search'),
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
			'location_from' => 'Location From',
			'location_from_name' => 'Location From Name',
			'location_to' => 'Location To',
			'location_to_name' => 'Location To Name',
			'date' => 'Date',
			'type' => 'Type',
			'train_id' => 'Train',
			'train_name' => 'Train Name',
			'available' => 'Available',
			'desc' => 'Desc',
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
		$criteria->compare('location_from',$this->location_from);
		$criteria->compare('location_from_name',$this->location_from_name,true);
		$criteria->compare('location_to',$this->location_to);
		$criteria->compare('location_to_name',$this->location_to_name,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('train_id',$this->train_id);
		$criteria->compare('train_name',$this->train_name,true);
		$criteria->compare('available',$this->available);
		$criteria->compare('desc',$this->desc,true);
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
	 * @return TempTrainStatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        /**
* @return array of valid locations for this alert, from location table
*/
public function getLocationOptions()
{
$location_data = Location::model()->findAll(array("condition"=>"status = 1"));
$locations = CHtml::listData($location_data, 'id', 'name');
return $locations;

}
     /**
* @return array of valid locations for this alert, from location table
*/
public function getTypeOptions()
{
$type = array(
    'SL'=>'SLEEPER',
    '3A'=>'3AC',
    '1A'=>'1AC',
    '2A'=>'2AC',
);
return $type;

}


function behaviors()
{
    return array(
        'CTimestampBehavior' => array(
            'class' => 'zii.behaviors.CTimestampBehavior',
            'createAttribute' => 'created',
            'updateAttribute' => 'updated',
            'setUpdateOnCreate' => true,
        )
        );
}
}
