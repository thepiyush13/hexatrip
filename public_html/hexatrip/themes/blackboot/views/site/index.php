<?php  $baseUrl = Yii::app()->theme->baseUrl; 
	  $cs = Yii::app()->getClientScript();
//$cs->registerCssFile(Yii::app()->theme->baseUrl."/css/main_page.form.css"); 
//          $cs->registerCssFile('http://simplesphere.net/demo/leadgen/default/css/form.css'); 
         

?>
<!--<link rel="stylesheet" type="text/css" href="http://simplesphere.net/demo/leadgen/default/css/style.css" />-->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main_page.form.css" />

<?php
// $cs->registerCssFile(Yii::app()->theme->baseUrl."/css/home/style.css"); 
?>
<style>
    .banner ul li  {
        font-size: 24px;
    }
    .pricing ul li.cross{
        text-decoration: none;
        color: #867B7B;
    }
    .left-icon{
        text-align: center;
    }
    </style>
<div id="row-fluid">
			
            
	
<section id="banner-area" style="
    background: #1d2e7b;
">
		<div class="wrapper">
		
			<div class="row-fluid">
				<!-- Banner Content-->
				<div class="span8 banner">
					<h1>Find perfect ticket for your next trip !</h1>
					<ul>
						<li>Get available train ticket for your next trip</li>
						<li>Get flight tickets within your budget</li>
						<li>Get tickets for weekends, vacations, holidays</li>
						<li>Alerts on your Mobile or Email</li>
						<h4>.....In&nbsp;  3&nbsp; &nbsp;  easy steps !!</h4>
						
						
					</ul>
                                           <hr/>
                                           <div class="left-icon center"><div class="row-fluid text-center"><div class="span4 text-center" style="
    text-align: center;
">
  <h2 style="
    text-align: center;
">Step1</h2>
  <h5>Decide When &amp; where you want to go</h5>
  <h6><i class="fa fa-truck fa-3x base-color center" style="
    color: #ff8a00;
"></i><i class="fa fa-road fa-rotate-90 fa-3x base-color center" style="
    color: #ff8a00;
"></i><i class="fa fa-plane fa-3x base-color center" style="
    color: #ff8a00;
"></i></h6>

</div><div class="span4">
  <h2 style="
    text-align: center;
">Step2</h2>
  <h5 class="text-center" style="
    text-align: center;
">Setup an alert with us.Its easy and free</h5>
  <p class="text-center" style="
    text-align: center;
"><i class="fa fa-bell-o fa-3x base-color center" style="
    color: #ff8a00;
"></i></p></div><div class="span4">
  <h2 style="
    text-align: center;
">Step3</h2>
  <h5 style="
    text-align: center;
">Receive available tickets lists in your mailbox</h5>
  <p style="
    text-align: center;
"><i class="fa fa-envelope fa-3x base-color center" style="
    color: #ff8a00;
"></i></p></div></div>

            
                                          </div>
<!--                                          <div class="left-icon">

            <p>
              <i class="fa fa-truck fa-5x base-color center" style="
    color: #ff8a00;
"></i>
<i class="fa fa-road fa-5x base-color center" style="
    color: #ff8a00;
"></i>
 <i class="fa fa-plane fa-5x base-color center" style="
    color: #ff8a00;
"></i><i class="fa fa-long-arrow-right fa-5x base-color center" style="
    color: white;
"></i><i class="fa fa-bell-o fa-5x base-color center" style="
    color: #ff8a00;
"></i><i class="fa fa-long-arrow-right fa-5x base-color center" style="
    color: white;
"></i><i class="fa fa-envelope-o fa-5x base-color center" style="
    color: #ff8a00;
"></i>

    </p>
                                          </div>-->
				</div>
                             
                              
				<!-- End Banner Content-->

				<!-- Download / Sign Up Form -->
				<div class="span4">

<!--                                    <form method="post" action="mail.php" name="form-area" id="form-area" class="form-area">
                                            <div class="form-area-bottom">&nbsp;</div>
					</form>-->
						
						<?php 

    
 if(Yii::app()->user->isGuest){   
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'alert-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
                          'class'=>'form-area',
                        )
)); ?>
<h1 style="    margin: 0px;padding: 5px;
">Get Started. <strong>Its Free !</strong></h1>
	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<p class="note"><?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }  ?></p>

	
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'location_from'); ?>
		<?php echo $form->dropDownList($model,'location_from', $model->getLocationOptions()
                        ,array('options' => array('1'=>array('selected'=>true)))
                        ); ?>
		<?php echo $form->error($model,'location_from'); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'location_to'); ?>
		<?php echo $form->dropDownList($model,'location_to', $model->getLocationOptions()
                        ,array('options' => array('3'=>array('selected'=>true)))
                        ); ?>
		<?php echo $form->error($model,'location_to'); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'date_from'); ?>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Alert[date_from]',                       
                        'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd-mm-yy',
                            'minDate'=>'0',
                         ),
                 'htmlOptions'=>array(
                          'placeholder'=>'Select starting date',
                     'required'=>TRUE
                        )
	)); 
            
            ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'date_to'); ?>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Alert[date_to]',
                       'htmlOptions'=>array(
                          'placeholder'=>'Select ending date',
                           'required'=>TRUE
                        ),
                        'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd-mm-yy',
                             'minDate'=>'0',
                            
                         ),
	)); 
            
            ?>
	</div>
