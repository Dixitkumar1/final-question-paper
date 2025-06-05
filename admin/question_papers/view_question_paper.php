<?php

if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT q.*,CONCAT(cc.name,' - ',c.name) as `class` from `question_paper_list` q inner join class_list c on q.class_id = c.id inner join course_list cc on c.course_id = cc.id where q.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="content py-3">
    <div class="card card-outline card-primary shadow rounded-0">
        <div class="card-header">
            <h5 class="card-title">Question Paper Details</h5>
            <div class="card-tools">
                <button class="btn btn-danger btn-flat btn-sm" id="delete_data"><i class="fa fa-trash"></i> Delete</button>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <dl>
                    <dt class="text-muted">Class</dt>
                    <dd class="pl-4"><?= isset($class) ? $class : "" ?></dd>
                    <dt class="text-muted">Question Paper Title</dt>
                    <dd class="pl-4"><?= isset($title) ? $title : "" ?></dd>
                    <dt class="text-muted">General Instruction</dt>
                    <dd class="pl-4"><?= isset($description) ? $description : '' ?></dd>
                    <dt class="text-muted">Status</dt>
                    <dd class="pl-4">
                        <?php if($status == 1): ?>
                            <span class="badge badge-success px-3 rounded-pill">Active</span>
                        <?php else: ?>
                            <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
                        <?php endif; ?>
                    </dd>
                </dl>
                <hr>
                <div class="text-right">
                    <button class="btn btn-default border btn-sm btn-flat" id="add_question"><i class="fa fa-plus"></i> Add Question</button>
                </div>
                <h5><b>Question Items Summary</b></h5>
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-question"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Single Answer</span>
                                <span class="info-box-number text-right">
                                <?php 
                                    $question = $conn->query("SELECT * FROM question_list where question_paper_id = '{$id}' and `type` = 1 ")->num_rows;
                                    echo format_num($question);
                                ?>
                                <?php ?>
                                </span>
                                <span class="w-100 text-center"><a href="./?page=question_papers/view_question_paper&id=<?= isset($id) ? $id : "" ?>&type=1" data="">View List</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-question"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Mutliple Answer</span>
                                <span class="info-box-number text-right">
                                <?php 
                                    $question = $conn->query("SELECT * FROM question_list where question_paper_id = '{$id}' and `type` = 2 ")->num_rows;
                                    echo format_num($question);
                                ?>
                                <?php ?>
                                </span>
                                <span class="w-100 text-center"><a href="./?page=question_papers/view_question_paper&id=<?= isset($id) ? $id : "" ?>&type=2" data="">View List</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-question"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Text Answer</span>
                                <span class="info-box-number text-right">
                                <?php 
                                    $question = $conn->query("SELECT * FROM question_list where question_paper_id = '{$id}' and `type` = 3 ")->num_rows;
                                    echo format_num($question);
                                ?>
                                <?php ?>
                                </span>
                                <span class="w-100 text-center"><a href="./?page=question_papers/view_question_paper&id=<?= isset($id) ? $id : "" ?>&type=3" data="">View List</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(isset($_GET['type'])): ?>
                    <?php $type_arr = ['','Single Answer','Multiple Answers','Text Answer'] ?>
                    <h3>Question List for <b><?= isset($type_arr[$_GET['type']]) ? $type_arr[$_GET['type']] : "N/A" ?></b></h3>
                    <table class="table table-bordered">
                        <colgroup>
                            <col width="70%">
                            <col width="10%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center py-1">Question</th>
                                <th class="text-center py-1">Mark</th>
                                <th class="text-center py-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $questions = $conn->query("SELECT * FROM `question_list` where `type` = '{$_GET['type']}' and question_paper_id = '{$id}'");
                            while($row=$questions->fetch_array()):
                            ?>
                            <tr>
                                <td class="px-2 py-1 align-middle"><?= strip_tags(html_entity_decode($row['question']))?></td>
                                <td class="px-2 py-1 align-middle text-right"><?= format_num($row['mark']) ?></td>
                                <td class="px-2 py-1 align-middle text-center">
                                    <button type="button" class="btn btn-flat btn-sm btn-outline-danger delete_question" data-id="<?= $row['id'] ?>"><i class="fa fa-trash"></i> Delete</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#delete_data').click(function(){
			_conf("Are you sure to delete this Question Paper permanently?","delete_question_paper",["<?= isset($id) ? $id : '' ?>"])
		})
        $('#add_question').click(function(){
            uni_modal("<i class='fa fa-plus'></i> Add Question","question_papers/manage_question.php?qid=<?= isset($id) ? $id : '' ?>","large")
        })
        $('.delete_question').click(function(){
			_conf("Are you sure to delete this Question permanently?","delete_question",[$(this).attr('data-id')])
		})
        $('#generate_question_paper').click(function(){
            uni_modal("Generate Paper Question Form","question_papers/manage_generate_form.php?id=<?= isset($id) ? $id : '' ?>")
		})
        $('table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [2] }
			],
			order:[0,'asc']
		});
    })
    function delete_question_paper($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_question_paper",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace("./?page=question_papers");
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
    
    function delete_question($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_question",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
