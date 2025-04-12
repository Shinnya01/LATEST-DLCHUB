
<div  id="show-user-profile" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative  w-full max-w-4xl h-auto ">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <div class="flex flex-col items-between justify-center p-4 md:p-5 border-b rounded dark:border-gray-600 border-gray-200">
            

					<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
						<ul class="flex flex-wrap -mb-px">
							<li class="me-2">
								<a href="#profile-change"  
								onclick="setActive(this)" 
								class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 profie-link"  
								aria-current="page">Profile</a>
							</li>
							<li class="me-2">
								<a href="#password-change" 
								onclick="setActive(this)" 
								class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 profie-link" >Password</a>
							</li>
							<li class="me-2">
								<a href="#img-change" 
								onclick="setActive(this)" 
								class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 profie-link">Profile Picture</a>
							</li>

						</ul>
					</div>

					<hr class="text-white my-4">
				

					<div class=" max-h-110 overflow-y-hidden">                
							<!-- FOR USER INFO -->
						
								<form id="change_name" method="GET" action="chat.php">
									<div class="h-110 flex flex-col justify-between">
										<div class="grid gap-6 mb-6 md:grid-cols-2" id="profile-change">
									
											<div>
												<label for="Username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
												<input type="text" value="<?= $user["username"]; ?>" readonly id="userName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
											</div>

											<div>
												<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
												<input type="email" id="email" value="<?= $user["user_email"] ?>" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
											</div> 

											<div>
												<label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
												<input type="text" name="firstName" value="<?= $user["firstName"]; ?>"  id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
											</div>

											<div>
												<label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
												<input type="text" value="<?= $user["lastName"]; ?>" name="lastName" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
											</div>
											

											<!-- IF USER -->
												<?php if(!$isAdmin): ?>
												<!-- BDAY INPUT -->
												<div>
													<label for="student-section" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Day</label>
													<div class="relative max-w-full">
														<div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
															<svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
																<path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
															</svg>
														</div>
														<input id="datepicker-orientation" datepicker datepicker-orientation="upper right" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
													</div>
												</div>

												<!-- RELIGION INPUT -->
												<div>
													<label for="student-section" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Religion</label>
												
													<select name="religion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
														<option disabled selected>Please choose </option>
														<option value="catholic">Catholic</option>
													</select>
												</div>

												<!-- PROGRAM INPUT -->
												<div>
													<label for="program" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Program</label>
													<select name="program" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
														<option disabled selected>Please choose </option>
														<option value="Information Technology">IT</option>
													</select>
												</div>

												<div class="grid grid-cols-2 gap-2">

													<!-- YEAR INPUT -->
													<div>
														<label for="student-year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
														<input type="text" id="student-year" name="student-year" value="<?= !empty($user["year"]) ? $user["year"] : "null"; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""  />
													</div>

													<!-- SECTION INPUT -->
													<div>
														<label for="student-section" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>
														<input type="text" id="student-section" name="student-section" value="<?= !empty($user["section"]) ? $user["section"] : "null"; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""  /> 
													</div>

												</div>
												
												<?php endif; ?>

											

										</div>		
										
											<div class="flex justify-end items-center gap-2 col-span-2">
												<button type="submit" id="cgnbtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Change user info</button>
												<button type="button" onclick="location.reload()" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full w-full sm:w-auto text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancel</button>
											</div>
									</div>
								</form>

							<!-- FOR PASSWORD -->
							<form id="change_password" method="GET" action="chat.php">
								<div class="h-110 flex flex-col justify-between" id="password-change">
									

										<div>
											<div>
												<label for="current-pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
												<input type="password" name="cr_password" value="<?= $user["password"] ?>" autocomplete="off" id="current-pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""  />
											</div>			

											<div>
												<label for="new-pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
												<input type="password" name="nw_password" autocomplete="off" id="new-pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""  />
											</div>		
										</div>
												

											<div class="flex justify-end items-center gap-2 col-span-2">
												<button type="submit" id="cgpbtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Change Password</button>
												<button type="button" onclick="location.reload()" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full w-full sm:w-auto text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancel</button>
											</div>
								
									
								</div>
							</form>

			
							<!-- FOR IMAGE -->
							<form id="change_picture" method="GET" action="chat.php" enctype="multipart/form-data">
										
										<div class="flex flex-col justify-between h-110" id="img-change">

													<div class="flex flex-col items-center gap-4">

														<label for="profile-pic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile Picture</label>
														<img src="<?= $profilePicture?>" id="profile-pic" class="rounded-full h-50 w-50 bg-white" alt="">

														<!-- FOR INSERT IMAGE -->
														<!-- <div class="mt-6">
															<label for="upload-new-img" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Upload New Image</label>
															<input type="file" name="profile_picture" id="upload-new-img" class="hidden">
														</div> -->


														<!-- FOR INSERT IMAGE URL -->
														<div >
															<input type="text" name="profile_picture" value="<?= $user["profilePicture"] ?>" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""  />
														</div>	
													</div>

													<div class="flex justify-end items-center gap-2 col-span-2">
														<button type="submit" id="cppbtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Change Profile</button>
														<button type="button" onclick="location.reload()" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full w-full sm:w-auto text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancel</button>
													</div>
												
										</div>

							</form>
					</div>


            </div>
        </div>
    </div>
</div>


<!-- CHANGE COLOR -->
 <script>
	function setActive(clickedLink) {
        // Get all links
        const links = document.querySelectorAll('.profie-link');

        // Loop through all links and reset their classes
        links.forEach(link => {
            link.className = 'inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 profie-link';
        });

        // Set the clicked link to active
        clickedLink.className = 'inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 profie-link';
    }
 </script>
