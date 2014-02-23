<?php
	Yii::app()->clientscript
		// use it when you need it!
		/*
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css' )
		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END )
		*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />

<link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,700,900,900italic,300italic' rel='stylesheet' type='text/css' />

<?php 
$baseUrl = Yii::app()->theme->baseUrl; 
	  $cs = Yii::app()->getClientScript();
// $cs->registerCssFile('http://simplesphere.net/demo/leadgen/default/css/form.css');
          
          $cs->registerCssFile('http://simplesphere.net/demo/leadgen/default/css/style.css');
//          $cs->registerCssFile(Yii::app()->theme->baseUrl."/css/home/style.css"); 
           $cs->registerCssFile('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
           ?>
<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main_page.style.css" />-->
<!-- Le fav and touch icons -->
<style>
    .brand{        
    color: black;
    font-weight: bolder;
    }
    </style>
</head>

<body>
	<div class="navbar navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" style="font-weight: bolder;" href="<?php echo $baseUrl ?>" ><?php echo Yii::app()->name ?></a>
				<div class="nav-collapse">
					<?php
            //gets menu array links for user/gues/admin etc 
            $menu_array  = get_menu_array();  
            
            ?>
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>$menu_array,
                    'htmlOptions'=>array('class'=>'nav')
		)); ?>
					
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	
	<div class="cont">
	<div class="container-fluid">
	  <?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'homeLink'=>false,
				'tagName'=>'ul',
				'separator'=>'',
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
				'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				'htmlOptions'=>array ('class'=>'breadcrumb')
			)); ?>
		<!-- breadcrumbs -->
	  <?php endif?>
                <!--Showing flash messages through out the site-->
	<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
?>
	<?php echo $content ?>
	
	
	</div><!--/.fluid-container-->
	</div>
	
<!--	<div class="extra">
	  <div class="container">
		<div class="row">
			<div class="col-md-3">
				<h4>Heading 1</h4>
				<ul>
					<li><a href="#">Subheading 1.1</a></li>
					<li><a href="#">Subheading 1.2</a></li>
					<li><a href="#">Subheading 1.3</a></li>
					<li><a href="#">Subheading 1.4</a></li>
				</ul>
			</div>  /span3 
			
			<div class="col-md-3">
				<h4>Heading 2</h4>
				<ul>
					<li><a href="#">Subheading 2.1</a></li>
					<li><a href="#">Subheading 2.2</a></li>
					<li><a href="#">Subheading 2.3</a></li>
					<li><a href="#">Subheading 2.4</a></li>
				</ul>
			</div>  /span3 
			
			<div class="col-md-3">
				<h4>Heading 3</h4>	
				<ul>
					<li><a href="#">Subheading 3.1</a></li>
					<li><a href="#">Subheading 3.2</a></li>
					<li><a href="#">Subheading 3.3</a></li>
					<li><a href="#">Subheading 3.4</a></li>
				</ul>
			</div>  /span3 
			
			<div class="col-md-3">
				<h4>Heading 4</h4>
				<ul>
					<li><a href="#">Subheading 4.1</a></li>
					<li><a href="#">Subheading 4.2</a></li>
					<li><a href="#">Subheading 4.3</a></li>
					<li><a href="#">Subheading 4.4</a></li>
				</ul>
				</div>  /span3 
			</div>  /row 
		</div>  /container 
	</div>-->
	
<!--	<div class="footer">
	  <div class="container">
		<div class="row">
			<div id="footer-copyright" class="col-md-6">
				About us | Contact us | Terms & Conditions
			</div>  /span6 
			<div id="footer-terms" class="col-md-6">
				© 2012-13 Black Bootstrap. <a href="http://nachi.me.pn" target="_blank">Nachi</a>.
			</div>  /.span6 
		 </div>  /row 
	  </div>  /container 
	</div>-->


<!-- Require the footer -->
<?php require_once('footer.php')?>
</body>
</html>
<?php

//getting menu array link
function get_menu_array(){
    $base_items = array(
                            array('label'=>'Home', 'url'=>array('/site/index')),
                           
                            array('label'=>'Alerts', 'url'=>array('/alert/'), 'visible'=>!Yii::app()->user->isGuest     ),
                            array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 
                                'visible'=>Yii::app()->user->isGuest),
                            array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 
                                'visible'=>Yii::app()->user->isGuest),
                            array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"),
                                'visible'=>!Yii::app()->user->isGuest),
                            array('url'=>Yii::app()->getModule('user')->logoutUrl, 
                                'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')',
                                'visible'=>!Yii::app()->user->isGuest),
         array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
//                            array('label'=>'Contact', 'url'=>array('/site/contact')),
         array('label'=>'Disclaimer', 'url'=>array('/site/page', 'view'=>'disclaimer')),
        );
    
    $admin_items = array(
                            array('label'=>'Dashboard', 'url'=>array('/dashboard/')),
                            array('label'=>'Users', 'url'=>array('/user/')),                           
                            array('label'=>'Locations', 'url'=>array('/location/')),
                            );
    //if user is admin - return  admin array 
    $return = $base_items;
    if(Yii::app()->user->isGuest){
        return $return;
    }
    if(Common::is_superadmin(Yii::app()->user->id)){
        $return = array_merge($return, $admin_items);
        
    }
    //if user is logged in - return logged in array link
    //if user is guest - return guest link array 
    return $return;
}


?>