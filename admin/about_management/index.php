<div class="content py-3">
	<div class="card card-outline card-primary shadow rounded-0">
		<div class="card-header">
			<h5 class="card-title"><b>About Us Content Management</b></h5>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form action="" id="content-form">
					<div class="row">
						<div class="col-lg-12">
							<textarea name="content[about]" id="" cols="30" rows="10" class="form-control form-control-sm summernote"><?= file_get_contents(base_app.'about.html') ?></textarea>
						</div>
					</div>
				</form>
			</div>
		</div>
        <div class="card-footer py-1 text-right">
            <button class="btn btn-primary btn-flat" type="submit" form="content-form"><i class="fa fa-save"></i> Save Content</button>
        </div>
	</div>
</div>
<script>
	$(function(){
		$('#content-form').submit(function(e){
			e.preventDefault();
			var _this = $(this)
				$('.err-msg').remove();
			var el = $('<div>')
				el.addClass('alert alert-danger err-msg')
				el.hide()
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_content",
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