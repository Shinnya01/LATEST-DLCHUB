<html>
<?php
require("config/db.php");
require("layout/head.php");

if(checkUserSession($db) !== True){
	header("location: $_LOGIN_FILE");exit; //$_LOGIN_FILE --> /config/value.php
}


$user = searchUser_bSession($db, $_COOKIE["user_session"]);
?>
<body>
    <?php require("layout/navtop.php") ?>
    <?php require("layout/sidebar.php") ?>


    <div class="p-4 mt-10 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
           

    voting

    </div>


  </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>