<div class="contact py-3">
	<div class="card card-outline card-primary shadow rounded-0">
		<div class="card-header">
			<h5 class="card-title"><b>Contact Information</b></h5>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form action="" id="contact-form">
					<div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="company_name" class="control-label">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control form-control-sm rounded-0" value="<?= $_settings->info('company_name') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="company_tel_no" class="control-label">Telephone Number</label>
                                <input type="text" name="company_tel_no" id="company_tel_no" class="form-control form-control-sm rounded-0" value="<?= $_settings->info('company_tel_no') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="company_mobile" class="control-label">Mobile Number</label>
                                <input type="text" name="company_mobile" id="company_mobile" class="form-control form-control-sm rounded-0" value="<?= $_settings->info('company_mobile') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="company_email" class="control-label">Email</label>
                                <input type="email" name="company_email" id="company_email" class="form-control form-control-sm rounded-0" value="<?= $_settings->info('company_email') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="company_address" class="control-label">Address</label>
                                <textarea rows="3" name="company_address" id="company_address" class="form-control form-control-sm rounded-0" required><?= $_settings->info('company_address') ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="company_description" class="control-label">Company Short Description</label>
                                <textarea rows="5" name="company_description" id="company_description" class="form-control form-control-sm rounded-0" required><?= $_settings->info('company_description') ?></textarea>
                            </div>
                        </div>
                    </div>
				</form>
			</div>
		</div>
        <div class="card-footer py-1 text-right">
            <button class="btn btn-primary btn-flat" type="submit" form="contact-form"><i class="fa fa-save"></i> Save Contact Information</button>
        </div>
	</div>
</div>
<script>
	$(function(){
		$('#contact-form').submit(function(e){
			e.preventDefault();
			var _this = $(this)
				$('.err-msg').remove();
			var el = $('<div>')
				el.addClass('alert alert-danger err-msg')
				el.hide()
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_contact",
				data: _this.serialize(),
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
							el.text(resp.msg)
							_this.prepend(el)
							el.show('slow')
							$("html, body").scrollTop(0);
							end_loader()
					}else{
						alert_toast("An error occured",'error');
						end_loader();
						console.log(resp)
					}
				}
			})
		})
		$('.summernote').summernote({
			height: "70vh",
			toolbar: [
				[ 'style', [ 'style' ] ],
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
</script>