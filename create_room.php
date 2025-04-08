<html>
<?php
if(!session_id()){
	session_start();
}
require("config/db.php");
$title = "My Room"; /* ---> */ 
require("layout/head.php");

if(checkUserSession($db) !== TRUE){
	header("location: $_LOGIN_FILE");exit; //$_LOGIN_FILE --> /config/value.php
}

$user = searchUser_bSession($db, $_COOKIE["user_session"]);

?>
<body>

	<?php 
	require("layout/navtop.php"); 
	require("layout/sidebar.php"); 
	?>
<div class="p-4 mt-10 sm:ml-64">


        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 relative">
			 
		<div id="toast-container" class="absolute right-0 p-4" aria-live="polite" role="alert">
		</div>
        
    create room
         
	<form id="create_form" class="form-horizontal">
								<div class="form-group"><label class="col-sm-1 control-label">Room Name</label>
									<div class="col-sm-10"><input type="text" name="room_name" value="" class="form-control" autocomplete="off"></div>
								</div>
								
								<div class="form-group"><label class="col-sm-1 control-label">Room description</label>
									<div class="col-sm-10"><input type="text" name="room_desc" value="" class="form-control" autocomplete="off"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-1">
										<button id="create_button" class="btn btn-primary" value="submit" name="submit" type="submit">Create room</button>
									</div>
								</div>
							</form>

        </div>

     

</div>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>



  
<!-- Mainly scripts -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/toastr/toastr.min.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>



<!-- Custom and plugin javascript -->
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>

<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script>
$("#create_form").on('submit',(function(e) {
	e.preventDefault();
	$.ajax({
		url: "ajax/request/create_room.php",
		type: "POST",
		data:  new FormData(this),
		dataType:  'json',
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function () {
			$('#create_button').text('Processing...').prop('disabled', true)
		},
		success: function(r) {
			if(r.success){
				$("#room_name").val(null)
				$("#room_desc").val(null)
				toastr.success(r.message)
			} else {
				toastr.error(r.message)
			}
		},
		error: function(){
			
			
		},
		complete: function(){
			$('#create_button').text('Create room').prop('disabled', false)
		}
   });
}));
</script>
</body>
</html>