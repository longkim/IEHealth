<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 	<?php if ($title != "Add New Priority Page"){ ?>
 	 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
 	 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 	  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 	 <?php }?>
	
	<link rel="stylesheet"  href="<?php echo asset_url().'css/style.css'?>" type="text/css" media="all">
	<title><?php echo $title;?></title>
</head>
<body>
<?php if ($title == "IEHealth Login Page" or $title == "Add New Priority Page" or $title=="Report Page View"){} else {?>
	<div id="menu">
		<div class="menu_logo">
			<a href="<?php echo base_url().'dashboard'; ?>">
				<img src="<?php echo asset_url().'/img/logo.png'?>"/>
			</a>
		</div>
		<div class="nav_menu">
			<?php if (isset($_SESSION['username'])){?>
				<div class="menu_user">
					<?php echo "Welcome, ".ucfirst($_SESSION['firstname'])." ".ucfirst($_SESSION['lastname'])."." ;?>
				</div>
			<?php }?>
			<ul class="menu">
				<li><?php echo anchor('admin/logout', 'Logout', 'title="Logout"');?></li>
				<li>
					<a>Report Generating</a>
					<ul style="width:80px;position: absolute;display:none;background: white;z-index:999999">
						<li class="report_menu"><?php echo anchor('report/ceo', 'CEO', 'title="Report"');?></li>
						<li class="report_menu"><?php echo anchor('report/adhoc', 'Adhoc', 'title="Report"');?></li>
					</ul>
				</li>
				<?php if ($this->session->userdata('admin')){?>
				<li><?php echo anchor('registration', 'Manage User', 'title="Register"');?></li>
				<?php }?>
				<li><?php echo anchor('welcome','Priority')?></li>
				<li><?php echo anchor('dashboard','Dash Board','title="Dash Board"')?></li>
			</ul>
		</div>
	</div>
<?php }?>
<script type="text/javascript">
$('.menu li').hover(function() {
   $(this).children('ul').stop(1, 1).slideToggle();
});
$('.report_menu').hover(function() {
	   $(this).css("color","red");
	   $(this).css("font-weight","bold");
	});
$('.report_menu').mouseout(function() {
	   $(this).css("color","royalblue");
	   $(this).css("font-weight","0");
	});
</script>