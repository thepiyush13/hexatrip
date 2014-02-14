<?php

class Register extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_users';
	}
        
        /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(array('id, username, password, email, activkey, createtime, lastvisit, superuser, status','safe',),);
                    
			
	}
        
        public function  create_profile($user_id,$name){       
            
            $sql = "INSERT INTO tbl_profiles VALUES($user_id,'$name','$name',NULL)";
            $output = Yii::app()->db->createCommand($sql)->query();
            return $output;
        }
}
?>
