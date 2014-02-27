<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    private $error = false;

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
 

//no posted data ? show home page 
         $model = new Alert;
         
        if (!isset($_POST['Alert'])) {                       
           $this->render('index',array(
			'model'=>$model,
		));
            return true;
        }
      
         //check email validity 
         if (!$_POST['email'] || $this->valid_email($_POST['email'])!=1) {          
           Yii::app()->user->setFlash('error', "Enter your valid email id!");   
            
           $this->render('index',array(
			'model'=>$model,
		));
            return true;
        }
        //check trip date to  validity 
          if (!isset($_POST['Alert']['date_to']) || !$_POST['Alert']['date_to'] ||  ($_POST['Alert']['date_to']=='00-00-0000') 
                  || !isset($_POST['Alert']['date_from']) || !$_POST['Alert']['date_from'] ||  ($_POST['Alert']['date_from']=='00-00-0000') 
                  ) {          
           Yii::app()->user->setFlash('error', "Enter valid date for the trip!");   
            
           $this->render('index',array(
			'model'=>$model,
		));
            return true;
        }
        
         //check If date to is less then date from 
          if ($_POST['Alert']['date_from'] > $_POST['Alert']['date_to']) {          
           Yii::app()->user->setFlash('error', "Starting date can not be greater than Ending date!");   
            
           $this->render('index',array(
			'model'=>$model,
		));
            return true;
        }
        
        
 
        
        
        //check if user exists in the system 
        $user = User::model()->exists('email = :email', array(":email"=>$_POST['email']));
        if($user){
            Yii::app()->user->setFlash('error', "You  already have an account, Please login here to create alert"); 
                    $this->redirect(array('/alert/create'));
            return true;
        }
        
       
        //get all the posted details 
        $data = $_POST['Alert'];


        //if email is correct - register the user 
        //substr($_POST['email'], strpos($_POST['email'],"<")+1, strrpos($_POST['email'], "@")-strpos($_POST['email'],"<")-1);  //name@example.com to name
        $password = $this->random_password();
        $password_repeat = $password;
        $email = trim($_POST['email']);
        $username = preg_replace('/([^@]*).*/', '$1', $email);
        
        //register the user 
        $this->register_new_user($username, $password, $email,$data);
        

        //if user is logged in - create an alert with this user`s user id and using supplied values 
        $alert = $this->create_partial_alert($data);
        
        //if alert is created - show alert update page for further changes 
        if($alert){
             Yii::app()->user->setFlash('success', "Congrats ! Your alerts has been successfully created, You can add extra details to your alert on this page");  
            $this->redirect(array('alert/update','id'=>$alert));
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        //redirect to user login at all times 
         $this->redirect(array('user/login'));
        
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Generates random password for first time registration.register_new_user($username,$password,$email)
     */
    protected function random_password() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
     /**
     * Checked for valid email format 
     */
    protected function valid_email($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
} else {
    return true;
}   
                        
    }

    /**
     * Registers user  for first time registration.
     */
    protected function register_new_user($username, $password, $email,$data) {
        $model = new Register;
        $profile = new Profile;
        $common = new Common;
        $profile->regMode = true;
        $contact_url =  Yii::app()->createAbsoluteUrl('site/contact');
        $alert_url =  Yii::app()->createAbsoluteUrl('alert/index');
        if (Yii::app()->user->id) {
            return TRUE;
        }
        //user not logged in - register          
            $model->username = $username;
            $model->email = $email;
            $model->activkey = UserModule::encrypting(microtime() . $model->password);
            $model->password = UserModule::encrypting($password);            
            $model->createtime = time();
            $model->lastvisit = 0;
            $model->superuser = 0;
            $model->status = 1;

            if ($model->save()) {
                //seeting up user profile 
                $name = $username;
                $user_id = Yii::app()->db->getLastInsertID();
               $model->create_profile($user_id,$name);
                //sending welcome email with password 
             
$from = $common->location_name($data['location_from']);
$to = $common->location_name($data['location_to']);
$date_from = $data['date_from'];
$date_to = $data['date_to'];
$route_details = "You plan to go <br/><b>FROM</b>: $from <br/> <b>TO </b>: $to <br/> <b>BETWEEN </b>  $date_from To $date_to ";
$details = array(
                 
                   'header_name'=>'HexaTrip.com',
     'user_name'=>$username,
    
    'action_message'=>"Thanks for setting up an alert with us , This is what we know about your trip:<br/>$route_details
        <br/><br/>
        <b>Your alert is now ON, We will send you email once we find your perfect ticket.</b>
        <br/>
        <i>*You can also change Price/Date/Time for your ticket by logging into account at www.hexatrip.com</i>
        ",
    'details_headline'=>'We also created your account',
    'details_message'=>"To Manage your alerts, we automatically created an account for you.You can login to your account and make any changes you want to your alerts.<br/><h3> PASSWORD:$password </h3>.<br/>You can change your password once you are logged in.<br/>",
    'contact_info'=>"We Love your feedback.<br/> Mail us at : admin@hexatrip.com <br/> <b>Direct Feedback: <a href='$contact_url'>Feedback</a>  </b>",
    'footer_links'=>"<a href='$alert_url'>Change this alert</a> | <a href='$alert_url'>Add new alert</a> | <a href='$alert_url'>Unsubscribe</a>",
                   'site_name'=>Yii::app()->name,
               );
               $data = array();
               $data['email_to'] = $email;
               $data['view_file'] = 'welcome';
               $data['model'] = $details;    
               $data['subject'] = "Dear $username, Welcome to HexaTrip.com";    
               $common->send_mail($data);
                //logging the user in 
                $identity=new UserIdentity($model->username,$password);
	$identity->authenticate();
	Yii::app()->user->login($identity,0);
            }
        
    }
    
    /**
     * Created alert for logged in user with partially supplied data 
     */
    protected function create_partial_alert($data) {
        //alert data 
        $location_from = $data['location_from'];
        $location_to = $data['location_to'];
       $date_from = $data['date_from']; 
        $date_to = $data['date_to'];
        
        unset($_POST['email']);
        $model=new Alert;       
        $model->user_id = Yii::app()->user->id;  //add current user to the alert 
        $model->name = "MyAlert-$location_from-$location_to";
        $model->location_from = $location_from;
        $model->location_to = $location_to;
        $model->date_from = $date_from;
        $model->date_to = $date_to;
        $model->status = 1;  //active alert
        if($model->save()){
            return $model->id;
        }
    }

}