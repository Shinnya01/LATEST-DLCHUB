
<div  id="show-user-profile" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative  w-full max-w-4xl h-auto ">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <div class="flex flex-col items-between justify-center p-4 md:p-5 border-b rounded dark:border-gray-600 border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    User Profile
                </h3>
                <hr class="text-white my-5">
            <form>

                

                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                        <input type="text" value="<?= $user["firstName"]; ?>" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
                    </div>
                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                        <input type="text" value="<?= $user["lastName"]; ?>" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
                    </div>

                    <div>
                        <label for="Username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" value="<?= $user["username"]; ?>" disabled id="userName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                        <input type="email" id="email" value="<?= $user["user_email"] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
                    </div> 
                    <!-- IF NOT ADMIN -->
                  <?php if(!$isAdmin): ?>  
                    <div>
                        <label for="program" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Program</label>
                        <input type="text" id="program" value="<?= $user["program"] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="flowbite.com" required />
                    </div>

                    <div class="grid grid-cols-2 gap-2">

                        <div>
                            <label for="visitors" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                            <input type="number" id="visitors" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required />
                        </div>
                        
                        <div>
                            <label for="visitors" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>
                            <input type="number" id="visitors" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required /> 
                        </div>
                       
                    </div>
                    <?php endif; ?>
                </div>
  
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="password" value="<?= $user["password"] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
                </div> 
                <div class="mb-6">
                    <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                    <input type="password" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
                </div> 
                <div class="flex justify-end">
                    <button type="submit" id="change-info" class="self-end text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Change</button>
                    <button type="button" id="cancel-changes" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div >
</div>

<script>
	$("#change_picture").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "ajax/request/account/change_picture.php",
			type: "POST",
			data:  new FormData(this),
			dataType:  'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$('#cppbtn').text('Processing...').prop('disabled', true)
			},
			success: function(r) {
				if(r.success){
					toastr.success(r.message)
				} else {
					toastr.error(r.message)
				}
			},
			error: function(){
				
				
			},
			complete: function(){
				$('#cppbtn').text('Change').prop('disabled', false)
			}
	});
	}));

	$("#change_password").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "ajax/request/account/change_password.php",
			type: "POST",
			data:  new FormData(this),
			dataType:  'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$('#cgpbtn').text('Processing...').prop('disabled', true)
			},
			success: function(r) {
				if(r.success){
					toastr.success(r.message)
					setTimeout(function() {
                        location.reload();
                    }, 3000);
			
				} else {
					toastr.error(r.message)
				}
			},
			error: function(){
				
				
			},
			complete: function(){
				$('#cgpbtn').text('Change').prop('disabled', false)
			}
	});
	}));

	$("#change_name").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "ajax/request/account/change_name.php",
			type: "POST",
			data:  new FormData(this),
			dataType:  'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$('#cgnbtn').text('Processing...').prop('disabled', true)
			},
			success: function(r) {
				if(r.success){
					toastr.success(r.message)
					
					setTimeout(function() {
                        location.reload();
                    }, 3000);
				} else {
					toastr.error(r.message)
				}
			},
			error: function(){
				
				
			},
			complete: function(){
				$('#cgnbtn').text('Change').prop('disabled', false)
			}
	});
	}));
</script>


