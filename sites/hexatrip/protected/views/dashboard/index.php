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
    'id'=>'graph1',
'title'=>'user Growth'));


?></div>
    
    <div class="span8">
        <div class="row-fluid">
            <div class="span6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  <ul>
                  <li>
                    <span class="announcement-heading"><?php  echo $result['email_last_sent'] ?></span>
                    <span class="announcement-text1">Email last sent </span>
                    
                  </li>
                    <li>
                    <span class="announcement-heading"><?php  echo $result['email_today'] ?> </span>
                    <span class="announcement-text1">Mails Sent Today</span>
                    
                  </li>
                     <li>
                    <span class="announcement-heading"><?php  echo $result['email_week'] ?></span>
                    <span class="announcement-text1">Mails Sent Last Week</span>
                    
                  </li>
                      <li>
                    <span class="announcement-heading"><?php  echo $result['email_total'] ?></span>
                    <span class="announcement-text1">Total Mails Sent </span>
                    
                  </li>
                     <li>
                    <span class="announcement-heading"><?php  echo $result['alert_today'] ?></span>
                    <span class="announcement-text1">New alerts today</span>
                    
                  </li>
                    <li>
                    <span class="announcement-heading"><?php  echo $result['alert_week'] ?></span>
                    <span class="announcement-text1">New alerts last week </span>
                    
                  </li>
</ul>
                </div>
                </div>
              </div>
           
            </div>
            <div class="span6">
                <ul>
                    <li><p><i class="fa fa-calendar-o fa-2x"></i>  <a class="" href="<?php  echo $this->createUrl('//dashboard/routeData')  ?>" >  View Available Data</a></p></li>
                    <li><p><i class="fa fa-users fa-2x"></i>  <a class="" href="<?php  echo $this->createUrl('//dashboard/userRoutes')  ?>" >View User Alerts</a></p></li>
                </ul>
                <p>
            
           
            </p>
            </div>
          </div>
        </div>
       
<div class="row-fluid">
    
    
          
    
   
     <div class="row-fluid">
            <hr>
      
     </div>
          
         
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
<!--
<div class="row-fluid">
    <br/>
</div>
<div class="row-fluid">
          <div class="span4 block">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row-fluid">
                  <div class="span6">
                      <h4>User Routes</h4>
                    <i class="fa fa-users fa-5x"></i>
                  </div>
                  <div class="span6 text-right">
                    
                    <p class="announcement-text">User`s Alerts</p>
                    <p >
                    <a class="btn btn-primary block-action" href="<?php  echo $this->createUrl('//dashboard/userRoutes')  ?>"> View User Alerts</a>
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
                    <a class="btn btn-primary block-action" href="<?php  echo $this->createUrl('//dashboard/routeData')  ?>"> Manage Users</a>
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
         
        </div>-->
