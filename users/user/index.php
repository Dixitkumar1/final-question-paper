<?php 
$user = $conn->query("SELECT * FROM registered_user_list where id ='".$_settings->userdata('id')."'");
foreach($user->fetch_array() as $k =>$v){
	$$k = $v;
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form id="update-frm" action="" method="post">
				<input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="firstname" class="control-label text-sm">First Name</label>
							<input type="text" name="firstname" id="firstname" autofocus class="form-control form-control-sm form-control-border" value="<?= isset($firstname) ? $firstname : '' ?>" required="required">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="middlename" class="control-label text-sm">Middle Name</label>
							<input type="text" name="middlename" id="middlename" class="form-control form-control-sm form-control-border" value="<?= isset($middlename) ? $middlename : '' ?>" placefolder="optional">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="lastname" class="control-label text-sm">Last Name</label>
							<input type="text" name="lastname" id="lastname" class="form-control form-control-sm form-control-border" value="<?= isset($lastname) ? $lastname : '' ?>" required="required">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="gender" class="control-label text-sm">Gender</label>
							<select name="gender" id="gender" class="form-control form-control-sm form-control-border" required="required">
								<option <?= isset($gender) && $gender == "Male" ? "selected" : "" ?>>Male</option>
								<option <?= isset($gender) && $gender == "Female" ? "selected" : "" ?>>Female</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="dob" class="control-label text-sm">Birthday</label>
							<input type="date" name="dob" id="dob" class="form-control form-control-sm form-control-border" value="<?= isset($dob) ? $dob : '' ?>" required="required">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="contact" class="control-label text-sm">Contact #</label>
							<input type="text" name="contact" id="contact" class="form-control form-control-sm form-control-border" value="<?= isset($contact) ? $contact : '' ?>" required="required">
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="email" class="control-label text-sm">Email</label>
							<input type="email" name="email" id="email" class="form-control form-control-sm form-control-border" value="<?= isset($email) ? $email : '' ?>" required="required">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="password" class="control-label text-sm">Password</label>
							<div class="input-group input-sm">
								<input type="password" name="password" id="password" class="form-control form-control-sm form-control-border">
								<div class="input-group-append">
									<button type="button" class="btn btn-default border-top-0 border-left-0 border-right-0 rounded-0 pass_view btn-sm" tabindex="-1"><i class="fa fa-eye-slash"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="cpassword" class="control-label text-sm">Confirm Password</label>
							<div class="input-group input-sm">
								<input type="password" id="cpassword" class="form-control form-control-sm form-control-border">
								<div class="input-group-append">
									<button type="button" class="btn btn-default border-top-0 border-left-0 border-right-0 rounded-0 pass_view btn-sm" tabindex="-1"><i class="fa fa-eye-slash"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Avatar</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group d-flex justify-content-center">
							<img src="<?php echo validate_image(isset($avatar)? $avatar : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary" form="update-frm">Update</button>
				</div>
			</div>
		</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('label').text(input.files[0]);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }else{
			$('#cimg').attr('src', "<?php echo validate_image(isset($avatar)? $avatar : '') ?>");
		}
	}
	$('#update-frm').submit(function(e){
        e.preventDefault();
        var _this = $(this)
        $('.err-msg').remove();
        var el = $('<div>')
            el.addClass('alert alert-danger err-msg')
            el.hide()
        if($('#password').val() != $('#cpassword').val()){
            el.text('Password does not match');
            _this.prepend(el)
            el.show('slow')
            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
            return false;
        }
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Users.php?f=save_ruser",
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
                    location.reload()
                }else if(resp.status == 'failed' && !!resp.msg){
                    el.text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                       
                }else{
                    el.text("An error occured")
                    _this.prepend(el)
                    el.show('slow')
                }
                $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                end_loader()
            }
        })
    })

</script>