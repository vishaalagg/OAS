<?php
	if(isset($_POST['myData'])){
		$obj = json_decode($_POST['myData']);
		$request = $obj->request;
		if($request == 'add'){
			$name = $obj->name;
			$email = $obj->email;
			$specialization = $obj->specialization;
			$stime = $obj->stime;
			$etime = $obj->etime;
			$password=$obj->password;
			$qualification = $obj->qualification;
			
			require 'db.php';
			$chk = "SELECT * FROM doctors where email ='$email'";
			$check = mysqli_query($db, $chk);
			if(mysqli_num_rows($check)>0){
				$res= new stdClass();
				$res->success= false;
				$res->message= 'Email already exists';
				echo json_encode($res);
			}
			else{
				$query = "INSERT INTO doctors(name, email, specialization, stime, etime, qualification, password) VALUES('$name','$email', '	$specialization', '$stime', '$etime', '$qualification', '$password')";
				$result=mysqli_query($db, $query);
				if($result){
					$res= new stdClass();
					$res->success= true;
					$res->message= 'Data saved';
					echo json_encode($res);
				}
				else{
					$res= new stdClass();
					$res->success= false;
					$res->message= 'Some connectivity error';
					echo json_encode($res);
				}
			}
		}
		else if($request=='update'){
			$name = $obj->name;
			$email = $obj->email;
			$specialization = $obj->specialization;
			$stime = $obj->stime;
			$etime = $obj->etime;
			$password = $obj->password;
			$qualification = $obj->qualification;

			require 'db.php';
			$query = "UPDATE doctors SET name='$name', specialization='$specialization', stime='$stime', etime='$etime', qualification= '$qualification', password= '$password' WHERE email= '$email'";
			$result = mysqli_query($db, $query);
			if($result){
				$res= new stdClass();
				$res->success= true;
				$res->message= 'Updated Successfully';
				echo json_encode($res);
			}
			else{
				$res= new stdClass();
				$res->success= false;
				$res->message= 'error in connectivity';
				echo json_encode($res);
			}
		}
		else if($request=='login'){
			$email= $obj->email;
			$password= $obj->password;
			require 'db.php';
			$qury = "SELECT * FROM doctors WHERE email='$email' && password='$password' ";
			$rslt=mysqli_query($db, $qury);
			if(mysqli_num_rows($rslt)>0){
				$json['success']= true;
				$json['message']= 'logged in';
				echo json_encode($json);
			}
			else{
				$json['success']= false;
				$json['message']= 'Invalid credentials';
				echo json_encode($json);
			}
		}
		else{
			$email = $obj->email;
			require 'db.php';
	
			$chk = "SELECT * FROM doctors where email ='$email'";
			$result = mysqli_query($db, $chk);
			if(mysqli_num_rows($result)>0){
				while($obj1 = mysqli_fetch_object($result)){
					unset($obj->{'password'});
					$json[]= $obj1;
				}
	
				$json['success'] = true;
				$json['message'] = 'values sent';
				echo json_encode($json);
			}
			else{
				$res= new stdClass();
				$res->success= false;
				$res->message= 'doctor not found';
				echo json_encode($res);
			}
		}
	}
	else{
		require 'db.php';
		$query1= "SELECT * FROM doctors";
		$result1= mysqli_query($db, $query1);
		if(mysqli_num_rows($result1)>0){
			while($obj = mysqli_fetch_object($result1)){
				unset($obj->{'password'});
				$json[]= $obj;
			}
		}
		//print_r($json);
		$json['success']= true;
		$json['message']= 'data set';
		$response = json_encode($json);
		echo $response;
	}
?>