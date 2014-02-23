<?php
/* @var $this AlertController */
/* @var $data Alert */
?>

<div class="view">
    
    <ul class="thumbnails">
                <li class="span12 clearfix">
                  <div class="thumbnail clearfix">
                    
                    <div class="caption" class="pull-left">
                      
                      <p class="pull-right"><?php echo CHtml::link(
                              CHtml::encode('View'), 
                              array('view', 'id'=>$data->id),array(
                              'class'=>'btn btn-default'
                                  )
                              ); ?> <span>&nbsp;&nbsp;&nbsp;</span>
                        <?php echo CHtml::link(
                              CHtml::encode('Update'), 
                              array('update', 'id'=>$data->id),array(
                              'class'=>'btn btn-default'
                                  )
                              ); ?></p>
                      <h4>      
                      
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
                      </h4>
                      <small><b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>: </b><?php echo CHtml::encode($data->name); ?></small>   |
                     <small><b>From: </b><?php echo CHtml::encode($data->location_from); ?></small>   |
                     <small><b>From: </b><?php echo CHtml::encode($data->location_to); ?></small>   |
                     <small><b>Date From: </b><?php echo CHtml::encode($data->date_from); ?></small>   |
                     <small><b>Date To: </b><?php echo CHtml::encode($data->date_to); ?></small>   
                     
                     
                    </div>
                  </div>
                </li>
    </ul>
	

</div>