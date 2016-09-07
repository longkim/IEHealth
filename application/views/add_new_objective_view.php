<script>

$('document').ready(function(){
	$('form.loginform').on('submit',function(form){
		$('.oname').html('');
		$('.odesc').html('');
		form.preventDefault();
		var p = $("form.loginform").serialize();
		$.post('<?php echo base_url()."objective/create/".$pid ;?>',p,function(data){
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
<h1 style="padding-top:5px" class="reg">Add New Objective</h1>
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open('objective/create',$attributes); ?>
<p>
	<?php echo form_label('Objective Name:','oname')?>
	<?php echo form_input('oname','','id="oname"')?>
	<span class="error oname"></span>
</p>
<p>
	<?php echo form_label('Description:','odesc')?>
	<?php echo form_textarea('odesc','',array('id' => 'odesc', 'rows' => '10','cols'=>'20'))?>
	<span class="error odesc"></span>
</p>
<p>
	<?php $btn_att = array('class' => 'smbtn')?>
	<?php echo form_submit('submit','Register',$btn_att)?>
</p>
<?php echo form_close();?>
</div>
</body>
</html>

