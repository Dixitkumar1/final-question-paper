<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo "<scrtip> alert('You must fill generate form fields first'); location.replace(document.referer);</script>";
    exit;
}
extract($_POST);
if(isset($_POST['id']) && $_POST['id'] > 0){
    $qry = $conn->query("SELECT q.*,CONCAT(cc.name,' - ',c.name) as `class` from `question_paper_list` q inner join class_list c on q.class_id = c.id inner join course_list cc on c.course_id = cc.id where q.id = '{$_POST['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
$category = ["A.", "B.", "C."];
$current_category = 0;
?>
<div class="content py-3">
    <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
            <h5 class="card-title"><b>Generated Question Paper</b></h5>
            <div class="card-tools">
                <button class="btn btn-default border btn-flat btn-sm" id="print"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
        <div class="card-body">
            <div id="outprint">
                <style>
                    .radio-choice{
                        height:15px;
                        width:15px;
                        border: 1px solid #000;
                        border-radius:50% 50%;
                    }
                    .check-choice{
                        height:15px;
                        width:15px;
                        border: 1px solid #000;
                    }
                    .text-field{
                        height:10em;
                        width:100%;
                    }
                </style>
                <h4 class="m-0 text-center"><b><?= isset($title) ? $title : "" ?></b></h4>
                <div class="m-0 text-center">for</div>
                <h5 class="m-0 text-center"><b><?= isset($class) ? $class : "" ?></b></h5>
                <hr>
                <small><i><b>General Instruction:</b> <?= isset($description) ? $description : '' ?></i></small>
                <?php if($single > 0): ?>
                <hr>
                    <h5><b><?= $category[$current_category++]; ?></b> Select the correct answer from the choices for each question.</h5>
                    <hr>
                    <?php 
                    $i = 1;
                    $questions = $conn->query("SELECT * from `question_list` where question_paper_id = '{$id}' and `type` = 1 order by RAND() limit {$single}");
                    while($row= $questions->fetch_assoc()):
                    ?>
                    <div class="question-item mb-3">
                        <div class="d-flex w-100 mb-1">
                            <div class="col-auto pr-1"><b><?= $i++ ?>.</b></div>
                            <div class="col-auto flex-shrink-1 flex-grow-1"><?=$row['question'] ?></div>
                        </div>
                        <div class="mx-2 mb-3">
                            <div class="row">
                                <?php 
                                $options = $conn->query("SELECT * FROM choice_list where question_id = '{$row['id']}'");
                                while($orow = $options->fetch_array()):
                                ?>
                                <div class="col-md-6">
                                    <div class="d-flex w-100 mb-1">
                                        <div class="col-auto pr-1 align-middle pt-1"><div class="radio-choice"></div></div>
                                        <div class="col-auto flex-shrink-1 flex-grow-1"><?=$orow['choice'] ?></div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if($multiple > 0): ?>
                <hr>
                    <h5><b><?= $category[$current_category++]; ?></b> Select the correct answers from the choices for each question. You can choose more than 1.</h5>
                    <hr>
                    <?php 
                    $i = 1;
                    $questions = $conn->query("SELECT * from `question_list` where question_paper_id = '{$id}' and `type` = 2 order by RAND() limit {$multiple}");
                    while($row= $questions->fetch_assoc()):
                    ?>
                    <div class="question-item mb-3">
                        <div class="d-flex w-100 mb-1">
                            <div class="col-auto pr-1"><b><?= $i++ ?>.</b></div>
                            <div class="col-auto flex-shrink-1 flex-grow-1"><?=$row['question'] ?></div>
                        </div>
                        <div class="mx-2 mb-3">
                            <div class="row">
                                <?php 
                                $options = $conn->query("SELECT * FROM choice_list where question_id = '{$row['id']}'");
                                while($orow = $options->fetch_array()):
                                ?>
                                <div class="col-md-6">
                                    <div class="d-flex w-100 mb-1">
                                        <div class="col-auto pr-1 align-middle pt-1"><div class="check-choice"></div></div>
                                        <div class="col-auto flex-shrink-1 flex-grow-1"><?=$orow['choice'] ?></div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if($text > 0): ?>
                <hr>
                    <h5><b><?= $category[$current_category++]; ?></b> Write your Answer in the provided text field.</h5>
                    <hr>
                    <?php 
                    $i = 1;
                    $questions = $conn->query("SELECT * from `question_list` where question_paper_id = '{$id}' and `type` = 3 order by RAND() limit {$text}");
                    while($row= $questions->fetch_assoc()):
                    ?>
                    <div class="question-item mb-3">
                        <div class="d-flex w-100 mb-1">
                            <div class="col-auto pr-1"><b><?= $i++ ?>.</b></div>
                            <div class="col-auto flex-shrink-1 flex-grow-1"><?=$row['question'] ?></div>
                        </div>
                        <div class="mx-2 mb-3">
                            <div class="text-field"></div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#print').click(function(){
            var h = $('head').clone()
            var p = $('#outprint').clone()
            var el = $('<div>')
            h.find('title').text("Generated Question Paper - Print View")
            h.append("<style> html,body{ min-height:unset !important}</style>");
            el.append(h)
            el.append(p)
            start_loader()
            var nw = window.open("","_blank","width=1000,height=800, left=200, top=50")
            nw.document.write(el.html())
            nw.document.close()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    nw.close()
                    end_loader()
                }, 200);
            }, 300);
        })
    })
</script>