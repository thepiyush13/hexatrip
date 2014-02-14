<?php

/**
 * This is the model class for table "alert_status".
 *
 * The followings are the available columns in table 'alert_status':
 * @property integer $id
 * @property integer $alert_id
 * @property integer $bus_price_alert
 * @property integer $bus_avail_alert
 * @property integer $bus_dept_alert
 * @property integer $train_price_alert
 * @property integer $train_avail_alert
 * @property integer $train_dept_alert
 * @property integer $flight_price_alert
 * @property integer $flight_avail_alert
 * @property integer $flight_dept_alert
 * @property integer $published
 * @property string $updated
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Alert $alert
 */
class AlertStatus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alert_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alert_id', 'required'),
			array('alert_id, bus_price_alert, bus_avail_alert, bus_dept_alert, train_price_alert, train_avail_alert, train_dept_alert, flight_price_alert, flight_avail_alert, flight_dept_alert, published', 'numerical', 'integerOnly'=>true),
			array('created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, alert_id, bus_price_alert, bus_avail_alert, bus_dept_alert, train_price_alert, train_avail_alert, train_dept_alert, flight_price_alert, flight_avail_alert, flight_dept_alert, published, updated, created', 'safe', 'on'=>'search'),
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
			'alert' => array(self::BELONGS_TO, 'Alert', 'alert_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'alert_id' => 'Alert',
			'bus_price_alert' => 'Bus Price Alert',
			'bus_avail_alert' => 'Bus Avail Alert',
			'bus_dept_alert' => 'Bus Dept Alert',
			'train_price_alert' => 'Train Price Alert',
			'train_avail_alert' => 'Train Avail Alert',
			'train_dept_alert' => 'Train Dept Alert',
			'flight_price_alert' => 'Flight Price Alert',
			'flight_avail_alert' => 'Flight Avail Alert',
			'flight_dept_alert' => 'Flight Dept Alert',
			'published' => 'Published',
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
		$criteria->compare('alert_id',$this->alert_id);
		$criteria->compare('bus_price_alert',$this->bus_price_alert);
		$criteria->compare('bus_avail_alert',$this->bus_avail_alert);
		$criteria->compare('bus_dept_alert',$this->bus_dept_alert);
		$criteria->compare('train_price_alert',$this->train_price_alert);
		$criteria->compare('train_avail_alert',$this->train_avail_alert);
		$criteria->compare('train_dept_alert',$this->train_dept_alert);
		$criteria->compare('flight_price_alert',$this->flight_price_alert);
		$criteria->compare('flight_avail_alert',$this->flight_avail_alert);
		$criteria->compare('flight_dept_alert',$this->flight_dept_alert);
		$criteria->compare('published',$this->published);
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
	 * @return AlertStatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
