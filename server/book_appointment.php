<?php
	if(isset($_POST['allData'])){
		$data = json_decode($_POST['allData']);
		$purpose=$data->purpose;
		if($purpose=='booking'){
			$dname= $data->dname;
			$demail= $data->demail;
			$DID= $data->DID;
			$date= $data->appDate;
			$time= $data->appTime;
			$pname= $data->pname;
			$pemail= $data->pemail;
			$pid= $data->PID;
			$blood= $data->bgroup;
			$dob=$data->dob;
			$height= $data->height;
			$weight= $data->weight;
			$mobile= $data->mobile;
			$address= $data->address;
			$alchohol= $data->alchohol;
			$smoker= $data->smoker;
			$diabetic= $data->diabetic;
			$gender= $data->gender;
			$comments= $data->comments;
	
			$dt= $date.','.$time;
		
			require 'db.php';
			$query = "INSERT INTO appointment(DID, PID, pemail, demail,bdate, btime, comments, DT) VALUES('$DID', '$pid', '$pemail', '$demail', '$date', '$time', '$comments', '$dt')";
			$result= mysqli_query($db, $query);
			if($result){
				$query1= "UPDATE patients SET name='$pname', mobile='$mobile', address='$address', bloodGroup='$blood', height='$height',weight='$weight', DOB='$dob', alchoholic='$alchohol', diabetic='$diabetic', smoker='$smoker', gender='$gender' WHERE email = '$pemail'";
				$result1= mysqli_query($db, $query1);
				if($result1){
					$query2= "SELECT * FROM appointment WHERE DT='$dt' AND DID='$DID' ";
					$result2= mysqli_query($db, $query2);
					if(mysqli_num_rows($result2)>0){
						while($rest= mysqli_fetch_object($result2)){
						$arr[]= $rest;
						}
						$arr['success']= true;
						$arr['message']='appointment fixed';
						echo json_encode($arr);
					}
					
				}
				else{
					$res = new stdClass();
					$res->success= false;
					$res->message='error in updation';
					echo json_encode($res);
				}
			}
			else{
				$res = new stdClass();
				$res->success= false;
				$res->message='error in fixing app';
				echo json_encode($res);
			}
		}
		else{
			$did=$data->DID;
			$pid=$data->PID;
			$aid=$data->AID;
			require 'db.php';
			$query3="SELECT * FROM appointment WHERE DID='$did' AND PID='$pid' AND AID='$aid'";
			$result3= mysqli_query($db, $query3);
			if(mysqli_num_rows($result3)>0){
				while($res1= mysqli_fetch_object($result3)){
					$arr[]=$res1;
				}
				$query4="SELECT name FROM doctors WHERE DID='$did'";
				$result4=mysqli_query($db, $query4);
				if(mysqli_num_rows($result4)>0){
					while($res2=mysqli_fetch_object($result4)){
						$arr[]=$res2;
					}
				}
				
				$arr['success']=true;
				$arr['message']='sent';
				echo json_encode($arr);
			}
		}
	}
	else{
		require 'db.php';
		$query= "SELECT * FROM appointment";
		$result= mysqli_query($db, $query);
		if(mysqli_num_rows($result)>0){
			while($a= mysqli_fetch_object($result)){
				$res[]= $a;
			}
			for($i=0; $i<sizeof($res); $i++){
				$pe=$res[$i]->pemail;
				$querys="SELECT name, mobile FROM patients WHERE email= '$pe'";
				$results=mysqli_query($db, $querys);
				if ($results) {
					while($new=mysqli_fetch_object($results)){
						//echo json_encode($new);
						$res[$i]->pname= $new->name;
						$res[$i]->mobile=$new->mobile;
					}
				}
			}
			
			$res['success']=true;
			$res['message']='sent';
			echo json_encode($res);
		}
	else{
		$res['success']=false;
		$res['message']='no appointment';
		echo json_encode($res);
	}
	}
?>