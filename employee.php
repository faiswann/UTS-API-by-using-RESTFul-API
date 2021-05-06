<?php
	// Configure Access-Control-Allow-Origin so other machines can run this page.
	header("Access-Control-Allow-Origin: *");
	
	header("Content-Type: application/json; charset=UTF-8");
	
	header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
	
	header("Access-Control-Max-Age: 3600");
	
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	//Set up a database connection
	$link = mysqli_connect('localhost', 'root', '123456', 'users_database');

	mysqli_set_charset($link, 'utf8');
	
	$requestMethod = $_SERVER["REQUEST_METHOD"];
	
	//Method GET
	if($requestMethod == 'GET'){
		
		if(isset($_GET['id']) && !empty($_GET['id'])){
			
			$id = $_GET['id'];
			
			// SQL statement if an id is sent, display only the information of that id
			$sql = "SELECT * FROM employees WHERE id = $id";
			
		}else{
			// The SQL statement shows all the data.
			$sql = "SELECT * FROM employees";
		}
		
		$result = mysqli_query($link, $sql);
		
		// Create an array variable to store the resulting data.
		$arr = array();
		
		while ($row = mysqli_fetch_assoc($result)) {
			 
			 $arr[] = $row;
		}
		
		echo json_encode($arr);
	}

