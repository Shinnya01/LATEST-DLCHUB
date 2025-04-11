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
<div class="p-4 mt-10 sm:ml-64 grid grid-cols-2 gap-4">


    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 h-auto flex flex-col gap-3">
            <div class="w-full flex justify-between items-center">
                <h1 class="text-3xl font-bold">My Rooms</h1> 
                <!-- CREATE ROOM -->
                <button data-modal-target="create-room" data-modal-toggle="create-room" type="button">
                    <i class="ri-add-box-line text-3xl"></i>
                </button>
            </div>
            <!-- CREATE ROOM MODAL -->
            <?php 
                require_once("layout/modals/create_room_modal.php")
            ?>
            
			<?php
			  $room_count = mysqli_query($db, "select COUNT(owner) as room_count from chat_room where owner = {$user["id"]}") or error("Can't get room data", $_HOME_FILE);
              $room = mysqli_fetch_array($room_count);
			?>

			    <p class="text-lg text-gray-500">Rooms: <?= $room['room_count'] ?></p>

            <div class="max-h-130 min-h-auto overflow-y-auto">
                    <?php					
                                $query = mysqli_query($db, "select * from chat_room where owner = {$user["id"]} ORDER BY created_time DESC") or error("Can't get room data", $_HOME_FILE);
                                
                                while($room = mysqli_fetch_array($query)):
                                ?>
                    <!-- ROOMS -->   
                        <div class="p-2 border-2 border-gray-200 border-b rounded-lg dark:border-gray-700 mt-10 ">
                              
                                    <div class="flex items-center justify-between">
                                        <p class="text-lg">Room name: <?= $room["room_name"] ?></p>
                                        <p>Created <?= format_time_ago(strtotime($room["created_time"])) ?></p>
                        
                                    </div>
                                    
                                    <p class="text-sm text-gray-500">Description: <?= !empty($room["room_description"]) ? $room["room_description"] : "null"; ?></p>
                               
                                <div class="mt-5">
                                    <a href="<?= $_CHAT_FILE ?>?room_id=<?= $room["room_id"] ?>" >
                                        <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600 cursor-pointer" type="button"><i class="ri-logout-box-r-line"></i> Enter Room
                                    </button>
                                </a>
                                
                                </div>

                   

                

                        <!-- END OF ROOMS -->
                    </div>
            
                    <?php endwhile; 
                     if(mysqli_num_rows($query) < 1){
                        echo "You haven't created / join a room yet!";
                    }
                    ?>
                    </div>
                    
    </div>

    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 h-auto flex flex-col gap-3">
            <div class="w-full flex justify-between items-center">
                <h1   h1 class="text-3xl font-bold">Room Joined</h1> 
                <!-- JOIN ROOM -->
                <button data-modal-target="join-room" data-modal-toggle="join-room" type="button">
                    <i class="ri-add-box-line text-3xl"></i>
                    </button>
            </div>
                <!-- JOIN ROOM MODAL -->
                <?php
                    require_once("layout/modals/join_room_modal.php")
                ?>
                    <?php					
                        $get_joined_room = mysqli_query($db, "select count(user_id) as total_joined_room from room_member where user_id = {$user["id"]}") or error("Can't get room data", $_HOME_FILE);
                        $joined_room = mysqli_fetch_array($get_joined_room);
                    ?>
                        <p class="text-lg text-gray-500">Rooms: <?= $joined_room['total_joined_room'] ?></p>

                        
                    
            <div class="max-h-130 min-h-auto overflow-y-auto">
                
                        <?php 
                         $query = mysqli_query($db, "select * from room_member where user_id = {$user["id"]} ORDER BY join_date DESC") or error("Can't get room data", $_HOME_FILE);
                         while($mem = mysqli_fetch_array($query)):
                             $room_query = mysqli_query($db, "select * from chat_room where room_id = {$mem["room_id"]}") or error("Can't get room data", $_HOME_FILE);
                             $room = mysqli_fetch_array($room_query);
                        ?>
                        <!-- ROOMS -->
                                            

                        <div class="p-2 border-2 border-gray-200 border-b rounded-lg dark:border-gray-700 mt-10">
                            <div class="flex items-center justify-between">
                                <p class="text-lg">Room name: <?= !empty($room["room_name"]) ? $room["room_name"] : "null"; ?></p>
                                <p>Joined <?= format_time_ago(strtotime($mem["join_date"])) ?></p>
                            </div>
                                    <p class="text-sm text-gray-500">Description: <?= !empty($room["room_description"]) ? $room["room_description"] : "null"; ?></p>
                                    
                            <div class="mt-5">
                                <a href="<?= $_CHAT_FILE ?>?room_id=<?= $room["room_id"] ?>" >
                                        <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600 cursor-pointer" type="button"><i class="ri-logout-box-r-line"></i> Enter Room</button>
                                </a>
                            </div>
       
                        </div>

            </div>
                                <?php endwhile; ?>

    </div>


<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/toastr/toastr.min.js"></script>
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
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
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