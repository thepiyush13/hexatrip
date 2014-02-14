

<?php echo CHtml::beginForm('','post',
        array('enctype'=>'multipart/form-data',
            'action'=>Yii::app()->createUrl('//dashboard/upload')
            )
        
        )?>

<textarea name="Data[details]" rows="50"  class="span10">
</textarea>
<select name="Data[type]" >
<option value="train">Train</option> 
<option value="flight">Flight</option> 
</select>
<?php echo CHtml::submitButton('Upload')?>
<?php echo CHtml::endForm()?>
