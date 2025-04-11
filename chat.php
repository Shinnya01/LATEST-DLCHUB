<html>
<?php
require("config/db.php");
require("layout/head.php");


?>
<body>
    <?php 
    require("layout/navtop.php");
     require("layout/sidebar.php");
     
     if(!empty($_GET["room_id"])){
      $room_id = $_GET["room_id"];
      $user = searchUser_bSession($db, $_COOKIE["user_session"]);
      
      $query = mysqli_query($db, "select * from chat_room where room_id=$room_id") or error("Room id doesn't exist", $_HOME_FILE); //$_HOME_FILE --> /config/value.php
      if(mysqli_num_rows($query) > 0){
        //$_SESSION["current_room_id"] = $room_id;
        $room_data = mysqli_fetch_array($query) or error("Can't get room data", $_HOME_FILE);
        
        
        $isMember = false;  $isMember = false;
        $mem_query = mysqli_query($db, "select * from room_member where user_id={$user["id"]} and room_id=$room_id");
        if($user["id"] == $room_data["owner"]){
          $isOwner = true;
          $isMember = true;
        } elseif(mysqli_num_rows($mem_query) > 0){
          $isMember = true;
        }
              
      } else {
        error("Room id doesn't exist", $_HOME_FILE);
      }
    }?>


    <div class="p-4 mt-10 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-10">
        <?php
          $userName = $user["firstName"] . " " . $user["lastName"]; /* ---> */
        
          ?>
          <!-- ROOM NAME AND CHAT SETTINGS -->
          <div>
            <div class="flex items-center justify-between">
              <p class="text-2xl">Room name: <?= $room_data["room_name"] ?></p>
              <button type="button" class="ri-chat-settings-line text-3xl" aria-controls="dropdown-chat-setting" data-dropdown-toggle="dropdown-chat-setting"></button>
          </div>
		  <div id="dropdown-chat-setting" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
			<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
			<li>
				<a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-target="setting-modal" data-modal-toggle="setting-modal">Setting</a>
			</li>

			<li>
				<a href="my_room.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"  onclick="delete_room(<?= $room["room_id"] ?>)">Leave</a>
			</li>
			</ul>
		</div>


		<!-- MODAL -->

            <!-- SETTING MODAL -->
			<?php require_once("layout/modals/setting_modal.php") ?>

		<!-- END MODALS -->
            <p class="text-lg">room ID: <?= $room_id ?></p>
          </div>

		  <?php if($isMember == true): ?>
          <!-- CHAT AREA -->
           
          <div class="w-full h-120 bg-white border border-black overflow-y-auto p-5 flex flex-col gap-5 chat-discussion">

            <!-- CHAT RIGHT -->

		

          </div>
          <form id="send-message">
		  <div class="flex items-center px-3 py-2 rounded-es-lg bg-gray-50 dark:bg-gray-700">
		  <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                    <path fill="currentColor" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
                </svg>
                <span class="sr-only">Upload image</span>
            </button>
		  <button type="button" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z"/>
                </svg>
                <span class="sr-only">Add emoji</span>
            </button>
			<textarea style="resize: none;" class="form-control message-input resize-none block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="txt-message" name="txt-message" placeholder="Enter message text"></textarea>
			<button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
				<svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                </svg>
				<span class="sr-only">Send message</span>
			</button>
		</form>

