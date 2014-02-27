<h1>Send Emails </h1>
<div class="row-fluid">
    <div>
        <br/>
    </div>
    
    
    <?php  if(isset($dataProvider)){  ?>
    
    <?php echo CHtml::beginForm(); ?>

<?php 
//$columns = array_keys($dataProvider->metaData->columns);
//$columns[array_search('alert_id', $columns)] = 
//        array(
//        'name'=>'Alert ID',             'value'=>'CHtml::checkBox("selectedAlerts[]",null,array("value"=>$data->alert_id,"id"=>"cid_".$data->id))',
//        'type'=>'raw',
//        'htmlOptions'=>array('width'=>5),
//        //'visible'=>false,
//        );
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'selectableRows' => 20,
    'columns'=>array(
    array(
        'name'=>'#',
        'type'=>'raw',
        'value'=>'CHtml::checkBox("selectedAlerts[]",null,array("value"=>$data["alert_id"],"id"=>"cid_".$data["alert_id"]))'
    ),
     array(
        'name'=>'Alert ID',
        'value'=>'$data["alert_id"]'
    ),
         array(
        'name'=>'Alert Email',
        'value'=>'$data["alert_email"]'
    ),
        array(
        'name'=>'Alert Name',
        'value'=>'$data["alert_name"]'
    ),
         array(
        'name'=>'Alert Desc',
        'value'=>'$data["alert_desc"]'
    ),
        array(
        'name'=>'Alert From',
        'value'=>'$data["alert_from"]'
    ),
          array(
        'name'=>'Alert To',
        'value'=>'$data["alert_to"]'
    ),
        array(
        'name'=>'Date From',
        'value'=>'$data["date_from"]'
    ),
         array(
        'name'=>'Date To',
        'value'=>'$data["date_to"]'
    ),
        array(
        'name'=>'Created',
        'value'=>'$data["created"]'
    ),
          array(
        'name'=>'Updated',
        'value'=>'$data["updated"]'
    ),
   
        )
    
   
));
?>

<div>
<?php echo CHtml::submitButton('Send Emails to Selected Alerts', array('name' => 'ApproveButton','class'=>'btn btn-primary btn-large')); ?>
<?php 
//echo CHtml::submitButton('Delete', 
//array('name' => 'DeleteButton',
//'confirm' => 'Are you sure you want to permanently delete these comments?'));
?>
</div>

<?php echo CHtml::endForm(); ?>
    
    <?php } ?>
    
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(FALSE){ 
    
    
    
    ?>
    
     <table class="table  table-striped  table-bordered table-hover">
         <thead>
     <tr>
       <th>Alert ID</th>
       <th>Email</th>
       <th>User</th>
       <th>Location From</th>
       <th>Location to</th>
        <th>Date From</th>
       <th>Date to</th>
       <th>User Settings</th>       
       <th>What changed</th>
     </tr>
         </thead>
          <tbody>
     <? foreach ($result as $row) : ?>
     <tr>
       <td><? echo $row['alert_data']['alert_unique_id']; ?></td>
       <td><? echo $row['alert_data']['email']; ?></td>
       <td><? echo $row['alert_data']['username']; ?></td>
       <td><? echo $row['alert_data']['location_from']; ?></td>
       <td><? echo $row['alert_data']['location_to']; ?></td>
       <td><? echo $row['alert_data']['date_from']; ?></td>
       <td><? echo $row['alert_data']['date_to']; ?></td>
       <td><? echo 
       'Train:'.$row['alert_data']['train']. '<br/>'.
        'Bus:'.$row['alert_data']['bus'].'<br/>'.
         'Flight:'.$row['alert_data']['flight']; 
       
       ?></td>
      
       <td><? echo implode('<br/>',$row['notification_data']); ?></td>
      
     </tr>
     <? endforeach; ?>
          </tbody>
   </table>

<?php  
} 
?>

</div>