<?php

/**
 * Common class.
 * Provided common functions for the application
 */
class Common {

    /**
     * Send email with template.
     */
    public function send_mail($data) {

        $message = new YiiMailMessage;
        $message->view = $data['view_file'];
        $message->subject = $data['subject'];
        // Model is passed to the view
        $message->setBody(array('model' => $data['model']), 'text/html');
        $message->addTo($data['email_to']);
        $message->from = Yii::app()->params['adminEmail'];
        if(!Yii::app()->mail->send($message)){
            Yii::app()->user->setFlash('error', "Could not Send email");
            return FALSE;
        }else{
            Yii::app()->user->setFlash('success', "Success Send emails");
            return TRUE;
        }
        
        
    }
    
    /**
     * Get city names from city ids
     */
    public  static function location_name($id) {
        
        $city = Location::model()->findByPK($id);
        return $city->name;
    }
    
    /**
     * Get city names from city ids
     */
    public  static function alert_user_property($id,$property) {
    
        $alert = Alert::model()->findByPK($id);
        $user_id = $alert->user_id;
        $user = User::model()->findByPK($user_id);
        return $user[$property];
    }
    
    
    /**
     * Get city names from city ids
     */
    public  static function format_date($date,$format) {
        
        return Yii::app()->dateFormatter->format($format, $date);
    }
    
    
     /**
     * @return Tells whether the user is superadmin or not
     */
    public static function is_superadmin($user_id){
        $user = User::model()->findByPk($user_id);
        if($user->superuser==1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    

    

}