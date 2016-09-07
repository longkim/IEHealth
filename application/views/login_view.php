<div id="login">
	<h1>
		<a href="#" title="IEHealth" tabindex="-1"></a>
	</h1>
	<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
	<?php echo form_open('admin',$attributes); ?>
	<p>
		<?php echo form_label('Email Address:','email_address')?>
		<?php echo form_input('email_address','','id="email_address"')?>
	</p>
	<p>
		<?php echo form_label('Password:','password')?>
		<?php echo form_password('password','','id="password"')?>
	</p>
	<p>
		<?php $btn_att = array('class' => 'smbtn')?>
		<?php echo form_submit('submit','Log in',$btn_att)?>
	</p>
	
		<div class="error"><?php echo $this->session->flashdata('msg'); ?></div>
		<div class="error"><?php echo validation_errors(); ?></div>
	
	<?php echo form_close();?><!--
	<p id="nav">
		<?php echo anchor('registration', 'Register New User', 'title="Register"');?></br>
		<?php echo anchor('admin/reset_password', 'Forget Your Password ?', 'title="Reset Password"');?>	
	</p>-->
	
	
</div>
</body>
</html>