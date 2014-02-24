<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h1>Admin Dashboard</h1>


<?php 
//$this->widget('zii.widgets.CMenu',array(
//			'items'=>array(
//				array('label'=>'Todays Routes', 'url'=>array('/dashboard/routes')),
//				array('label'=>'Upload Route Data', 'url'=>array('/dashboard/upload')),
//				
//			),
//		)); 
//$this->menu=array(
//	array('label'=>'Load Train Data', 'url'=>array('//tempTrainStatus/loadData ')),
//	array('label'=>'Send Email', 'url'=>array('sendMail')),
//);

?>
<div>
    
    <?php
   
   
    ?>
    
</div>
<!--DASHBOARD BLOCKS-->

<style>
    .block{
        border: 1px solid rgb(221, 213, 213);
padding: 10px;
    }
    .announcement-heading{
        font-size: 30px;
margin: 4px;

    }
    .block-action{
        color:white;
    }
    
</style>
<br/>
<div class="row-fluid">
    <div class="span4"><?php
$array= $result['chart_data']['user_chart'];

//   die(print_r($array));      
$this->widget('jqBarGraph',
array('values'=>$array,
'type'=>'simple',
'width'=>400,
'color1'=>'#122A47',
'color2'=>'#122A47',
'space'=>5,
'title'=>'user Growth'));


?></div>
    
    <div class="span8">
        <div class="row-fluid"><div class="span6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  
                  <div class="span12 text-right">
                    <p class="announcement-heading"><?php  echo $result['email_last_sent'] ?></p>
                    <p class="announcement-text">Email last sent</p>
                    
                  </div>
                </div>
              </div>
           
            </div>
          </div><div class="span6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  
                  <div class="span12 text-right">
                    <p class="announcement-heading"><?php  echo $result['email_today'] ?></p>
                    <p class="announcement-text">Mails Sent Today</p>
                    
                  </div>
                </div>
              </div>
           
            </div>
          </div></div>
        <div class="row-fluid"><div class="span6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  
                  <div class="span12 text-right">
                    <p class="announcement-heading"><?php  echo $result['email_week'] ?></p>
                    <p class="announcement-text">Mails Sent Last Week</p>
                    
                  </div>
                </div>
              </div>
           
            </div>
          </div>
    
    <div class="span6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  
                  <div class="span12 text-right">
                    <p class="announcement-heading"><?php  echo $result['email_total'] ?></p>
                    <p class="announcement-text">Total Mails Sent </p>
                    
                  </div>
                </div>
              </div>
           
            </div>
          </div></div>
        <div class="row-fluid"> <div class="span6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  
                  <div class="span12 text-right">
                    <p class="announcement-heading"><?php  echo $result['alert_today'] ?></p>
                    <p class="announcement-text">New alerts today</p>
                    
                  </div>
                </div>
              </div>
           
            </div>
          </div><div class="span6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  
                  <div class="span12 text-right">
                    <p class="announcement-heading"><?php  echo $result['alert_week'] ?></p>
                    <p class="announcement-text">New alerts last week </p>
                    
                  </div>
                </div>
              </div>
           
            </div>
          </div></div>
    </div>
</div>
<div class="row-fluid">
    
    
          
    
   
     <div class="row-fluid"><br><hr></div>
          
         
        </div>
<div class="row-fluid">
          <div class="span4 block">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  <div class="span6">
                      <h4>Routes</h4>
                    <i class="fa fa-calendar fa-5x"></i>
                  </div>
                  <div class="span6 text-right">
                    <p class="announcement-heading"><?php  echo $result['route_count'] ?></p>
                    <p class="announcement-text">Todays  Routes</p>
                     <p >
                    <a class="btn btn-primary block-action" href="<?php  echo $this->createUrl('//dashboard/routes')  ?>">View Routes</a>
                </p>
                  </div>
                </div>
              </div>
               
           
            </div>
          </div>
          <div class="span4 block">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row-fluid">
                  <div class="span6">
                      <h4>Upload</h4>
                    <i class="fa fa-upload fa-5x"></i>
                  </div>
                  <div class="span6 text-right">
                    <p class="announcement-heading">Upload</p>
                    <p class="announcement-text">Upload file</p>
                      <p >
                    <a class="btn btn-primary block-action" href="<?php  echo $this->createUrl('//dashboard/upload')  ?>">Upload Train Data</a>
                </p>
                  </div>
                </div>
              </div>
            
            </div>
          </div>
          <div class="span4 block">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row-fluid">
                  <div class="span6">
                      <h4>Emails</h4>
                    <i class="fa fa-envelope fa-5x"></i>
                  </div>
                  <div class="span6 text-right">
                    <p class="announcement-heading"><?php  echo $result['email_count'] ?></p>
                    <p class="announcement-text">Pending Email(s)</p>
                     <p >
                    <a class="btn btn-primary block-action" href="<?php  echo $this->createUrl('//dashboard/sendMail')  ?>">Send Emails</a>
                </p>
                  </div>
                </div>
              </div>
           
            </div>
          </div>
         
        </div>
<div class="row-fluid">
    <br/>
</div>
<div class="row-fluid">
          <div class="span4 block">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  <div class="span6">
                      <h4>Alerts</h4>
                    <i class="fa fa-bell fa-5x"></i>
                  </div>
                  <div class="span6 text-right">
                    <p class="announcement-heading"><?php  echo $result['alert_count'] ?></p>
                    <p class="announcement-text">Active Alerts</p>
                    <p >
                    <a class="btn btn-primary block-action" href="<?php  echo $this->createUrl('//alert/admin')  ?>"> Manage Alerts</a>
                </p>
                  </div>
                </div>
              </div>
           
            </div>
          </div>
          <div class="span4 block">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row-fluid">
                  <div class="span6">
                      <h4>Users</h4>
                    <i class="fa fa-group fa-5x"></i>
                  </div>
                  <div class="span6 text-right">
                    <p class="announcement-heading"><?php  echo $result['user_count'] ?></p>
                    <p class="announcement-text">Active Users</p>
                      <p >
                    <a class="btn btn-primary block-action" href="<?php  echo $this->createUrl('//user/admin')  ?>"> Manage Users</a>
                </p>
                  </div>
                </div>
              </div>
          
            </div>
          </div>
          <div class="span4 block">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row-fluid">
                  <div class="span6">
                      <h4>Locations</h4>
                    <i class="fa fa-flag fa-5x"></i>
                  </div>
                  <div class="span6 text-right">
                    <p class="announcement-heading"><?php  echo $result['location_count'] ?></p>
                    <p class="announcement-text">Active Locations</p>
                      <p >
                    <a class="btn btn-primary block-action" href="<?php  echo $this->createUrl('//location/admin')  ?>"> Manage Locations</a>
                </p>
                  </div>
                </div>
              </div>
        
            </div>
          </div>
         
        </div>


<?php
//$data = isset($result['chart_data'])? $result['chart_data'] : 'ddd';
//$script = <<<JavaScript
//    $(document).ready(function(){
//        var data = '{$data}';
//        dashboard_charts(data) ;
//        });
//JavaScript;
//Yii::app()->getClientScript()->registerScript('id',$script);