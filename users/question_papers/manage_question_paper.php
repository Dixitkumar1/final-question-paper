<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `question_paper_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
	<form action="" id="type-form">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
			<label for="class_id" class="control-label">Class</label>
			<select name="class_id" id="class_id" class="form-control form-control-sm rounded-0 select2" required>
				<option value="" disabled <?= !isset($class_id) ? 'selected' : "" ?>></option>
				<?php 
				$class = $conn->query("SELECT c.*,concat(cc.name,' - ', c.name) as `class` FROM `class_list` c inner join course_list cc on c.course_id = cc.id where c.delete_flag = '0' and c.`status` = 1 and c.user_id = '{$_settings->userdata('id')}'  ".(isset($class_id) ? " or c.id = '{$class_id}'" : "")."  order by cc.`name` asc,c.`name` asc");
				while($row = $class->fetch_assoc()):
				?>
					<option value="<?= $row['id'] ?>" <?php echo isset($class_id) && $class_id == $row['id'] ? 'selected' : '' ?>><?= $row['class'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="title" class="control-label">Question Paper Title</label>
			<input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" value="<?php echo isset($title) ? $title : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="description" class="control-label">General Instruction</label>
			<textarea type="text" name="description" id="description" class="form-control form-control-sm rounded-0" required><?php echo isset($description) ? $description : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" class="form-control form-control-sm rounded-0" required>
			<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
			<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
			</select>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#uni_modal').on("shown.bs.modal",function(){
			$('.select2').select2({
				placeholder:"Please Select Here",
				width:"100%",
				dropdownParent:$('#uni_modal')
			})
		})
		$('#type-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_question_paper",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = ("./?page=question_papers/view_question_paper&id="+resp.qid)
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

	})
</script>