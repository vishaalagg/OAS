<?php
	if(isset($_POST['myData'])){
		$obj = json_decode($_POST['myData']);
		$purpose=$obj->purpose;

		if($purpose=='appList'){
			$email= $obj->email;
			$query2 = "SELECT * FROM appointment WHERE pemail='$email'";
			require 'db.php';
			$result2 = mysqli_query($db, $query2);
			if(mysqli_num_rows($result2)>0){
				while($obj2=mysqli_fetch_object($result2)){
					$data2[]= $obj2;
				}
				$data2['success']= true;
				$data2['message']='fetched data';
				echo json_encode($data2);
			}
			else{
				$res= new stdClass();
				$res->success= false;
				$res->message='No Appointment so far';
				echo json_encode($res);
			}
		}
		else if($purpose=='getTime'){
			$email= $obj->email;
			$date = $obj->date;

			require 'db.php';
			$query= "SELECT * FROM doctors WHERE email= '$email' " ;
			$result = mysqli_query($db, $query);
			if(mysqli_num_rows($result)> 0){
				while($obj = mysqli_fetch_object($result)){
					$data[]= $obj;
				}
				//print_r($data);
				$stime = $data['0']->stime;
				$etime = $data['0']->etime;
				$totalTime = $etime-$stime;
				//echo $totalTime;
				for($i=0; $i<$totalTime; $i++){
					$arr[]= $stime.':00-'.$stime.':30';
					$arr[]= $stime.':30-'.++$stime.':00';
				}
				
				$query1= "SELECT * FROM appointment WHERE demail='$email' AND bdate='$date'";
				$result1= mysqli_query($db, $query1);
				if(mysqli_num_rows($result1)> 0){
					while($obj1 = mysqli_fetch_object($result1)){
						$data1[]= $obj1;
					}
					//print_r($data1);
					for($j=0; $j<sizeof($data1); $j++){
						$extra[$j] = $data1[$j]->btime;
					}
					$new_arr = array_diff($arr, $extra);
					echo json_encode($new_arr);
				}
				else{
					echo json_encode($arr);
				}
			}
		}
		else{ 
			//for doctor page. purpose getDoc
			require 'db.php';
			$demail=$obj->demail;
			$query="SELECT * FROM appointment WHERE demail='$demail' ORDER BY bdate";
			$result=mysqli_query($db, $query);
			if(mysqli_num_rows($result)>0){
				while($arr= mysqli_fetch_object($result)){
					$res[]= $arr;
				}
				for($j=0; $j<sizeof($res); $j++){
					$mail = $res[$j]->pemail;
					$qry= "SELECT name, DOB, gender FROM patients WHERE email='$mail' ";
					$rslt= mysqli_query($db, $qry);
					if(mysqli_num_rows($rslt)>0){
						$ar= mysqli_fetch_object($rslt);
						$res[$j]->pname= $ar->name;
						$res[$j]->DOB= $ar->DOB;
						$res[$j]->gender= $ar->gender;
					}
				}
				$res['success']= true;
				$res['message']= 'appointments sent';
				echo json_encode($res);
			}
			else{
				$res= new stdClass();
				$res->success= false;
				$res->message='no appointments found';
				echo json_encode($res);
			}
		}
	}
	else{
		echo 'not post';
	}
?>