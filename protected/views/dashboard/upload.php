<!--<div class="content">
    <h1>Upload File</h1>
<div class="form well well-small">
<?php
//echo CHtml::beginForm('','post',
//        array('enctype'=>'multipart/form-data',
//            'action'=>Yii::app()->createUrl('//dashboard/upload')
//            )
//        
//        )?>

    <div><input type='file' name='file' /> <div><br/>
            <div><label for="type">Type:</label><select name="type" >
<option value="TRAIN">Train</option> 
<option value="FLIGHT">Flight</option> 
</select> </div>
<br/>
<?php 
//echo CHtml::submitButton('Upload',array('class'=>'btn btn-primary btn-large',
//    'name'=>'Upload'
//        ))?>
<?php 
//echo CHtml::endForm()?>
</div>
</div>-->

        
<?php if($uploaded):?>
<p>File was uploaded. Check <?php echo $dir?>.</p>
<?php endif ?>
<?php echo CHtml::beginForm('','post',array
('enctype'=>'multipart/form-data'))?>
<?php echo CHtml::error($model, 'file')?>
<?php echo CHtml::activeFileField($model, 'file')?>
            <div><label for="type">Type:</label><select name="type" >
<option value="TRAIN">Train</option> 
<option value="FLIGHT">Flight</option> 
</select> </div>
<?php echo CHtml::submitButton('Upload',array('class'=>'btn btn-primary btn-large',
    'name'=>'Upload'
        ))?>
<?php echo CHtml::endForm()?>
