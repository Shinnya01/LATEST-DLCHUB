<html>
<?php
if(!session_id()){
	session_start();
}

require('config/db.php');
require('layout/head.php');

if(checkUserSession($db) !== False){
	header("location: $_HOME_FILE");
	exit;
}

?>
<body>
    
    <div class="w-screen h-screen flex items-center justify-center bg-white text-black gap-4">

<div class="text-3xl font-bold w-[55%] h-full flex items-center justify-center">DLC HUB</div>

<div class="flex flex-col items-center justify-around w-[45%] h-full gap-4 rounded-l-3xl p-5 bg-[#800000]">
        <div class="flex flex-col items-center justify-center gap-2">           
                 <h1 class="text-6xl font-bold text-white">WELCOME</h1>
                <p class="text-lg text-white">Please login your account to continue</p>
        </div>

        <form class="max-w-sm mx-auto w-full" method="post" action="" id="Login">
                <div class="mb-5">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-100">Your email</label>
                    <input type="text" id="username" value="asjhvafujsy@gmail.com" name="username" class="shadow-xs bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@flowbite.com" required />
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-100">Your password</label>
                    <input type="password" id="password" value="aksfbais" name="password" class="shadow-xs bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                
                <div class="flex items-center mb-6 justify-between ">
                        <div>
                                <input type="checkbox" name="" id="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" />
                                <label for="remember" class="ml-2 text-base font-medium text-gray-100">Remember me</label>
                        </div>

                        <div>
                                <a href="#" class="text-base text-blue-600 hover:underline">Forgot password?</a>
                        </div>
                </div>

                <button id="lgbtn" type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">Log in</button>


                <p class="text-lg font-light text-gray-100 text-center mt-5">
                        Don’t have an account yet? <a href="signup.html" class="font-medium text-blue-600 hover:underline">Sign up</a>
                </p>
            </form>

</div>
</div>



    
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
$("#Login").on('submit',(function(e) {
	e.preventDefault();
	$.ajax({
		url: "ajax/auth/login.php",
		type: "POST",
		data:  new FormData(this),
		dataType:  'json',
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function () {
			$('#lgbtn').text('Processing...').prop('disabled', true)
		},
		success: function(r) {
			if(r.success){
				location.reload()
			} else {
				toastr.error(r.message)
			}
		},
		error: function(){
			
			
		},
		complete: function(){
			$('#lgbtn').text('Login').prop('disabled', false)
		}
   });
}));
</script>
</body>
</html>