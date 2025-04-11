<?php
require("func.php");
require("value.php");
$db = mysqli_connect("localhost","root","") or die("can't connect this database");
mysqli_select_db($db, "datab_prac");
mysqli_set_charset($db, 'utf8');
date_default_timezone_set('Asia/Manila');