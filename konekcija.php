<?php


function dbConnect(){
 	$conn =	null;
 	$host = 'mysql1.000webhost.com';
 	$db = 	'a1519105_product';
 	$user = 'a1519105_product';
 	$pwd = 	'natalija21';
	try {
	   	$conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
		//echo 'Connected succesfully.<br>';
	}
	catch (PDOException $e) {
                echo '<p> Cannot connect to database !!</p>';
                echo '<p>'.$e.'</p>';
	    exit;
	}
	return $conn;
 }


?>
