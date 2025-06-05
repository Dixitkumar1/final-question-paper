<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `question_list` where id = '{$_GET['id']}' ");
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
		<input type="hidden" name ="question_paper_id" value="<?php echo isset($_GET['qid']) ? $_GET['qid'] : (isset($question_paper_id) ? $question_paper_id : '') ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="question" class="control-label">Question</label>
                    <textarea type="text" name="question" id="question" class="form-control form-control-sm rounded-0 summernote" required><?php echo isset($question) ? html_entity_decode($question) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="mark" class="control-label">Mark</label>
                    <input type="number" name="mark" id="mark" min= "1" class="form-control form-control-sm rounded-0" value="<?php echo isset($mark) ? $mark : ''; ?>"  required/>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label">Question Type</label>
                    <select name="type" id="type" class="form-control form-control-sm rounded-0" required>
                    <option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Single Answer Only</option>
                    <option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Multiple Answers</option>
                    <option value="3" <?php echo isset($type) && $type == 3 ? 'selected' : '' ?>>Text Answer</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex w-100">
                    <div class="col-10"><b>Choices</b></div>
                    <div class="col-2 text-center"></div>
                </div>
                <div id="choices-list">
                    
                </div>
                <div class="text-right">
                    <button class="btn btn-flat btn-default btn-sm border" id="add_choice_item" type="button"> <i class="fa fa-plus"></i> Add Choice</button>
                </div>
            </div>
        </div>
		
	</form>
</div>
<noscript id="choice-clone">
<div class="d-flex w-100 choice-item my-3">
    <div class="col-10">
        <textarea type="text" class="form-control form-control-sm rounded-0" name="choice[]"></textarea>
    </div>
    <div class="col-2 text-center">
        <button class="btn btn-sm btn-outline-danger btn-flat rem-choice"><i class="fa fa-times"></i></button>
    </div>
</div>
</noscript>
<?php 
$choices = [];
if(isset($id)){
    $choice_query = $conn->query("SELECT * FROM `choice_list` where question_id = '{$id}'");
    while($row = $choice_query->fetch_assoc()){
        $choices[] = addslashes($row['choice']);
    }
}
?>
<noscript id="choice_data"><?= json_encode($choices) ?></noscript>
<script>
    function new_item($val=''){
        var item = $($('noscript#choice-clone').html()).clone()
            $('#choices-list').append(item)
            if($val != "")
            item.find('[name="choice[]"]').val($val)
            item.find('[name="choice[]"]').focus()
            item.find('.rem-choice:not([disabled])').click(function(){
                item.remove()
            })
    }
	$(document).ready(function(){
        $('#add_choice_item:not([disabled])').click(function(){
            new_item()
        })
        $('#uni_modal').on('shown.bs.modal',function(){
        const choices = $.parseJSON($('noscript#choice_data').text())
            if(Object.keys(choices).length > 0 ){
                Object.keys(choices).map(k=>{
                    new_item(choices[k])
                })
            }else{
                var item = 3;
                for(var i = 0; i < item; i++ ){
                    new_item()
                }
            }
        })

        $('#type').change(function(){
            var type = $(this).val()
            $('#choices-list .choice-item').each(function(){
                if(type == 3){
                    $(this).find('textarea, button').attr('disabled',true)
                }else{
                    $(this).find('textarea, button').attr('disabled',false)
                }
            })
            if(type == 3){
                $('#add_choice_item').attr('disabled',true)
            }else{
                $('#add_choice_item').attr('disabled',false)
            }
        })
        var type =  $('#type').val()
        $('#choices-list .choice-item').each(function(){
            if(type == 3){
                $(this).find('textarea, button').attr('disabled',true)
            }else{
                $(this).find('textarea, button').attr('disabled',false)
            }
        })
        if(type == 3){
            $('#add_choice_item').attr('disabled',true)
        }else{
            $('#add_choice_item').attr('disabled',false)
        }
		$('#uni_modal').on("shown.bs.modal",function(){
			$('.select2').select2({
				placeholder:"Please Select Here",
				width:"100%",
				dropdownParent:$('#uni_modal')
			})
            $('.summernote').summernote({
                height: "25vh",
				placeholder:"Please write the question here",
                toolbar: [
                    [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                    [ 'fontname', [ 'fontname' ] ],
                    [ 'fontsize', [ 'fontsize' ] ],
                    [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                    [ 'table', [ 'table' ] ],
                    [ 'insert', [ 'picture', 'video', 'link' ] ],
                    [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
                ]
            })
		})
		$('#type-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_question",
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
						location.reload();
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