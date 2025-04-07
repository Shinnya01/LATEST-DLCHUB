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
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
			 
			
        
    join room
         
    <form method="GET" action="<?= $_CHAT_FILE ?>" class="form-horizontal">
								<div class="form-group"><label class="col-sm-1 control-label">Join room id</label>
									<div class="col-sm-10"><input type="text" name="room_id" value="" class="form-control" autocomplete="off"></div>
								</div>
							</form>

                            <?php
							if(!empty($_SESSION["error_log"])){
								echo $_SESSION["error_log"];
								unset($_SESSION["error_log"]);
							}
							?>
        </div>

     

</div>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

  
<!-- Mainly scripts -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>

<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
</body>
</html>