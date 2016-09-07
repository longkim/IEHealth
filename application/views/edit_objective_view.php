<script>

$('document').ready(function(){
	$('form.loginform').on('submit',function(form){
		$('.oname').html('');
		$('.odesc').html('');
		form.preventDefault();
		var p = $("form.loginform").serialize();
		$.post('<?php echo base_url()."objective/update/".$oid;?>',p,function(data){
			if (data.status == false) {
				 $.each(data.errors, function(key, val) {

		                $('.'+key).html(val);
		            });
	        }else{
	           location.reload();
	        }
			},'json');
		});
});


</script>
<div id="dialog">
<h1 style="padding-top:5px" class="reg">Edit Objective</h1>
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open('objective/edit',$attributes); ?>
<?php foreach ($result as $res){?>
<p>
	<?php 
		echo form_label('Objective Name:','oname');
	?>
	<input type="text" name="oname" value="<?php echo $res->o_name?>" id="oname"/>
	<span class="error oname"></span>
</p>
<p>
	<?php echo form_label('Description:','odesc')?>
	<textarea name="odesc" cols="40" rows="10" id="odesc"><?php echo $res->o_description;?></textarea>
	<span class="error odesc"></span>
</p>
<p>
	<?php $btn_att = array('class' => 'smbtn')?>
	<?php echo form_submit('submit','Save',$btn_att)?>
</p>
<?php }?>
<?php echo form_close();?>
</div>
</body>
</html>

