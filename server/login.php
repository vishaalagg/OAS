<?php
  if(isset($_POST['myData'])){
    $data = json_decode($_POST['myData']);
    $for= $data->for;
    if($for=='login'){
      $email = $data->email;
      $password= $data->password;
     //echo $email;
      require 'db.php';
      $query = "SELECT * FROM patients WHERE email = '$email'";
      $result = mysqli_query($db, $query);
      if(mysqli_num_rows($result)>0){
        while($obj = mysqli_fetch_object($result)){
          $json[] = $obj;
        }
        $pass= $json[0]->{'password'};
        if($password==$pass){
          unset($json[0]->{'password'});
          $json['success'] = true;
          $json['message'] = 'welcome';
          $res= json_encode($json);
          echo $res;
        }
        else{
          $res= new stdClass();
          $res->success= false;
          $res->message= 'Incorrect Password';
          echo json_encode($res);
        }
      }
      else{
       $res= new stdClass();
       $res->success = false;
       $res->message= 'Not Registered, register first';
       echo json_encode($res);
      }
    }
    else{
      $name= $data->name;
      $email= $data->email;
      $blood= $data->bgroup;
      $dob=$data->dob;
      $height= $data->height;
      $weight= $data->weight;
      $mobile= $data->mobile;
      $address= $data->address;
      $alchohol= $data->alchoholic;
      $smoker= $data->smoker;
      $diabetic= $data->diabetic;
      $gender= $data->gender;
      $password=$data->password;
      $bp=$data->bp;
      require 'db.php';
      //echo $alchohol;
      $query= "SELECT * FROM patients WHERE email='$email' ";
      $result= mysqli_query($db, $query);
      if(mysqli_num_rows($result)>0){
        $res= new stdClass();
        $res->success = false;
        $res->message= 'Email already available';
        echo json_encode($res);
      }
      else{
        $query1= "INSERT INTO patients(name, email, mobile, address, bloodGroup, height, weight, bloodPressure, DOB, alchoholic, smoker, diabetic, gender, password) VALUES('$name', '$email', '$mobile', '$address', '$blood', '$height', '$weight', '$bp', '$dob', '$alchohol', '$smoker', '$diabetic', '$gender', '$password')";
        $result1= mysqli_query($db, $query1);
        if ($result1) {
          $res= new stdClass();
          $res->success = true;
          $res->message= 'registered';
          echo json_encode($res);
        }
        else{
          $res= new stdClass();
          $res->success = false;
          $res->message= 'some error';
          echo json_encode($res);
        }
      }
    }
  }
  else{
    echo 'not post';
  }
?>