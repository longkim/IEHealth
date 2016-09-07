<?php
foreach ($tasks as $t){ $t_id = $t->t_id; ?>
<script>
	var s_id = <?php echo $t->t_id ;?>;
</script>
<div id="title" style="background-color:#<?php echo $color; ?>"><?php echo $t->t_short_desc;?></div>
<h1 style="clear:left;text-align:center;margin-bottom:8px">Updates</h1>
<?php } ?>
</div>
<div id="home_dialog"></div>
<div id="priority_area"><?php if (isset($result)){?>
<ul id="list_priority">
<?php foreach ($result as $res){?>
	<li class="list" name="<?php echo $res->up_name;?>" value="<?php  echo $res->up_id ;?>" style="width:auto;height:auto" title="<?php echo $res->up_name ?>">
		<a href="<?php echo base_url().'update/edit/'.$res->up_id.'/'.$color?>">
			<img class="editbutton" src='<?php echo asset_url().'img/edit.png';?>'/>
		</a>
		<table cellspacing="7" style="border-left:solid 40px #<?php echo $color; ?>; width:320px" id="tasklist">
			<th colspan="2"><h3 ><?php echo $res->up_name;?></h3></th>
			<tr>
				<td style="font-weight:bold">Description:</td>
				<td><?php echo $res->up_desc;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Type:</td>
				<td><?php echo $res->up_type;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Related Document</td>
				<td><a target="_blank" download="<?php echo $res->up_file;?>" href="<?php echo base_url().'uploads/'.$res->up_file?>"><?php echo $res->up_file ;?></a></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Newsworthy:</td>
				<td><?php echo ($res->worthy == 1)? 'Yes' : 'No'; ?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">CEO Report:</td>
				<td><?php echo ($res->ceo_report == 1)? 'Yes' : 'No';?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Create Date:</td>
				<td><?php echo $res->create_date;?></td>
			</tr>
		</table>
		
	</li>
	<?php }?>
	<li>
	<div>
		<a href="<?php echo base_url().'update/add/'.$t_id.'/'.$color?>">
			<img class="clickme" style="cursor: pointer;" width="50px" src="<?php echo base_url().'assets/img/plus.png'?>" />
		</a>
	</div>
	</li>
	<?php if ($this->session->userdata('admin')){?>
	<?php if($result != array()){ ?>
	<li id="trash">
	<div><img width="50px" src="<?php echo base_url().'assets/img/trash.png'?>" /></div>
	</li>
	<?php }}?>
</ul></div>
<?php  }?>
</body>
</html>
<script>

$(function() {
	$("ul#list_priority li.list").draggable({
		 start: function(event, ui) {
       	$(this).addClass('noclick');
   	},
		revert:true
		});

    $('#trash').droppable({
    	 accept: '.list',
        drop: function(event, ui) {
         if (confirm('Are you sure you want to delete the '+ui.draggable.attr('name')+' Update ?')) {
            var p = ui.draggable.val();
        	$.get('<?php echo base_url()."update/delete/" ;?>'+ui.draggable.val(),function(data){
        			
        			});
             ui.draggable.remove();
         } else {
             ui.draggable.show();
         }  
        }
    });

  });

    

</script>