</div>

    </div>

	<?php else: ?>

		<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					Request to Join
				</div>
				<div class="ibox-content">
				<?php 
				$query = mysqli_query($db, "select * from request_join where user_id={$user["id"]} and room_id=$room_id");
				?>
						<center>You are not a member of this room</center>
					<?php if(mysqli_num_rows($query) == 0): ?>
					<center><button id="request_join" class="btn btn-primary">Request to Join</button></center>
					<?php else: ?>
					<center><button id="request_join" class="btn btn-primary" disabled>Pending Approval...</button></center>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>


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
<!-- CHATS -->
<script>
	var logChat = "";

	Array.prototype.diff = function(a) {
		var me = this;
		
		for(let i = 0; i < me.length; i++){
			for(let j = 0; j < a.length; j++){
				if(a[j].id.indexOf(me[i].id) > -1){
					a.splice(j, 1)
				}
			}
		}
		
		return a;
	};

	<?php if($isMember == true): ?>
	$(document).ready(function(){
	var intercal = setInterval(function()
	{
		$.ajax({
			url: 'ajax/message/fetch_message.php?room_id=<?= $room_id ?>',
			dataType:  'json',
			contentType: false,
			cache: false,
			processData:false,
			success: function(r){
				if(JSON.stringify(r) != logChat){
					if(r.error != null){
						if(r.error){
							alert(r.message)
							location.reload();
							clearInterval(intercal);
						}
					}
					
					var chat_temp = "";
					r.forEach(function(m){
					if(m.owner){
						//right messages
						//   var temp = '<div class="chat-message right flex flex-row-reverse gap-2.5">' +
						// 	'<img class="message-avatar w-8 h-8 rounded-full" src="${profilePicture}" alt="">' +
						// 	'<div class="message">' +
						// 		'<a class="message-author text-sm font-semibold text-gray-900 dark:text-white" href="#"> ${name} </a>' +
						// 		'<span class="message-date text-sm font-normal text-gray-500 dark:text-gray-400"> ${time} </span>' +
						// 		'<span class="message-content">' +
						// 		'${message}' +
						// 		'</span>' +
						// 	'</div>' +
						// '</div>';


						var temp= '<div class="flex flex-row-reverse flex-start gap-2.5">' +
							' <div class="flex flex-col gap-1 w-full  max-w-[320px]">' +
							' <div class="flex flex-row-reverse items-center gap-2.5">' +
							
							' <a class="message-author text-base font-semibold text-gray-900 mr-12" href="#">${name}</a>' +
							
							' </div>' +
							'  <div class="flex flex-row-reverse items-end gap-2.5">' +
								' <img class="w-8 h-8 rounded-full" src="${profilePicture}" alt="">' +
								' <div class="flex flex-col leading-1.5 p-2 gap-4 border-gray-200 bg-gray-100 rounded-xl dark:bg-gray-700 min-h-auto max-h-40">' +
									' <span class="text-sm font-normal text-gray-900 dark:text-white message-content"> ${message}</span>' +
									' <span class= "message-date text-sm font-normal text-gray-500  text-right">${time}</span>' +
								' </div>' +
							' </div>' +
						' </div>' +
					' </div>' ;

						
						chat_temp += temp.replace("${profilePicture}", m.profilePicture).replace("${name}", m.sender).replace("${message}", m.message).replace("${time}", m.time_ago)
					} else {
						//left messages
						//   var temp = '<div class="chat-message left">' +
						// 	'<img class="message-avatar" src="${profilePicture}" alt="">' +
						// 	'<div class="message">' +
						// 		'<a class="message-author" href="#"> ${name} </a>' +
						// 		'<span class="message-date"> ${time} </span>' +
						// 		'<span class="message-content">' +
						// 		'${message}' +
						// 		'</span>' +
						// 	'</div>' +
						// '</div>';
						
						var temp= '<div class="flex flex-row flex-start gap-2.5">' +
							' <div class="flex flex-col gap-1 w-full  max-w-[320px]">' +
							' <div class="flex flex-row items-center gap-2.5">' +
							
							' <a class="message-author text-base font-semibold text-gray-900 ml-12" href="#">${name}</a>' +
							
							' </div>' +
							'  <div class="flex flex-ro items-end gap-2.5">' +
								' <img class="w-8 h-8 rounded-full" src="${profilePicture}" alt="">' +
								' <div class="flex flex-col leading-1.5 p-2 gap-4 border-gray-200 bg-gray-100 rounded-xl dark:bg-gray-700 min-h-auto max-h-40">' +
									' <span class="text-sm font-normal text-gray-900 dark:text-white message-content"> ${message}</span>' +
									' <span class= "message-date text-sm font-normal text-gray-500  text-right">${time}</span>' +
								' </div>' +
							' </div>' +
						' </div>' +
					' </div>' ;


						chat_temp += temp.replace("${profilePicture}", m.profilePicture).replace("${name}", m.sender).replace("${message}", m.message).replace("${time}", m.time_ago)
					}
					});
					
					$('.chat-discussion').html(chat_temp)
					var d = $('.chat-discussion');
					d.scrollTop(d.prop("scrollHeight"));
				}
				
				logChat = JSON.stringify(r); 
			}
		});

	},1000);
	});

	$('#txt-message').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			$("#send-message").submit()
		}
	});
	<?php endif; ?>

	$("#request_join").on('click',(function(e) {
		$.ajax({
			url: "ajax/request/join_room.php",
			type: "POST",
			data: {
				room_id: "<?= $room_id ?>"
			},
			dataType:  'json',
			beforeSend: function () {
				$('#request_join').text("Requesting...").prop('disabled', true)
			},
			success: function(r) {
				if(r.success){
					$('#request_join').text("Pending approve...").prop('disabled', true)
				} else {
					$('#request_join').text("Request join").prop('disabled', false)
				}
			},
			error: function(){
				$('#request_join').text("Request join").prop('disabled', false)
			},
			complete: function(){
				
			}
	});
	}));

	$("#send-message").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "ajax/message/send.php?room_id=<?= $room_id ?>",
			type: "POST",
			data:  new FormData(this),
			dataType:  'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$('#txt-message').prop('disabled', true)
			},
			success: function(data) {
				
			},
			error: function(){
				//... error event
			},
			complete: function(){
				$('#txt-message').prop('disabled', false).focus().val(null)
			}
	});
	}));
</script>


<!-- REQUEST MANAGEMENT -->
<script>
	function approve_request(user_id, room_id){
		$.ajax({
			url: "ajax/request/request_action.php?do=approve",
			type: "POST",
			data: {
				user_id: user_id,
				room_id: room_id
			},
			dataType:  'json',
			beforeSend: function () {
				
			},
			success: function(r) {
				if(r.success){
					$("#request-user-" + user_id).remove()
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

	function reject_request(user_id, room_id){
		$.ajax({
			url: "ajax/request/request_action.php?do=reject",
			type: "POST",
			data: {
				user_id: user_id,
				room_id: room_id
			},
			dataType:  'json',
			beforeSend: function () {
				
			},
			success: function(r) {
				if(r.success){
					$("#request-user-" + user_id).remove()
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
</script>
</body>
</html>