<div class="row-fluid">
		<label for="email">Your email</label>
		<input type="text" name="email" type="email" required  placeholder="shyam@gmail.com"/>
		
	</div>


	

	<div class="row-fluid buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Set Alert' : 'Save' ,  array('style' => '
    float: left;
    margin: 0px;
    width: 100%;
')
                        ); ?>
	</div>

<?php $this->endWidget(); 
 }
 else{
     //user if logged in 
     $url = Yii::app()->createUrl('/alert/create');
     echo '<div class="well well-large" >';
     echo '<a href="'.$url.'" class="btn btn-warning btn-large ui-button ui-widget ui-state-default ui-corner-all ui-state-focus">Create an alert</a>';
 echo '</div>';
     
 }
?>
								
						
<!--						
				</div>
				<!-- End Download / Sign Up Form -->
				
			</div>
			
		</div>
	</section>
<section id="intro">
		<div class="wrapper">	
		
			<!-- Headline -->
			<div class="headline">
				<h1>We make sure you book tickets for next trip before its too late</h1>
				<h2>HexaTrip is an email alert service for your perfect travel ticket</h2>
			</div>	
			<!-- End Headline -->
			
			<div class="row-fluid">
				<!-- Main Point 1 -->
				<div class="span4 left-icon center">
					<i class="fa fa-road fa-5x fa-rotate-90 base-color center" style="
    color: #ff8a00;
"></i>
					<h4>COULD NOT BOOK THAT TICKET ON IRCTC ?</h4>
					<p>Do not know when the ticket was available and when it was gone ? Not anymore , we provide accurate alerts on train availability, so you never miss that train to your home.</p>
				</div>
				<!-- End Main Point 1 -->
				
				<!-- Main Point 2 -->
				<div class="span4 left-icon">
					<i class="fa fa-truck fa-5x base-color center" style="
    color: #ff8a00;
"></i>
					<h4>BUS AVAILABILITY AND PRICE CHANGES?</h4>
					<p>Bus prices change often and so does the available seats.Now stay informed about bus tickets as we send alerts into your email and book them before its too late.</p>
				</div>
				<!-- End Main Point 2 -->
				
				<!-- Main Point 3 -->
				<div class="span4 left-icon">
					<i class="fa fa-plane fa-5x base-color center" style="
    color: #ff8a00;
"></i>
					<h4>FLIGHT PRICES INCREASED ! NOT AGAIN ?</h4>
					<p>How many times you wanted to take a flight only to discover later that the prices have gone up? Say no to these issues now with our easy to use flight price tracker.</p>
				</div>	
				<!-- Main Point 3 -->
				
			</div>	
			
		</div>
	</section>



<section id="tabbed">
		<div class="wrapper">
		
			<h2>HOW IT WORKS ?</h2><h4>You want to go home next week, 

let us see how you plan your advance booking :</h4>
		
			<div class="tabbable tabs-left">
				
				<!-- Start Tab Menu -->
				
			  <!-- End Tabs Menu -->
				  
				<!-- Start Tabs Mobile Menu -->
				
				<!-- End Tabs Mobile Menu -->
				  
				  <!-- Start Tab Content -->
				  <div class="tab-content">
				  
					<!-- Start Tab 1 : How it works -->
									
					<!-- End Tab 1 -->
					
					<!-- Start Tab 2 : Pricing -->
					<div id="pane2" class="tab-pane active">
						<div class="row-fluid pricing">
						
								

							<div class="span4">
								<div class="box">
									<h1>Old Way</h1> 
									
									<ul> 
										
										<li class="cross"> Look for train availability 5 times a day</li>
										<li class="cross"> Search 5 different websites for prices</li><li class="cross"> Worry about bus availability</li><li class="cross"> Worry about flight price changes</li><li class="cross"> Worry about confirmation of train ticket</li><li class="cross">Call travel agent and pay extra money to confirm a ticket</li>
									</ul>
									
								</div>
							</div>
							
							<div class="span4">
								<div class="box">
									<h1 class="popular">HexaTrip Way</h1> 
									
									<ul> 
										<li class="tick"> Set an alerts on price/availability for train, bus &amp; flight</li>
										<li class="tick">Find your perfect ticket in your mail box</li>
										<li class="tick">Enjoy your coffee !!</li>
									</ul>
									<div class="button popular"><a href="#alert-form" class="large-button yellow-btn">Start Now</a></div>
								</div>
							</div><div class="span4">
					<div id="testimonials">
						<ul class="slides">
							
							
							<li style="width: 100%; float: left; margin-right: -100%; position: relative; display: list-item;" class="flex-active-slide">
								
								<p style="line-height: 18px;font-size: 16px;">Whenever i booked ticket between Chennai and Hyderabad the waiting list queue moves very fast.I had to check the booking website 7 times a day to make sure i get the ticket.Thanks to hexatrip , i no longer need to do that and get all that alert in email.</p>
								<span class="author"><strong>- Shreyas Chauhan</strong></span>
							</li>
						</ul>
					</div>
					<!-- End Testiomnials -->
				</div>	
							
						</div>					
					</div>
					<!-- End Tab 2 -->
					
					<!-- Start Tab 3 : Video -->
					
					<!-- End Tab 3-->
					
					<!-- Start Tab 4 : Extra -->
					
					<!-- End Tab 4 -->
					
				  </div>
				  <!-- End Tab Content -->
				  
			</div>	
	
		</div>
	</section>
    
    

      
	  
            

</div>