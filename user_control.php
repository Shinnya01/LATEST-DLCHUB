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

    
            <!-- USER CONTROL-->
            <div id="user_control" class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 h-160 mt-10 flex flex-col">  
                <p class="text-3xl">User control</p>
                <!-- USER -->
                <div class="max-h-150 overflow-y-auto mt-10">
                            <?php $query = mysqli_query($db, "select * from user WHERE NOT id ={$user["id"]}") or error("Can't get room data");
                            
                            while($_user = mysqli_fetch_array($query)):
                            $ban_check = mysqli_query($db, "select * from ban_list where user_id = {$_user["id"]}");

                            $fullName = $_user["firstName"] . " " . $_user["lastName"];
                            ?>

                            <div class="p-2 border-2 border-gray-200 border-b rounded-lg dark:border-gray-700 mt-5 flex flex-col gap-4" id="user-id-<?= $_user["id"] ?>">

                                <div class="grid grid-cols-2 items-center">
                                    <p class="text-lg">Name: <?= $fullName ?></p>
                                    <p class="text-right">Created <?= format_time_ago(strtotime($_user["joinned_time"])) ?></p>
                                    <p>User ID: <?= $_user["id"] ?></p>
                                </div>
                                
                                <hr>

                                    <div class="flex justify-between items-center">
                                        
                                        <div>
                                            <button class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" 
                                            onclick="delete_user(<?= $_user["id"] ?>)" >
                                            <i class="ri-delete-bin-line"></i> Delete User</button>
                                        <button 
                                                id="ban-user-id-<?= $_user["id"] ?>"
                                                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900"
                                                <?php if(mysqli_num_rows($ban_check) > 0) echo 'style="display: none;"'; ?>  
                                                onclick="ban_user(<?= $_user["id"] ?>)" >
                                                <i class="ri-prohibited-2-line"></i>Ban User
                                            </button>

                                        <button 
                                                id="unban-user-id-<?= $_user["id"] ?>" 
                                                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900"
                                                <?php if(mysqli_num_rows($ban_check) < 1) echo 'style="display: none;"'; ?>  
                                                onclick="unban_user(<?= $_user["id"] ?>)">
                                                <i class="ri-checkbox-circle-line"></i>Unban User
                                            </button>

                                        <button 
                                                id="promote-admin-id-<?= $_user["id"] ?>" 
                                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                                <?php if($_user["admin"] == 1) echo 'style="display: none;"'; ?>
                                                onclick="promote_user(<?= $_user["id"] ?>)" >
                                                <i class="ri-corner-right-up-line"></i>Promote to admin
                                            </button>

                                        <button 
                                                id="unpromote-admin-id-<?= $_user["id"] ?>" 
                                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                                <?php if($_user["admin"] == 0) echo 'style="display: none;"'; ?> 
                                                onclick="unpromote_user(<?= $_user["id"] ?>)">
                                                <i class="ri-corner-right-down-line"></i>Unpromote to admin
                                            </button>
                                        </div>
                                        
                                        <button
                                            data-modal-target="edit-user-profile<?=$_user["id"] ?>" data-modal-toggle="edit-user-profile<?=$_user["id"] ?>"
                                            type="button" 
                                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Edit Profile
                                            </button>

                                        
                                    </div>
                                    <?php require("layout/modals/edit_profile_modal.php") ?>
                                

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