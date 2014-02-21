<?php

/**
 * This is the model class for table "alert".
 *
 * The followings are the available columns in table 'alert':
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $location_from
 * @property integer $location_to
 * @property string $date_from
 * @property string $date_to
 * @property integer $user_id
 * @property integer $status
 * @property integer $bus
 * @property integer $bus_price_min
 * @property integer $bus_price_max
 * @property integer $bus_avail_min
 * @property integer $bus_avail_max
 * @property integer $bus_dept_min
 * @property integer $bus_dept_max
 * @property integer $bus_arrive_min
 * @property integer $bus_arrive_max
 * @property integer $train
 * @property integer $train_price_min
 * @property integer $train_price_max
 * @property integer $train_avail_min
 * @property integer $train_avail_max
 * @property integer $train_dept_min
 * @property integer $train_dept_max
 * @property integer $train_arrive_min
 * @property integer $train_arrive_max
 * @property integer $flight
 * @property integer $flight_price_min
 * @property integer $flight_price_max
 * @property integer $flight_avail_min
 * @property integer $flight_avail_max
 * @property integer $flight_dept_min
 * @property integer $flight_dept_max
 * @property integer $flight_arrive_min
 * @property integer $flight_arrive_max
 * @property string $updated
 * @property string $created
 */
class Alert extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alert';
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
			array('location_from, location_to, status, bus, bus_price_min, bus_price_max, bus_avail_min, bus_avail_max, bus_dept_min, bus_dept_max, bus_arrive_min, bus_arrive_max, train, train_price_min, train_price_max, train_avail_min, train_avail_max, train_dept_min, train_dept_max, train_arrive_min, train_arrive_max, flight, flight_price_min, flight_price_max, flight_avail_min, flight_avail_max, flight_dept_min, flight_dept_max, flight_arrive_min, flight_arrive_max', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('desc,  created,updated', 'safe'),
                                            array(' date_from, date_to', 'required'),
                    array('date_from', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'dd-MM-yyyy'),
                     array('date_to', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'dd-MM-yyyy'),
                     array('updated','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'update'),
        array('created,updated','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert'),

                    
                    
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, desc, location_from, location_to, date_from, date_to, user_id, status, bus, bus_price_min, bus_price_max, bus_avail_min, bus_avail_max, bus_dept_min, bus_dept_max, bus_arrive_min, bus_arrive_max, train, train_price_min, train_price_max, train_avail_min, train_avail_max, train_dept_min, train_dept_max, train_arrive_min, train_arrive_max, flight, flight_price_min, flight_price_max, flight_avail_min, flight_avail_max, flight_dept_min, flight_dept_max, flight_arrive_min, flight_arrive_max, updated, created', 'safe', 'on'=>'search'),
                    
                     array('location_from', 'in', 'range' => self::getAllowedLocationRange()),
            array('location_to', 'in', 'range' => self::getAllowedLocationRange()),
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
                    'locationFrom' => array(self::BELONGS_TO, 'Location', 'location_from'),
                    'locationTo' => array(self::BELONGS_TO, 'Location', 'location_to'),

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
			'desc' => 'Desc',
			'location_from' => 'Location From',
			'location_to' => 'Location To',
			'date_from' => 'Date From',
			'date_to' => 'Date To',
			'user_id' => 'User',
			'status' => 'Status',
			'bus' => 'Bus',
			'bus_price_min' => 'Bus Price Min',
			'bus_price_max' => 'Bus Price Max',
			'bus_avail_min' => 'Bus Avail Min',
			'bus_avail_max' => 'Bus Avail Max',
			'bus_dept_min' => 'Bus Dept Min',
			'bus_dept_max' => 'Bus Dept Max',
			'bus_arrive_min' => 'Bus Arrive Min',
			'bus_arrive_max' => 'Bus Arrive Max',
			'train' => 'Train',
			'train_price_min' => 'Train Price Min',
			'train_price_max' => 'Train Price Max',
			'train_avail_min' => 'Train Avail Min',
			'train_avail_max' => 'Train Avail Max',
			'train_dept_min' => 'Train Dept Min',
			'train_dept_max' => 'Train Dept Max',
			'train_arrive_min' => 'Train Arrive Min',
			'train_arrive_max' => 'Train Arrive Max',
			'flight' => 'Flight',
			'flight_price_min' => 'Flight Price Min',
			'flight_price_max' => 'Flight Price Max',
			'flight_avail_min' => 'Flight Avail Min',
			'flight_avail_max' => 'Flight Avail Max',
			'flight_dept_min' => 'Flight Dept Min',
			'flight_dept_max' => 'Flight Dept Max',
			'flight_arrive_min' => 'Flight Arrive Min',
			'flight_arrive_max' => 'Flight Arrive Max',
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
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('location_from',$this->location_from);
		$criteria->compare('location_to',$this->location_to);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('date_to',$this->date_to,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('bus',$this->bus);
		$criteria->compare('bus_price_min',$this->bus_price_min);
		$criteria->compare('bus_price_max',$this->bus_price_max);
		$criteria->compare('bus_avail_min',$this->bus_avail_min);
		$criteria->compare('bus_avail_max',$this->bus_avail_max);
		$criteria->compare('bus_dept_min',$this->bus_dept_min);
		$criteria->compare('bus_dept_max',$this->bus_dept_max);
		$criteria->compare('bus_arrive_min',$this->bus_arrive_min);
		$criteria->compare('bus_arrive_max',$this->bus_arrive_max);
		$criteria->compare('train',$this->train);
		$criteria->compare('train_price_min',$this->train_price_min);
		$criteria->compare('train_price_max',$this->train_price_max);
		$criteria->compare('train_avail_min',$this->train_avail_min);
		$criteria->compare('train_avail_max',$this->train_avail_max);
		$criteria->compare('train_dept_min',$this->train_dept_min);
		$criteria->compare('train_dept_max',$this->train_dept_max);
		$criteria->compare('train_arrive_min',$this->train_arrive_min);
		$criteria->compare('train_arrive_max',$this->train_arrive_max);
		$criteria->compare('flight',$this->flight);
		$criteria->compare('flight_price_min',$this->flight_price_min);
		$criteria->compare('flight_price_max',$this->flight_price_max);
		$criteria->compare('flight_avail_min',$this->flight_avail_min);
		$criteria->compare('flight_avail_max',$this->flight_avail_max);
		$criteria->compare('flight_dept_min',$this->flight_dept_min);
		$criteria->compare('flight_dept_max',$this->flight_dept_max);
		$criteria->compare('flight_arrive_min',$this->flight_arrive_min);
		$criteria->compare('flight_arrive_max',$this->flight_arrive_max);
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
	 * @return Alert the static model class
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
     * Retrieves a list of sub alert allowed types
     * @return array an array of available sub alert allowed types.
     */
    public static function getAllowedLocationRange() {
        $location_data = Location::model()->findAll(array("condition"=>"status = 1"));
$locations = CHtml::listData($location_data, 'id', 'name');
return array_keys($locations);
    }
    
    /**
     * 
     * Funtion to handle different date format in mysql and front end datepicker 
     */
    protected function afterFind()
    {
        // convert to display format
        $this->date_from = DateTime::createFromFormat('Y-m-d', $this->date_from)->format('d-m-Y');
        $this->date_to = DateTime::createFromFormat('Y-m-d', $this->date_to)->format('d-m-Y');

        parent::afterFind();
    }

    protected function beforeSave()
    {
        // convert to storage format
          
         $this->date_from = DateTime::createFromFormat('d-m-Y', $this->date_from)->format('Y-m-d');
        $this->date_to = DateTime::createFromFormat('d-m-Y', $this->date_to)->format('Y-m-d');

        //setting up default values for any new alert         
        //if any value is set by user - respect that         
        //if no value is set - set default values
        if(!($this->train_avail_min)){
            $this->train_avail_min = 1;
        }
        if(!($this->train_avail_max)){
            $this->train_avail_max = 1000;
        }
        

        return parent::beforeSave();
    }


}
