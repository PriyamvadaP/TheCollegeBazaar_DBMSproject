<?php
// session_start(); 
// include "db_conn.php";

// if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['cpassword'])) {

// 	function validate($data){
//        $data = trim($data);
// 	   $data = stripslashes($data);
// 	   $data = htmlspecialchars($data);
// 	   return $data;
// 	}

// 	$uname = validate($_POST['uname']);
// 	$pass = validate($_POST['password']);

//     $cpass = validate($_POST['cpassword']);
//     $name = validate($_POST['name']);

//     $user_data = 'uname'. $uname. '&name='.$name;

// 	if (empty($uname)) {
// 		header("Location: signup.php?error=User Name is required&$user_data");
// 	    exit();
	// }else if(empty($pass)){
    //     header("Location: signup.php?error=Password is required&$user_data");
	//     exit();
	// }
    // else if(empty($cpass)){
    //     header("Location: signup.php?error=Confirm Password is required&$user_data");
	//     exit();
    // }
    // else if(empty($name)){
    //     header("Location: signup.php?error=Name is required&$user_data");
	//     exit();
    // }
    // else if($pass !== $cpass){
    //     header("Location: signup.php?error=The confirmation password does not match&$user_data");
	//     exit();
    // }
    // else{
    //     $pass=md5($pass);
	// 	$sql = "SELECT * FROM users WHERE user_name='$uname' ";
    //     $result = mysqli_query($conn, $sql);

		// if (mysqli_num_rows($result) > 0) {
        //     header("Location: signup.php?error=Username already exists&$user_data");
	    // exit();
        // }else{
        //     $sql2="INSERT INTO users VALUES ('$uname','$pass','$name')";
        //     $result2 = mysqli_query($conn, $sql);
        //     if($result2){
        //         header("Location: signup.php?success=Registration Successfull &$user_data");
        //         exit();
        //     }
//             else{
//                 header("Location: signup.php?error=Error Occurred&$user_data");
//                 exit();
//             }
// 	   }
//   } 
//   }  else{
// 	header("Location: signup.php");
// 	exit();
//} 
//<?php 
// session_start(); 
// include "db_conn.php";



session_start(); 
// include "db_conn.php";
include('connect.php');

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	$re_pass = validate($_POST['re_password']);
	$name = validate($_POST['name']);

	$user_data = 'uname='. $uname. '&name='. $name;


	if (empty($uname)) {
		header("Location: signup.php?error=User Name is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=Re Password is required&$user_data");
	    exit();
	}

	else if(empty($name)){
        header("Location: signup.php?error=Name is required&$user_data");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: signup.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}

	else{

		// hashing the password
        $pass = md5($pass);

	    // $sql = "SELECT * FROM users WHERE user_name='$uname' ";
		$sql = "SELECT * FROM user WHERE user_name='$uname' ";                                                        //or name='uname'
		// $result = mysqli_query($conn, $sql);
		$result = mysqli_query($con, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
        //    $sql2 = "INSERT INTO users(user_name, password, name) VALUES('$uname', '$pass', '$name')";
		   $sql2 = "INSERT INTO user(user_name, password, name) VALUES('$uname', '$pass', '$name')";
        //    $result2 = mysqli_query($conn, $sql2);
		$result2 = mysqli_query($con, $sql2);
           if ($result2) {
			 //header("Location: index.php");
			 echo "<script>alert('Registration successful')</script>";
			 echo "<script>window.open('index.php','_self')</script>";
           	 //header("Location: index.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}

