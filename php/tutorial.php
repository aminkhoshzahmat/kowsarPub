<?php
	// include databse class
	include('database.class.php');

	
	// Without SingleTon
	//$database = new Database(); 
	// With SingleTon
	$db1 = Database::getInstance();

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Roll Your Own App</title>
</head>
<body>

</body>
</html>