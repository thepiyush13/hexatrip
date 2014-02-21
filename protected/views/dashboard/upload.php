<div class="content">
    <h1>Upload File</h1>
<div class="form well well-small">


<?php if($uploaded):?>
    
    
<p>File was uploaded. Check <?php echo $dir?>.</p>
<?php endif ?>
<?php echo CHtml::beginForm('','post',array
('enctype'=>'multipart/form-data'))?>



<div class="control-group">
              <label class="control-label" for="inputEmail">File</label>
              <div class="controls">
                <?php echo CHtml::error($model, 'file')?>
<?php echo CHtml::activeFileField($model, 'file')?>

              </div>
            </div>

<div class="control-group">
              <label class="control-label" for="inputEmail">Type:</label>
              <div class="controls">
                <select name="type" >
<option value="TRAIN">Train</option> 
<option value="FLIGHT">Flight</option> 
</select>
              </div>
            </div>
<?php echo CHtml::submitButton('Upload',array('class'=>'btn btn-primary btn-large')); ?>

          
<?php echo CHtml::endForm()?>
