<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);

$this->menu=array(
	array('label'=>'Load Train Data', 'url'=>array('//tempTrainStatus/loadData ')),
	array('label'=>'Send Email', 'url'=>array('sendMail')),
);
?>
<h1>Unique Routes</h1>
<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Download Routes as csv', 'url'=>array('/dashboard/downloadroutes')),
//				array('label'=>'Upload Route Data', 'url'=>array('/dashboard/upload')),
				
			),
		)); 

//main table for routes display 

//$invoiceItems =  array(
//  [0]=>array('name'=>'x','price'=>230),  
//    [1]=>array('name'=>'x','price'=>230),
//);
//$invoiceItemsDataProvider = new CArrayDataProvider($invoiceItems);
//$this->widget('zii.widgets.grid.CGridView', array(
//               'dataProvider'=>$invoiceItemsDataProvider,
//              ));

//$data  = new CArrayDataProvider($result);
//die(print_r($data));
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id'=>'',
//    'dataProvider'=>$data->rawData,
//    
//));


?>

<?php
//$arr=array(
//array('id'=>1,'name'=>"jack","age"=>10,"sex"=>"male"),
//array('id'=>2,'name'=>"jill","age"=>8,"sex"=>"female"),
//array('id'=>3,'name'=>"jhon","age"=>6,"sex"=>"male"),
//array('id'=>4,'name'=>"jerry","age"=>4,"sex"=>"male"),
//
//);
$arr =  $result;

$dataProvider=new CArrayDataProvider($arr,array(
'sort'=>array('attributes'=>array('from_id','from_name','to_id','to_name'),),
'pagination'=>array('pageSize'=>1)

));
?>
<div class="row-fluid">
    <div class="span12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'post-grid1',
         'itemsCssClass' => 'table',
'htmlOptions' => array('class' => 'table  table-bordered table-hover'),
        'dataProvider'=>$dataProvider,
        'columns'=>array(
            array(
                'name'=>'id',
                'value'=>'$data["id"]',
                ),
                array(
                'name'=>'From ID',
                'value'=>'$data["from_id"]',
                ),
                array(
                'name'=>'From Name',
                'value'=>'$data["from_name"]',
                ),
                array(
                'name'=>'To ID',
                'value'=>'$data["to_id"]',
                ),
                array(
                'name'=>'To Name',
                'value'=>'$data["to_name"]',
                ),
        ),
)); ?>
    </div>
</div>


<div>
    
    <?php
//    if(isset($result)){
//        $htm = '<table class="table  table-striped  table-bordered table-hover table-condensed"><tr>
//            <th>SNo</th>
//            <th>From ID</th>
//            <th>From</th>
//            <th>To ID</th>
//            <th>To</th>
//            </tr>';
//        foreach ($result as $key => $value) {
//    
//            $htm.='<tr>';
//            $htm.='<td>'.($key+1).'</td>';
//            $htm.='<td>'.$value['from']['id'].'</td><td>'.
//                    $value['from']['name'].'</td><td>'.
//                    $value['to']['id'].'</td><td>'.
//                    $value['to']['name'].'</td>';
//            $htm.='</tr>';
//}
//$htm.= '</table>';   
//echo $htm;    
//        
//    }
    
   
    ?>
     
</div>
