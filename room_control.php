<html>
<?php
require("config/db.php");
require("layout/head.php");


?>
<body>
    <?php require("layout/navtop.php");
    $adminArea = "active"; ?>
   
    
    <?php require("layout/admin_sidebar.php")?>


    <div class="p-4 mt-10 sm:ml-64 gap-4 h-180 overflow-y-hidden">

    <!-- ROOM CONTROL -->
        <div  class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 h-165 mt-10 flex flex-col ">  
            <p class="text-3xl">room control</p>


            
            <div class="max-h-150 min-h-auto overflow-y-auto mt-10">
                <!-- ROOM -->
                <?php 
                $query = mysqli_query($db, "select * from chat_room ORDER BY created_time DESC") or error("Can't get room data", $_HOME_FILE);
                            
                while($room = mysqli_fetch_array($query)):
                ?>
                <div class="p-2 py-3 border-2 border-gray-200 border-b rounded-lg dark:border-gray-700 mt-5 flex flex-col gap-4" id="room-<?= $room["room_id"] ?>">
                        <div  class="grid grid-cols-2 items-center">
                            <p class="text-lg">Room name: <?= $room["room_name"] ?></p>
                            <p class="text-right">Created <?= format_time_ago(strtotime($room["created_time"])) ?></p>
                            <p class="text-sm text-gray-500">Description: <?= !empty($room["room_description"]) ? $room["room_description"] : "null"; ?></p>
                        </div>
                            
                    
                        <div>
                                    <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600 cursor-pointer" onclick="delete_room(<?= $room["room_id"] ?>)"> <i class="ri-delete-bin-line"></i> Delete Room
                                    </button>
                        </div>
                   
                    </div>
            <?php endwhile; ?>
                
            </div>
            
            </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>


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

    function delete_room(room_id){
        var c = confirm("Are you sure? Press OK if you wanna delete this room!");
        if (c == true) {
            $.ajax({
                url: "ajax/request/admin/delete_room.php",
                type: "POST",
                data: {
                    room_id: room_id
                },
                dataType:  'json',
                beforeSend: function () {
                    
                },
                success: function(r) {
                    if(r.success){
                        $("#room-" + room_id).remove()
                        toastr.success(r.message)
                    } else {
                        toastr.error(r.message)
                    }
                },
                error: function(){
                    toastr.error("Unkown error?!")
                },
                complete: function(){
                    
                }
        });
        }
        }
    </script>
</body>
</html>