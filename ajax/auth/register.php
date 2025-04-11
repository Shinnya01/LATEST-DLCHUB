<?php
require("../../config/db.php");

session_start();
error_reporting(0);

$registerStatus = array();
if(checkUserSession($db) !== True){
	if(!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["re_password"])){
		$firstName 		= (string)$_POST["firstName"];
		$lastName 		= (string)$_POST["lastName"];
		

		$password 		= (string)$_POST["password"];
		$re_password 	= (string)$_POST["re_password"];
		$email = (string)$_POST["email"]; //new
		$program = (string)$_POST["program"]; //new

		list($username, $domain) = explode('@',$email);

		
			
		


		
		$firstName = preg_replace('/\s+/', ' ', $firstName);
		$lastName = preg_replace('/\s+/', ' ', $lastName);
		
		$profilePicture = "https://nghia.org/project/chat/assets/img/default.jpg"; //default
		
		$blackList = ["admin", "administrator", "gm", "fuck", "nigga", "faggot"];
		


		if(strlen($password) >= 6){
			if(0 < count(array_intersect(array_map('strtolower', explode(' ', $username)), $blackList)) || 
			   0 < count(array_intersect(array_map('strtolower', explode(' ', $firstName)), $blackList)) || 
			   0 < count(array_intersect(array_map('strtolower', explode(' ', $lastName)), $blackList))){
					$registerStatus = array("success" => false, "message" => "Your name or username contains the banned word(s)");	
				} else {
					
				if (preg_match('/^[0-9]+$/', $username)){	
					if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username))
					{
						if(strpos($username, " ") === False){
							if($password === $re_password){
								$sql = mysqli_query($db, "select * from user where username = '$username'") or die(json_encode(array("success" => false, "message" => "Error sql query")));
							
								if(mysqli_num_rows($sql) < 1){
									$userSession = md5($username.$password.(time() / 2));
									$dateTime = date("Y-m-d H:i:s");
									
									mysqli_query($db, "INSERT INTO user(id, firstName, lastName, profilePicture, username, password,program,user_email, session, admin,verified,joinned_time) VALUES (NULL, '$firstName', '$lastName ', '$profilePicture', '$username', '$password','$program', '$email', '$userSession', 0, 0, '$dateTime')");
									
									$cookie_name = "user_name";
									$cookie_value = $username;
									setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); //86400s = 1 day. 1 * 30 = 30 days
									
									$cookie_name = "user_session";
									$cookie_value = $userSession;
									setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); //86400s = 1 day. 1 * 30 = 30 days
									
									$registerStatus = array("success" => true, "message" => "Register success");
								} else {
									$registerStatus = array("success" => false, "message" => "Account has existed. Please try again!");
								}
							
							} else {
								$registerStatus = array("success" => false, "message" => "Re-password doesn't match!");
							}
						} else {
							$registerStatus = array("success" => false, "message" => "Username can't contain spaces!");
						}
					} else {
						$registerStatus = array("success" => false, "message" => "Username doesn't accept special characters");
					}
				}else{
					$registerStatus = array("success" => false, "message" => "email doesn't accept letter");
				}
				}
			} else {
			$registerStatus = array("success" => false, "message" => "Password must be 6 characters or more!");
		}
		
	} else {
		$registerStatus = array("success" => false, "message" => "Empty method");
	}
} else {
	$registerStatus = array("success" => false, "message" => "Require login");
}

echo json_encode($registerStatus);