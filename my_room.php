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
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 h-auto flex flex-col gap-4">
            <h1 class="text-3xl font-bold">My Rooms</h1> 
			<?php
			$totalRoomsQuery = mysqli_query($db, "SELECT COUNT(room_id) as total_rooms FROM room_member WHERE user_id = {$user['id']}") or error("Can't get total rooms count", $_HOME_FILE);
			$totalRooms = mysqli_fetch_assoc($totalRoomsQuery);
			?>
			<p class="text-lg text-gray-500">Rooms: <?= $totalRooms['total_rooms'] ?></p>

        <div class="max-h-210 min-h-auto overflow-y-auto">
                    <?php					
                                $query = mysqli_query($db, "select * from chat_room where owner = {$user["id"]}") or error("Can't get room data", $_HOME_FILE);
                                
                                while($room = mysqli_fetch_array($query)):
                                ?>
                    
                    <div class="mt-5">
                        <!-- ROOMS -->
                        <div class="p-2 border-2 border-gray-200 border-b rounded-lg dark:border-gray-700 mt-5 ">
                                <div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-lg"><?= $room["room_name"] ?></p>
                        
                                    </div>
                                    
                                    <p class="text-sm text-gray-500">Description: <?= !empty($room["room_description"]) ? $room["room_description"] : "null"; ?></p>
                                </div>
                                <div class="mt-10">
                                    <a href="<?= $_CHAT_FILE ?>?room_id=<?= $room["room_id"] ?>" >
                                        <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600 cursor-pointer" type="button"><i class="ri-logout-box-r-line"></i> Enter Room
                                    </button>
                                </a>
                                
                                </div>
                            


                        </div>

                

                        <!-- END OF ROOMS -->
                    </div>
            
                    <?php endwhile; 
                    ?>
                    </div>
                    <?php 
                                if(mysqli_num_rows($query) < 1){
                                    echo "You haven't created / join a room yet!";
                                }
                                
                                ?>
                </div>

                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                    <h1 class="text-3xl font-bold">Room Joined</h1> 
                    <?php
                                if($_GET['room_joined'] == null)
                                        $_GET['room_joined'] = 1;
                                if($_GET['room_joined'] >= 2)
                                    $room_joined = ($_GET['room_joined'] - 1) * 5;
                                else
                                    $room_joined = 0;
                                                        
                                $query = mysqli_query($db, "select * from room_member where user_id = {$user["id"]} ORDER BY join_date DESC LIMIT 5 OFFSET {$room_joined}") or error("Can't get member data", $_HOME_FILE);
                                
                                while($mem = mysqli_fetch_array($query)):
                                $room_query = mysqli_query($db, "select * from chat_room where room_id = {$mem["room_id"]}") or error("Can't get room data", $_HOME_FILE);
                                
                                $room = mysqli_fetch_array($room_query);
                                ?>

                    <p class="text-lg text-gray-500">Rooms: <?= $totalRooms['total_rooms'] ?></p>		 
                    
                    <div class="overflow-y-auto max-h-130 min-h-auto mt-5">
                        <!-- ROOMS -->
                        <div class="p-2 border-2 border-gray-200 border-b rounded-lg dark:border-gray-700 mt-14">
                                <div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-lg"><?= $room["room_name"] ?></p>
                        
                                    </div>
                                    
                                    <small class="text-muted"><?= $room["room_name"] ?> (joined <?= format_time_ago(strtotime($mem["join_date"])) ?>)</small>
                                </div>
                                <div class="mt-10">
                                    <a href="<?= $_CHAT_FILE ?>?room_id=<?= $room["room_id"] ?>" >
                                        <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600 cursor-pointer" type="button"><i class="ri-logout-box-r-line"></i> Enter Room
                                    </button>
                                </a>
                                
                                </div>
                                <?php endwhile; 
                                if(mysqli_num_rows($query) < 1){
                                    echo "You haven't created / join a room yet!";
                                }
                                
                                ?>


                        </div>

                

                        <!-- END OF ROOMS -->
                    </div>

                </div>

        </div>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>