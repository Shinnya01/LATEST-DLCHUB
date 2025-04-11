<html>
<?php
require("config/db.php");
require("layout/head.php");

?>
<body>
<?php require("layout/navtop.php") ?>
<?php require("layout/sidebar.php") ?>

<div class="p-4 mt-10 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 flex  gap-4 w-full h-160">
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
			<div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change profile picture</h5>
                        </div>
                        <div class="ibox-content">
							<form id="change_picture" method="GET" action="chat.php" class="form-horizontal">
								<div class="form-group"><label class="col-sm-1 control-label">Image URL</label>
									<div class="col-sm-10"><input type="text" name="profile_picture" value="<?= $profilePicture ?>" class="form-control" autocomplete="off"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-1">
										<small><p>You will be banned if using sensitive image/picture.</p></small>
										<button id="cppbtn" class="btn btn-primary" name="submit" type="submit">Change</button>
									</div>
								</div>
							</form>
                            
                        </div>
                    </div>
                </div>
			
			<div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change name</h5>
                        </div>
                        <div class="ibox-content">
							<form id="change_name" method="GET" action="chat.php" class="form-horizontal">
								<div class="form-group"><label class="col-sm-1 control-label">First name</label>
									<div class="col-sm-10"><input type="text" name="firstName" value="<?= $user["firstName"]; ?>" class="form-control" autocomplete="off"></div>
								</div>
								
								<div class="form-group"><label class="col-sm-1 control-label">Last name</label>
									<div class="col-sm-10"><input type="text" name="lastName" value="<?= $user["lastName"]; ?>" class="form-control" autocomplete="off"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-1">
										<button id="cgnbtn" class="btn btn-primary" name="submit" type="submit">Change</button>
									</div>
								</div>
							</form>
                            
                        </div>
                    </div>
                </div>
				
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change password</h5>
                        </div>
                        <div class="ibox-content">
							<form id="change_password" method="GET" action="chat.php" class="form-horizontal">
								<div class="form-group"><label class="col-sm-1 control-label">Current Password</label>
									<div class="col-sm-10"><input type="password" name="cr_password" value="" class="form-control" autocomplete="off"></div>
								</div>
								
								<div class="form-group"><label class="col-sm-1 control-label">New password</label>
									<div class="col-sm-10"><input type="password" name="nw_password" value="" class="form-control" autocomplete="off"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-1">
										<button id="cgpbtn" class="btn btn-primary" name="submit" type="submit">Change</button>
									</div>
								</div>
							</form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
       

            </div>


  </div>


<!-- Mainly scripts -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins/toastr/toastr.min.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>

<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script>
	$("#change_picture").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "ajax/request/account/change_picture.php",
			type: "POST",
			data:  new FormData(this),
			dataType:  'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$('#cppbtn').text('Processing...').prop('disabled', true)
			},
			success: function(r) {
				if(r.success){
					toastr.success(r.message)
				} else {
					toastr.error(r.message)
				}
			},
			error: function(){
				
				
			},
			complete: function(){
				$('#cppbtn').text('Change').prop('disabled', false)
			}
	});
	}));

	$("#change_password").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "ajax/request/account/change_password.php",
			type: "POST",
			data:  new FormData(this),
			dataType:  'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$('#cgpbtn').text('Processing...').prop('disabled', true)
			},
			success: function(r) {
				if(r.success){
					toastr.success(r.message)
					setTimeout(function() {
                        location.reload();
                    }, 3000);
			
				} else {
					toastr.error(r.message)
				}
			},
			error: function(){
				
				
			},
			complete: function(){
				$('#cgpbtn').text('Change').prop('disabled', false)
			}
	});
	}));

	$("#change_name").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "ajax/request/account/change_name.php",
			type: "POST",
			data:  new FormData(this),
			dataType:  'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$('#cgnbtn').text('Processing...').prop('disabled', true)
			},
			success: function(r) {
				if(r.success){
					toastr.success(r.message)
					
					setTimeout(function() {
                        location.reload();
                    }, 3000);
				} else {
					toastr.error(r.message)
				}
			},
			error: function(){
				
				
			},
			complete: function(){
				$('#cgnbtn').text('Change').prop('disabled', false)
			}
	});
	}));
</script>
</body>
</html>