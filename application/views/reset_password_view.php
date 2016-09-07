<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>IEHealth Login Page</title>
</head>
<body>
<h1>Login</h1>
<?php echo form_open('admin/forget_password'); ?>
<p>
	<?php echo form_label('Email Address:','email')?>
	<?php echo form_input('email','','id="email"')?>
</p>
<p>
	<?php echo form_submit('submit','Submit')?>
</p>
<?php echo form_close();?>

<div class="error"><?php echo validation_errors(); ?></div>
