<?php 
	if(isset($_POST['pdata'])){
		$obj1= json_decode($_POST['pdata']);
		$email = $obj1->email;
		require 'db.php';
		$query = "SELECT * FROM patients WHERE email ='$email' ";
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result)> 0){
			while($obj = mysqli_fetch_object($result)){
				$json[]= $obj;
			}
			$json['success']= true;
			$json['message']='data recieved';
			$data = json_encode($json);
			echo $data;
		}
		
	}
	else{
		$data = new stdClass();
		$data->success= false;
		$data->message = 'some error';
		echo json_encode($data);
	}
?>