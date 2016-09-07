<?php foreach ($strategy as $o){ $s_id = $o->s_id; ?>
<script>
	var s_id = <?php echo $o->s_id ;?>;
</script>
<div id="title" style="background-color:#<?php echo $color; ?>"><?php echo $o->s_name;?> : <?php echo $o->s_description?></div>
<h1 style="clear:left;text-align:center;margin-bottom:8px">Tasks</h1>
<?php } ?>
</div>
<div id="home_dialog"></div>
<div id="priority_area"><?php if (isset($result)){?>
<ul id="list_priority">
<?php foreach ($result as $res){?>
	<li class="list" name="<?php echo $res->t_short_desc;?>" value="<?php  echo $res->t_id ;?>" style="width:auto;height:auto" title="<?php echo $res->t_short_desc ?>">
		<a href="<?php echo base_url().'task/edit/'.$res->t_id.'/'.$color?>">
			<img class="editbutton" src='<?php echo asset_url().'img/edit.png';?>'/>
		</a>
		<table cellspacing="7" style="border-left:solid 40px #<?php echo $color; ?>" id="tasklist">
			<th colspan="2"><h3 ><?php echo $res->t_short_desc;?></h3></th>
			<tr>
				<td style="font-weight:bold">Task ID:</td>
				<td><?php echo $res->t_id;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Description:</td>
				<td><?php echo $res->t_desc;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Owner:</td>
				<td><?php echo $res->t_owner;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Members:</td>
				<td><?php echo $res->t_member;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Priority Area:</td>
				<td><?php echo $res->p_name;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Objective</td>
				<td><?php echo $res->o_name;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Strategy:</td>
				<td><?php echo $res->s_name;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Start Date:</td>
				<td><?php echo date_format(date_create($res->t_start_date),'d-m-Y');?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">End date:</td>
				<td><?php echo date_format(date_create($res->t_end_date),'d-m-Y');?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Linked task:</td>
				<td><a target="_blank" href="<?php echo base_url().'task/taskbyid/'.$res->t_link_id.'/'.$color?>"><?php echo $res->t_link_id;?></a></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Status:</td>
				<td><?php echo $res->t_status;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Reason:</td>
				<td><?php echo $res->reason;?></td>
			</tr>
		</table>
		
	</li>
	<?php }?>
	<li>
	<div>
		<a href="<?php echo base_url().'task/add/'.$s_id.'/'.$color?>">
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
</ul>
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
         if (confirm('Are you sure you want to delete the '+ui.draggable.attr('name')+' Task ?')) {
            var p = ui.draggable.val();
        	$.get('<?php echo base_url()."task/delete/" ;?>'+ui.draggable.val(),function(data){
        			
        			});
             ui.draggable.remove();
         } else {
             ui.draggable.show();
         }  
        }
    });

  });

    

$('ul#list_priority li.list').click(function(event) {
    if ($(this).hasClass('noclick')) {
        $(this).removeClass('noclick');
    }
    else {
    	var id = $(this).attr('value');
 	    window.location.href = "<?php echo base_url();?>update/index/"+id+"/<?php echo $color;?>";
    }
});



</script>