<?php

class DashboardController extends Controller {

    /**
     * @return array action filters
     */
    
    public $layout='//layouts/column1';
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'update', 'create', 'delete', 'generate', 'routes', 'upload',
                    'downloadRoutes',
                    'downloadFormat',
                    'loadData',
                    'sendMail',
                    
                    
                    ),
                'users' => array('hexatrip'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

//    public function actionIndex() {
//        $this->render('index');
//    }
    
    /**
     * @return Return unique routes for alerts - from-to-date combo unique
     */
    public function actionIndex() {
        $result = array();
        
        
        //get alert count
        $sql = "SELECT COUNT(*) FROM alert where status = 1";
        $result['alert_count'] = Yii::app()->db->createCommand($sql)->queryScalar();
        //get user count
        $sql = "SELECT COUNT(*) FROM tbl_users where status = 1";
        $result['user_count'] = Yii::app()->db->createCommand($sql)->queryScalar();
        //get locations count 
        $sql = "SELECT COUNT(*) FROM location where status = 1";
        $result['location_count'] = Yii::app()->db->createCommand($sql)->queryScalar();
        
        //get email to sent count 
        $sql = "SELECT COUNT(*) FROM alert_status";
        $result['email_count'] = Yii::app()->db->createCommand($sql)->queryScalar();
        //get route count 
        $sql = "select COUNT(*)  from alert
  where alert.status= 1  and 
  location_from<>location_to 
  and date_from > now()
  and date_to > now()
  and date_to < date_add(NOW(),INTERVAL 2 MONTH) 
  group by location_from,location_to";
        $result['route_count'] = count(Yii::app()->db->createCommand($sql)->queryAll());
        
         //get email last sent date 
        $sql = "select DATE_FORMAT(created,'%d%b %y-%h:%s %p') from email_archive order by created desc limit 1";
        $result['email_last_sent'] = Yii::app()->db->createCommand($sql)->queryScalar();
        
        //get Today emails counts 
        $sql = "  select count(*)  from email_archive where created <= NOW() && created >= (NOW() - INTERVAL 1 DAY)";
        $result['email_today'] = Yii::app()->db->createCommand($sql)->queryScalar();
        
        //get weeks emails counts 
        $sql = "  select count(*)  from email_archive where created <= NOW() && created >= (NOW() - INTERVAL 7 DAY)";
        $result['email_week'] = Yii::app()->db->createCommand($sql)->queryScalar();
        
        //get total emails counts 
        $sql = "  select count(*)  from email_archive ";
        $result['email_total'] = Yii::app()->db->createCommand($sql)->queryScalar();
        
         //get Today alert counts 
        $sql = "  select count(*)  from alert where status=1 and created <= NOW() && created >= (NOW() - INTERVAL 1 DAY)";
        $result['alert_today'] = Yii::app()->db->createCommand($sql)->queryScalar();
        
        //get weeks alert counts 
        $sql = "  select count(*)  from alert where status=1 and created <= NOW() && created >= (NOW() - INTERVAL 7 DAY)";
        $result['alert_week'] = Yii::app()->db->createCommand($sql)->queryScalar();
        
         //get Chart data 
        $sql = "  select CONCAT(COUNT(*),'|',DATE(FROM_UNIXTIME(createtime))) as count from tbl_users group by DATE(FROM_UNIXTIME(createtime))";
        $temp = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($temp as $key => $value) {
            $result['chart_data']['user_chart'][] = explode('|',$value['count']);
        }
       
        //get EMAIL Chart data 
        $sql = "  select CONCAT(COUNT(*),'|',DATE(created)) as count from email_archive group by DATE(created)";
        $temp = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($temp as $key => $value) {
            $result['chart_data']['email_chart'][] = explode('|',$value['count']);
        }
        
        $this->render('index', array(
            'result'=>$result
                )
        );

    }
    
    public function actionRoutes(){
        $sql = "select * from alert
  where alert.status= 1  and 
  location_from<>location_to 
  and date_from > now()
  and date_to > now()
  and date_to < date_add(NOW(),INTERVAL 2 MONTH) 
  group by location_from,location_to";
        $routes = Yii::app()->db->createCommand($sql)->queryAll();
        $sql = "select * from location";
        $locations = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($routes as $key => $route) {
            foreach ($locations as $location) {
                if ($location['id'] == $route['location_from']) {
                    $from = array('from_id'=>$location['id'],
                        'from_name'=>$location['name'],
                             'from_desc'=>$location['desc']
                            );
                }
                if ($location['id'] == $route['location_to']) {
                    $to = array('to_id'=>$location['id'],
                        'to_name'=>$location['name'],
                         'to_desc'=>$location['desc']
                            );
                }
            }
            $output[$key] = array_merge($from,$to);
            $output[$key]['id'] = $key+1;
            
        }
        $this->render('routes', array(
            'result' => $output
                )
        );
    }
    
    
    
    
    /**
     * @return returns email table for different type of alert status - uses alert_status table 
     */
    public function actionSendMail() {
        
        //display all alert where email needs to sent to view file 
        
        //if no posted data - first time view - show alert email selection form
        if (!isset($_POST['ApproveButton'])|| !isset($_POST['selectedAlerts']) ){
            //$dataProvider = AlertStatus::model()->findAll();
            $dataProvider = new CActiveDataProvider('AlertStatus', array(
            'data'=>AlertStatus::model()->findAll(),
    ));
            $this->render('send_mail', array(
        'dataProvider' => $dataProvider,
    ));
            return TRUE;
        }
        
        //some data is posted - prepare and send email for this data
        $changed_alerts = $_POST['selectedAlerts'];
       
        //array_shift($changed_alerts); //remove first element , the header checkbox 
         
//        die(print_r($changed_alerts));
        
        //get all the alerts where critieria is found 
        //$changed_alerts  =  array_keys(CHtml::listData(AlertStatus::model()->findAll(),'alert_id','alert_id'));        
        //$changed_alerts_list  =  implode(',', $changed_alerts);
        
//        $alert_details = Yii::app()->db->createCommand("SELECT 
//             y.id as alert_unique_id,x.*,y.*,z.* 
//            FROM  tbl_users AS x 
//                JOIN alert AS y 
//                ON x.id =  y.user_id 
//                JOIN alert_status as z
//                ON y.id = z.alert_id
//                AND y.id IN($changed_alerts_list)")->queryAll();
        
        //now looping through each of these matched alerts
        $modelCommon = new Common;
        foreach ($changed_alerts as $key => $changed_alert) {
             
            $mail_data = array();
            //get alert email
            $alert_data  = Alert::model()->findByPK($changed_alert);
            $alert_email =  $modelCommon->alert_user_property($changed_alert, 'email')  ;        
            $alert_user_id = $modelCommon->alert_user_property($changed_alert, 'id')  ;        
            $from = $modelCommon->location_name($alert_data['location_from']);
            $to = $modelCommon->location_name($alert_data['location_to']);
            
            //create notification string for this alerts
            $alert_msg = $this->alert_msg($alert_data,$changed_alert);
            //now generating html array to be passed to view file
            $temp = array();
            $temp['alert_data'] = $alert_data;
            $temp['username'] = $modelCommon->alert_user_property($changed_alert, 'username');
            $temp['msg'] = $alert_msg;
            //pass to send mail function
            $mail_data['model'] =$this->get_mail_html($temp);
//            echo $this->render('/mail/alert_mail',array('model'=>$mail_data['model'] ));
            
            //add to email queue
            $mail_data['email_to'] = $alert_email;    
            $mail_data['view_file'] = 'alert_mail';
            $mail_data['subject'] = "Hi ".$temp['username'].",HexaAlert for your route {$from} - {$to} ";
            
           
            if($modelCommon->send_mail($mail_data)){
                //mail sends successful - now delete this record 
                AlertStatus::model()->deleteAll('alert_id=:alertID',array(':alertID'=>$changed_alert));
                //add for tracking purpose
                         $emailArchive = new EmailArchive;
                         $emailArchive->alert_id = $changed_alert;
                         $emailArchive->user_id = $alert_user_id;                        
                        if(!$emailArchive->Save()){
                            Yii::app()->user->setFlash('error', "cant add email to archive ");
                        };
            
            
            }
    
        }
        
      
        $this->render('send_mail', array(
          'dataProvider' =>NULL,
                )
        );
    }
    
    /**
     * @return Returns Notification string array by matching what changed in aler status table
     */
    protected  function alert_msg($alert_data,$alert_id) {
        $modes = array(
            'train'=>'Train',
            'bus'=>'Bus',
            'flight'=>'Flight',            
        );
        
        $msg = array();
        //get alert status changes 
        $status_changed  =  AlertStatus::model()->findAllByAttributes(array('alert_id'=>$alert_id));
       
        //check which status changed and get related information
        if(isset($status_changed[0]['train_price_alert'])||isset($status_changed[0]['train_avail_alert'])||isset($status_changed[0]['train_dept_alert']) ){
            //alert status change details
            $from_id  = $alert_data->location_from;
            $to_id  = $alert_data->location_to;
            $date_from = Yii::app()->dateFormatter->format(" yyyy-MM-dd", $alert_data->date_from) ;
            $date_to = Yii::app()->dateFormatter->format(" yyyy-MM-dd", $alert_data->date_to) ;  
            
            //finding train information
            $alert_train_data = array();
            $criteria = new CDbCriteria;
            $criteria->condition='location_from =  :location_from AND location_to = :location_to';
            $criteria->addCondition( 'date BETWEEN "'.$date_from.'" AND "'.$date_to.'"' );
            $criteria->params  =   array(':location_from' => $from_id,':location_to' => $to_id);
            $alert_train_data['matched']  = TempTrainStatus::model()->findAll($criteria); 
                //finding future ticket macthing 
            
//            
//            $list= Yii::app()->db->createCommand('select * from post')->queryAll();
//             $criteria = new CDbCriteria;
//             $criteria->select = 'SUM(available) as total_tickets ';
//            $criteria->condition='location_from =  :location_from AND location_to = :location_to AND date > :date_to';
//            $criteria->group = 'date';            
//            $criteria->params  =   array(':location_from' => $from_id,':location_to' => $to_id,':date_to'=>$date_to);
//            $x = new CActiveDataProvider('TempTrainStatus', array('criteria'=>$criteria));
//             $alert_train_data['future']  = TempTrainStatus::model()->findAll($criteria);
            
             $sql = "SELECT *,SUM(available) as total_tickets FROM temp_train_status 
                WHERE location_from =  $from_id AND location_to = $to_id AND date > '$date_to'
                GROUP BY date";
             $alert_train_data['future'] = Yii::app()->db->createCommand($sql)->queryAll();
             $msg['train']= $this->create_train_table($alert_train_data);
            
            //find other information
            $msg['flight']= $this->create_flight_table($alert_data);
            $msg['bus']= $this->create_bus_table($alert_data);
            
        }
//         if($status_changed['flight_price_alert']||$status_changed['flight_avail_alert']||$status_changed['flight_dept_alert']){
//            //alert status change details
//            $alert_flight_data  = TempflightStatus::model()->findAllByAttributes(array('alert_id'=>$alert_id) ); 
//        }
//         if($status_changed['bus_price_alert']||$status_changed['bus_avail_alert']||$status_changed['bus_dept_alert']){
//            //alert status change details
//            $alert_bus_data  = TempbusStatus::model()->findAllByAttributes(array('alert_id'=>$alert_id) ); 
//        }
        
        //now that we have all the status change and its related info - create a message for the user
        return $msg;
     


         
        
    }
    
    
    protected function create_train_table($data){       

        $data_matched = isset($data['matched']) ? $data['matched'] : FALSE;
        $data_future = isset($data['future']) ? $data['future'] : FALSE;
        $result = '';
        //if data is macthed - show main table 
        if($data_matched){
            $result.= '<h3>Total '.count($data_matched).' Train(s) found for your route</h3>';
        $result.= "<table border='1' cellpadding='4px'><tr><th>SNO.</th><th>Train Number</th><th>Train Name</th>
            <th>Date</th><th>Class</th><th>Available Seats</th><th>Action</th></tr>";
foreach($data_matched as $k=>$vv){
     
    $result.="<tr>";
     $result.="<td>".($k+1)."</td>";
        $result.="<td>".$vv['train_id']."</td>";
        $result.="<td>".$vv['train_name']."</td>";
        $result.="<td>".Yii::app()->dateFormatter->format(" dd-MM-yyyy", $vv['date']) ."</td>";
        $result.="<td>".$vv['type']."</td>";
        $result.="<td>Less than ".(ceil($vv['available'] / 10) * 10)."</td>";
        $result.="<td><a href='http://www.irctc.co.in'>Book now</a></td>";
        
    $result.="<tr>";
}
$result.="</table>";
        }
        //show future table also
        if($data_future){
            $total = 20;
            $result.= '<h3>Next available tickets </h3>';
        $result.= "<table border='1' cellpadding='4px'><tr><th>SNO.</th><th>Date</th><th>Total Available Seats</th> <th>Action</th></tr>";
foreach($data_future as $k=>$vv){
     
           
    $result.="<tr>";
     $result.="<td>".($k+1)."</td>";
        $result.="<td>".Yii::app()->dateFormatter->format(" dd-MM-yyyy", $vv['date'])."</td>";
        $result.="<td>".$vv['total_tickets']."</td>";
        $result.="<td><a href='http://www.irctc.co.in'>See details</a></td>";
       
        
    $result.="<tr>";
    //only next 20 trains 
    if($k>=$total){
        break;
    }
}
$result.="</table>";
        }
        
        
return $result;
    }
    
    protected function create_flight_table($data){
       
        $result = "<h3>Find affordable flight tickets 
<br/>

<h1> <a href='http://www.makemytrip.com'> Flight Tickets </a> </h1>

</h3>
            

";
        
return $result;
    }
    
    protected function create_bus_table($data){
       
        $result = "<h3>Find available bus tickets 
<br/>

<h1> <a href='http://www.redbus.in'> Bus Tickets </a> </h1>

</h3>
            

";
        
return $result;
    }
    
    /**
     * @return Returns Email html from given alert and notifcation data
     */
    protected  function get_mail_html($data) {
         $mdlCommon = new Common;
        $from = $mdlCommon->location_name($data['alert_data']['location_from']);
$to = $mdlCommon->location_name($data['alert_data']['location_to']);
        $date_from = $data['alert_data']['date_from'];
$date_to = $data['alert_data']['date_to'];
$username = $data['username'];
$msg  = $data['msg'];
$contact_url =  Yii::app()->createAbsoluteUrl('site/contact');
$alert_url =  Yii::app()->createAbsoluteUrl('alert/index');
$route_details = "You planned to go FROM: <b>$from </b> TO : <b>$to </b> BETWEEN  <b>$date_from</b> To <b>$date_to</b> ";
$details = array(
                 
                   'header_name'=>'HexaTrip.com',
     'user_name'=>$username,
     'main_message'=>"$route_details  We found following information about your route<br/>",
    'action_message'=>" <p>
        ".$msg['train']."</p>
            <hr/>
          ".$msg['flight']." 
        <hr/>
        ".$msg['bus']."
            <br/>
        *You can also change Price/Date/Time for your ticket by logging into account at www.hexatrip.com
        ",
    'details_headline'=>'',
    'details_message'=>"",
    'contact_info'=>"We Love your feedback.<br/> Mail us at : admin@hexatrip.com <br/> <b>Direct Feedback: <a href='$contact_url'>Feedback</a>  </b>",
    'footer_links'=>"<a href='$alert_url'>Change this alert</a> | <a href='$alert_url'>Add new alert</a> | <a href='$alert_url'>Unsubscribe</a><br/>br/>*Above information is estimated from various sources.Please visit official websites for correct information.",
                   'site_name'=>Yii::app()->name,
               );
               
               
               return $details;
}


    /**
     * @return Return csv file for unique routes which can be fed to scraper 
     */
    public function actionDownloadRoutes() {
        $dir = Yii::getPathOfAlias('application.data');
        $file_name = '/tmp/routes.csv';
        if (file_exists($file_name)) {
            unlink($file_name);
        }

        $sql = "select  'route_id','from_id','from_name','from_lat','from_long','from_desc','to_id','to_name','to_lat','to_long','to_desc'
 UNION  ALL
 select
concat(y.id,'-',z.id) as route_id,
  y.id as from_id,
  y.name as from_name,
  y.lat as from_lat,
    y.long as from_long,
    y.desc as from_desc,
     z.id as to_id,
  z.name as to_name,
  z.lat as to_lat,
    z.long as to_long,
    z.desc as to_desc 
INTO OUTFILE '$file_name'
FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'

  from alert as x 
  join location as y 
  on x.location_from = y.id join 
  location as z 
  on x.location_to = z.id 
  where x.status= 1  and x.location_from<>x.location_to group by x.location_from,x.location_to";
        $output = Yii::app()->db->createCommand($sql)->query();
        if (file_exists($file_name)) {
            $name = 'UniqueRouteFile.csv';
            Yii::app()->getRequest()->sendFile($name, file_get_contents($file_name));
        }
    }
/**
     * @return Return csv file  format for uploading the alert status data file for train bus and flight temp tables
 * these temp tables hold data for updating in status table then the entire table is removed for legal reasons 
     */
    public function actionDownloadFormat($type) {
        
        switch ($type) {
    case 'train':
        $file_name = 'upload_train_data_format.csv';
        $sql = "show columns from temp_train_status";
        break;

    default:
        return false;
        break;
}
$output = Yii::app()->db->createCommand($sql)->queryAll();
$output = CHtml::listData($output,'Field','Field');
$columns = implode(',',array_values($output));
//die(print_r($output));

Yii::app()->getRequest()->sendFile($file_name,$columns );
       
    }

    
    /**
     * @return Uploads file to application/uploads folder
     */
    function actionUpload() {
       
        $dir = Yii::getPathOfAlias('application.uploads');
        $uploaded = false;
        $model=new Upload();
        if(isset($_POST['Upload']))
        {
            $type = $_POST['type'];
        $model->attributes=$_POST['Upload'];
        $model->file=CUploadedFile::getInstance($model,'file');
        if($model->validate()){
            $uploaded=$model->file->saveAs($dir.'/'.$model->file->getName());
            $file_name  = $dir.'/'.$model->file->getName();
            $file_contents = file_get_contents($file_name);
            //cleanup before xml conversion 
            $file_contents = str_replace(array('\'', '"'), '', $file_contents); 
            $xml_input_string = '<?xml version="1.0" encoding="UTF-8" ?><document> ' .$file_contents.'</document>';
            $xml = simplexml_load_string($xml_input_string);
             if($type=='TRAIN'){
            $changed_alerts = $this->load_train_data($xml);
            $this->set_alert_status();
            }
//            if($type=='FLIGHT'){
//                $changed_alerts = $this->process_flight_data();
//            }
//            die(print_r($xml));
           //now that all the respective tables filled set alert status 
        }
        
        }
        $this->render('upload', array(
            'model' => $model,
            'uploaded' => $uploaded,
            'dir' => $dir,
        ));

        return true;
        
    }

    /**
     * @return Generate dummy records for alert table
     */
    public function actionGenerate() {
        $result = array();
        $sub_sql_a = 'INSERT INTO `alert` (
`name`,
`desc`,
`location_from`,
`location_to`,
`date_from`,
`date_to`,
`user_id`,
`status`,
`bus`,
`bus_price_min`,
`bus_price_max`,
`bus_avail_min`,
`bus_avail_max`,
`bus_dept_min`,
`bus_dept_max`,
`bus_arrive_min`,
`bus_arrive_max`,
`train`,
`train_price_min`,
`train_price_max`,
`train_avail_min`,
`train_avail_max`,
`train_dept_min`,
`train_dept_max`,
`train_arrive_min`,
`train_arrive_max`,
`flight`,
`flight_price_min`,
`flight_price_max`,
`flight_avail_min`,
`flight_avail_max`,
`flight_dept_min`,
`flight_dept_max`,
`flight_arrive_min`,
`flight_arrive_max`,
`created`
) ';
        $sql = "select * from location";
        $locations = Yii::app()->db->createCommand($sql)->queryAll();
        for ($i = 0; $i <= 300; $i++) {

            $location_from = $locations[rand(0, 10)]['id'];
            $location_to = $locations[rand(0, 10)]['id'];
            $name = 'MyAlert-' . $i;
            $desc = $name . ',' . $location_from . '-' . $location_to;
            $date_from = '2014-0' . rand(2, 5) . '-' . rand(10, 30);
            $date_to = '2014-0' . rand(2, 5) . '-' . rand(10, 30);
            $user_id = rand(1, 50);
            $status = 1;
            $bus = rand(0, 1);
            $bus_price_min = rand(0, 500);
            $bus_price_max = rand(0, 500);
            $bus_avail_min = rand(0, 500);
            $bus_avail_max = rand(0, 500);
            $bus_dept_min = rand(0, 500);
            $bus_dept_max = rand(0, 500);
            $bus_arrive_min = rand(0, 500);
            $bus_arrive_max = rand(0, 500);
            $train = rand(0, 1);
            $train_price_min = rand(0, 500);
            $train_price_max = rand(0, 500);
            $train_avail_min = rand(0, 500);
            $train_avail_max = rand(0, 500);
            $train_dept_min = rand(0, 500);
            $train_dept_max = rand(0, 500);
            $train_arrive_min = rand(0, 500);
            $train_arrive_max = rand(0, 500);
            $flight = rand(0, 1);
            $flight_price_min = rand(0, 500);
            $flight_price_max = rand(0, 500);
            $flight_avail_min = rand(0, 500);
            $flight_avail_max = rand(0, 500);
            $flight_dept_min = rand(0, 500);
            $flight_dept_max = rand(0, 500);
            $flight_arrive_min = rand(0, 500);
            $flight_arrive_max = rand(0, 500);
            $sub_sql_b = "
VALUES (
'$name',
'$desc',
$location_from,
$location_to,
'$date_from',
'$date_to',
$user_id,
$status,
$bus,
$bus_price_min,
$bus_price_max,
$bus_avail_min,
$bus_avail_max,
$bus_dept_min,
$bus_dept_max,
$bus_arrive_min,
$bus_arrive_max,
$train,
$train_price_min,
$train_price_max,
$train_avail_min,
$train_avail_max,
$train_dept_min,
$train_dept_max,
$train_arrive_min,
$train_arrive_max,
$flight,
$flight_price_min,
$flight_price_max,
$flight_avail_min,
$flight_avail_max,
$flight_dept_min,
$flight_dept_max,
$flight_arrive_min,
$flight_arrive_max,
    NOW()
)";

            $result[] = $sub_sql_a . '  ' . $sub_sql_b . ';';
        }

        $this->render('index', array(
            'result' => $result
                )
        );
    }
     /**
     * @return goes to temp_train_status table joins it with alert table to get alerts where train status have changed
     */
  protected  function load_train_data($xml_routes){
      
     //cleanup previous data 
                  TempTrainStatus::model()->deleteAll();      
    //get xml data

      foreach ($xml_routes as $key=> $value) {
          //get routes
          $data = array();
          $route =  (array)$value;
          $route_id = $route['id'];
          $temp = explode('-', $route_id);
          $data['location_from'] =$temp[0] ;
          $data['location_to'] = $temp[1] ;
          if(  ($route['train_number']=='#EANF#') || ($route['train_name']=='#EANF#')    ){
              continue; //train does not have valid data , so jump to next record              
          }
          $data['train_id'] =  $route['train_number'];
          $data['train_name'] =  $route['train_name'];
          
          //cleanup train data - split by new line - remove emoty lines - get fields seperated by comma 
            $train_data_temp = preg_split('/\n|\r/', $route['data'], -1, PREG_SPLIT_NO_EMPTY);
            array_shift($train_data_temp); //first row is header   
            //finding train status data 
            foreach ($train_data_temp as $k => $v) {
                $v_day  = explode(',',$v);
                $data['date'] = preg_replace('/\s+/', '', $v_day[1]); //remove whitespace
                $v_sl_avail = isset($v_day[2])? $v_day[2] :''  ;
                $v_3a_avail = isset($v_day[3])? $v_day[3] :'';
                //now check if 3a class and sl have availibility data
//                die($v_sl_avail);
                if (strpos($v_sl_avail,'AVAILABLE') !== false) {
                            $data['available'] = preg_replace("/[^0-9]/","",$v_sl_avail); //getting int from string
                            $data['type'] = 'SL';
                            $model = new TempTrainStatus;
                            $model->attributes =  $data;                            
                            if(!$model->Save()){
                                continue;
  }  
                }
                if (strpos($v_3a_avail,'AVAILABLE') !== false) {
                            $data['available'] = preg_replace("/[^0-9]/","",$v_3a_avail); //getting int from string
                            $data['type'] = '3AC';
                            $model = new TempTrainStatus;
                            $model->attributes =  $data;
                            $model->Save();
                }
  
            }
//            die(print_r($train_data_temp));
          
      
      //get trains 
      //get train data 
      //cleanup train data 
     //parse train data 
      //save to db 
    
        } 
      
      
     
  }  
  
   /**
     * @return Loads data to status table using mysql load data infile for efficient insertion
     */
  public   function actionLoadData(){     

		
      //if data is not poseted show the default posted form 
                if(!isset($_POST['Data']) || !isset($_POST['Data']['type']) || !isset($_POST['Data']['details']) ){                    
                    $this->render('upload');
                    return false;
      
                }
      
      //if data is posted , get the type of data 
                $type = $_POST['Data']['type'];
                $data = $_POST['Data']['details'];
      //determine the table based on type 
                switch ($type) {
    case 'train':
        $table = 'temp_train_status';
        $columns = array(           
            "`location_from`",
            "`location_from_name`",
            "`location_to`",
            "`location_to_name`",
            "`date`",
            "`type`",
            "`train_id`",
            "`train_name`",
            "`available`",
            "`desc`"
            );
        break;

    default:
        break;
}
      
      //if all set , create a temp file for load data infile function
$temp_path = '/tmp';
$temp_file =  $temp_path. '/Temp-status.csv';

file_put_contents($temp_file, $data);
      //file created , now prepare query 
$colmn_string = implode(',',$columns);
$sql = "LOAD DATA INFILE '$temp_file' INTO TABLE $table
FIELDS TERMINATED BY ',' 
ENCLOSED BY '\"' 
LINES TERMINATED BY '\r\n'
IGNORE 0 LINES
        ($colmn_string)";

      
      //insert data 
 $output = Yii::app()->db->createCommand($sql)->query();
 
      
      //inform user in case of any error
      if(!$output){
     Yii::app()->user->setFlash('error', "Could not insert the data, Invalid data posted");
 }else{
     Yii::app()->user->setFlash('success', "Data Inserted ");
 }
 
  $this->render('upload');
                    return true;
      
  }  
  /**
   * @return :  Sets the alert status table entries based on temp train status table
   */
  protected function set_alert_status(){
       //getting all the active alerts with train status ON , where something has changed in train options
            $sql = " SELECT x.id as alert_id  FROM `alert` as x  JOIN `temp_train_status` as y ON (1)
where x.location_from = y.location_from
and x.location_to  = y.location_to
and x.status=1
and x.train=1
and y.available between x.train_avail_min and x.train_avail_max
and y.date between x.date_from and x.date_to
and y.date >= NOW()
group by x.id";
            $output = Yii::app()->db->createCommand($sql)->queryAll();
            $alert_ids = array();
            foreach ($output as $key => $value) {
                $alert_ids[] = $value['alert_id'];
            }
  
            //remove duplicate entries
            $alert_ids = array_unique($alert_ids);

            //now we found the changed alerts - update them to the status table
            foreach ($alert_ids as $alert_id) {

                $criteria = new CDbCriteria;
                $criteria->condition = "alert_id = $alert_id";

                if (($modelAlertStatus = AlertStatus::model()->find($criteria)) === null) {
                    $modelAlertStatus = new AlertStatus;
}
                $modelAlertStatus->alert_id = $alert_id;
                $modelAlertStatus->train_avail_alert = 1;
                if (!$modelAlertStatus->save()) {
                    Yii::app()->user->setFlash('error', "Some error occured for alert id: $alert_id");
                };
            }
            Yii::app()->user->setFlash('success', "Success! Data Saved");
  }
  

}