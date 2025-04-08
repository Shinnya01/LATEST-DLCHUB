<div id="setting-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
				<div class="relative p-4 w-full max-w-4xl max-h-2xl">
					<!-- Modal content -->
					<div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
						<!-- Modal header -->
						<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
								Settings
							</h3>
							<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="setting-modal">
								<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
								</svg>
								<span class="sr-only">Close modal</span>
							</button>
						</div>
						<!-- Modal body -->
						<div class="p-4 md:p-5 space-y-4 flex w-full ">
							
				
										<ul class="w-[40%] bg-red-100">
											<li>
												<a href="#member_request">Member Request</a>
											</li>
											<li>
												<a href="#room_option">Room Option</a>
											</li>
											<li>
												<a href="#members">Members</a>
											</li>
										</ul>
						
							<div class="w-full h-120 overflow-y-hidden">
								<!-- ROOM REQUEST MANAGEMENT -->
								<section class="bg-green-100 h-120" id="member_request">
												<?php
														$query = mysqli_query($db, "select * from request_join where room_id={$room_data["room_id"]}") or error("Can't get request join", $_HOME_FILE);
														
														while($req = mysqli_fetch_array($query)):
														$_user = searchUser_bId($db, $req["user_id"]);
														if(!empty($_user)):
														?>
												<div class="social-feed-box" id="request-user-<?= $req["user_id"] ?>">
												<div class="social-avatar">
													<small class="text-muted"><?= $req["time"] ?></small>
												</div>
												<div class="social-body">
													<strong><?= $_user["firstName"] . " " . $_user["lastName"]; ?></strong> sent a request to join the chat room.
												<p></p><hr><p></p>
												<div class="file-option">
													<button class="btn btn-primary btn-rounded btn-sm" onclick="approve_request(<?= $req["user_id"] ?>, <?=  $req["room_id"] ?>)"><i class="fa fa-check"></i> Accept request</button>
													<button class="btn btn-danger btn-rounded btn-sm" onclick="reject_request(<?= $req["user_id"] ?>, <?=  $req["room_id"] ?>)"><i class="fa fa-times"></i> Reject request</button>
												</div>
														</div>
												</div>
											<?php 
											endif;
											endwhile;
											
											if(mysqli_num_rows($query) < 1){
												echo "No requests need approval!";
											}
											?>

								</section>		
								<!-- ROOM OPTION -->
								<section class="bg-gray-100 h-120" id="room_option">
															<div class="wrapper wrapper-content animated fadeIn">
										<div class="row">
											<div class="col-lg-12">
												<div class="ibox float-e-margins">
													<div class="ibox-title">
														<h5>Change room name & description</h5>
													</div>
													<div class="ibox-content">
														<form id="change_name_description" method="GET" action="chat.php" class="form-horizontal">
															<div class="form-group"><label class="col-sm-1 control-label">Room name: </label>
																<div class="col-sm-10"><input type="text" name="room_name" value="<?= $room_data["room_name"] ?>" class="form-control" autocomplete="off"></div>
															</div>
															
															<div class="form-group"><label class="col-sm-1 control-label">Room description: </label>
																<div class="col-sm-10"><input type="text" name="room_desc" value="<?= $room_data["room_description"] ?>" class="form-control" autocomplete="off"></div>
															</div>
															
															<div class="form-group">
																<div class="col-sm-4 col-sm-offset-1">
																	<button id="crndbtn" class="btn btn-primary" name="submit" type="submit">Change</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</section >
                                <!-- MEMBERS -->
                                <section class="bg-blue-100 h-120" id="members">
                                
                                            <?php

                                             $query = mysqli_query($db, "select cr.*, u.* from chat_room cr JOIN user u ON cr.owner = u.user_id WHERE cr.room_id = $room_id") or error("Can't get room data", $_HOME_FILE);
                                                while($mem = mysqli_fetch_array($query)):
                                                    
                                            ?>
                                            <p>Room Owner: <?= $mem["owner"] ?></p>
                                            <p>Room Members:</p>
                                            <?php

                                              
                                            
                                                // $get_all_mem = mysqli_query($db, "select * from room_member where room_id ={$mem["room_id"]}");
                                                // while($members = mysqli_fetch_array($get_all_mem)):

                                                
                                                

                                                // $room_query = mysqli_query($db, "select * from chat_room where room_id = {$mem["room_id"]}") or error("Can't get room data", $_HOME_FILE);
                                                // $room = mysqli_fetch_array($room_query);
                                            ?>


                                            <p> <?= $members["user_id"] ?></p>



                                            <?php
                                    // endwhile;
                                        endwhile; 
                                        ?>

<?php

// Fetch the chat room details along with the owner's information
// $query = mysqli_query($db, "
//     SELECT cr.*, u.firstName, u.lastName 
//     FROM chat_room cr
//     JOIN user u ON cr.owner = u.id 
//     WHERE cr.room_id = $room_id
// ") or error("Can't get room data", $_HOME_FILE);

// // Check if the room exists
// if ($mem = mysqli_fetch_array($query)) {
//     $fullName = $mem["firstName"] . ' ' . $mem["lastName"];
//     ?>
<!-- //     <p>Room Owner:<?= $fullName ?></p>
//     <p>Room Members:</p> -->
   <?php

//     // Fetch all members of the room
//     $get_all_mem = mysqli_query($db, "SELECT * FROM room_member WHERE room_id = {$mem["room_id"]}");
//     while ($members = mysqli_fetch_array($get_all_mem)) {
//         // Fetch user details for each member
//         $user_query = mysqli_query($db, "SELECT * FROM user WHERE id = {$members["user_id"]}") or error("Can't get user data", $_HOME_FILE);
//         if ($user = mysqli_fetch_array($user_query)) {
//             $memberFullName = $user["firstName"] . ' ' . $user["lastName"];
//             ?>
//             <p><?= $memberFullName ?></p>
//             <?php
//         }
//     }
// } else {
//     echo "<p>No room found.</p>";
// }
?>

                                </section>
								</div>
					
						</div>
						<!-- Modal footer -->
						<div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
							<button data-modal-hide="setting-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
							<button data-modal-hide="setting-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
						</div>
					</div>
				</div>
			</div>
