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
            <!-- USER CONTROL-->
            <div id="user_control" class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 h-160 mt-10 flex flex-col gap-8">  
                <p class="text-3xl">User control</p>
                <!-- USER -->
                <div class=" h-150 overflow-y-auto flex flex-col gap-4">
                            <?php $query = mysqli_query($db, "select * from user ") or error("Can't get room data");
                            
                            while($_user = mysqli_fetch_array($query)):
                            $ban_check = mysqli_query($db, "select * from ban_list where user_id = {$_user["id"]}");

                            $fullName = $_user["firstName"] . " " . $_user["lastName"];
                            ?>

                            <div class="p-2 border-2 border-gray-200 border-b rounded-lg dark:border-gray-700 mt-10" id="user-id-<?= $_user["id"] ?>">

                                <div class="grid grid-cols-2 items-center">
                                    <p class="text-lg">Name: <?= $fullName ?></p>
                                    <p class="text-right">Created <?= format_time_ago(strtotime($_user["joinned_time"])) ?></p>
                                    <p>User ID: <?= $_user["id"] ?></p>
                                </div>

                                <hr>

                                    <div>
                                        <button onclick="delete_user(<?= $_user["id"] ?>)" ><i class="ri-delete-bin-line"></i> Delete User</button>
                                        <button 
                                                id="ban-user-id-<?= $_user["id"] ?>" 
                                                <?php if(mysqli_num_rows($ban_check) > 0) echo 'style="display: none;"'; ?>  
                                                onclick="ban_user(<?= $_user["id"] ?>)" >
                                                <i class="ri-prohibited-2-line"></i>Ban User
                                            </button>

                                        <button 
                                                id="unban-user-id-<?= $_user["id"] ?>" 
                                                <?php if(mysqli_num_rows($ban_check) < 1) echo 'style="display: none;"'; ?>  
                                                onclick="unban_user(<?= $_user["id"] ?>)">
                                                <i class="ri-checkbox-circle-line"></i>Unban User
                                            </button>

                                        <button 
                                                id="promote-admin-id-<?= $_user["id"] ?>" 
                                                <?php if($_user["admin"] == 1) echo 'style="display: none;"'; ?>
                                                onclick="promote_user(<?= $_user["id"] ?>)" >
                                                <i class="ri-corner-right-up-line"></i>Promote to admin
                                            </button>

                                        <button 
                                                id="unpromote-admin-id-<?= $_user["id"] ?>" 
                                                <?php if($_user["admin"] == 0) echo 'style="display: none;"'; ?> 
                                                onclick="unpromote_user(<?= $_user["id"] ?>)">
                                                <i class="ri-corner-right-down-line"></i>Unpromote to admin
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

    //delete user
    function delete_user(user_id){
        var c = confirm("Are you sure? Press OK if you wanna delete this user!");
        if (c == true) {
            $.ajax({
                url: "ajax/request/admin/delete_user.php",
                type: "POST",
                data: {
                    user_id: user_id
                },
                dataType:  'json',
                beforeSend: function () {
                    
                },
                success: function(r) {
                    if(r.success){
                        $("#user-id-" + user_id).remove()
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

    //ban user
    function ban_user(user_id){
        var reason;
        var input = prompt("Reason you ban this user:", "Violation of rules");
        reason = input;
        
        if (reason != null && reason != "") {
        $.ajax({
                url: "ajax/request/admin/ban_user.php",
                type: "POST",
                data: {
                    user_id: user_id,
                    reason: reason
                },
                dataType:  'json',
                beforeSend: function () {
                    
                },
                success: function(r) {
                    if(r.success){
                        $("#ban-user-id-" + user_id).hide()
                        $("#unban-user-id-" + user_id).show()
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

    //un ban user
    function unban_user(user_id){
        var c = confirm("Are you sure? Press OK if you wanna do this");
        
        if (c == true) {
        $.ajax({
                url: "ajax/request/admin/unban_user.php",
                type: "POST",
                data: {
                    user_id: user_id
                },
                dataType:  'json',
                beforeSend: function () {
                    
                },
                success: function(r) {
                    if(r.success){
                        $("#ban-user-id-" + user_id).show()
                        $("#unban-user-id-" + user_id).hide()
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

    function promote_user(user_id){
        var c = confirm("Are you sure? Press OK if you wanna do this");
        
        if (c == true) {
        $.ajax({
                url: "ajax/request/admin/promote_user.php",
                type: "POST",
                data: {
                    user_id: user_id,
                    role: 1
                },
                dataType:  'json',
                beforeSend: function () {
                    
                },
                success: function(r) {
                    if(r.success){
                        $("#promote-admin-id-" + user_id).hide()
                        $("#unpromote-admin-id-" + user_id).show()
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

    function unpromote_user(user_id){
        var c = confirm("Are you sure? Press OK if you wanna do this");
        
        if (c == true) {
        $.ajax({
                url: "ajax/request/admin/promote_user.php",
                type: "POST",
                data: {
                    user_id: user_id,
                    role: 0
                },
                dataType:  'json',
                beforeSend: function () {
                    
                },
                success: function(r) {
                    if(r.success){
                        $("#promote-admin-id-" + user_id).show()
                        $("#unpromote-admin-id-" + user_id).hide()
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