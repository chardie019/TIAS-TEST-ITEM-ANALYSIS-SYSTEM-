<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>

<?php
  
  if(isset($_POST['submit-login'])) {
   
    
     $fields_with_max_lengths = array("first_name" => 30, "last_name" => 30,"middle_name" => 30,
                                      "idnumber" => 20);
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!value_within_range($value, 1, $max)) {
        $error_messages[$field] = ucfirst($field) . " is too long.";
      }
    }
    // Validate New User Form inputs
    $fields_required = array("first_name", "last_name","middle_name", "idnumber");
    foreach($fields_required as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)) {
        $error_messages[$field] = ucfirst($field) . " is required.";
      }
    }
    
    // If there were errors, redirect back to the form.
    if(!empty($error_messages)) {
      $_SESSION["errors"] = $error_messages;
      $form_values = array("first_name" => $_POST['first_name'],
                           "last_name" => $_POST['last_name'],
                           "idnumber" => $_POST['idnumber'],
                           "middle_name" => $_POST['middle_name'],
                           "examcode" => $_POST['examcode']);
      $_SESSION["form_history"] = $form_values;
    
      redirect_to("student-register.php");
    }
    
   
    $_POST = array_map('addslashes',$_POST);
    $_POST = array_map('htmlentities',$_POST);
    $first_name   = $_POST['first_name'];
    $last_name    = $_POST['last_name'];
    $middle_name  = $_POST['middle_name'];
    $username   = $_POST['idnumber'];
    $examcode     = $_POST['examcode'];
    setcookie("user",$examcode,time()+10000);
  
	if(!isUserExists($username)){
		$query  = "INSERT INTO student (";
		$query .= "  Firstname, Middlename, Lastname, idnumber";
		$query .= ") VALUES (";
		$query .= "  '{$first_name}', '{$middle_name}', '{$last_name}', '{$username}'";
	
		$query .= ")";
		$result = mysqli_query($db, $query);
		if($result) {
		 
		  $_SESSION["message"] = "Successfully created new user: {$firstname}!";
		  
		  if(logging_student($username)){
			  $_SESSION["examcode"] = $examcode;
			  redirect_to("exam_list.php");
		  }
		  else{
			  redirect_to("sample.php");
		  }
		} else {
		  
		  $_SESSION["error_message"] = "Database insertion failure";
		  redirect_to("hello.php");
		}
		
	}
	else {
		if(logging_student($username)){
			  $_SESSION["examcode"] = $examcode;	
			  redirect_to("dashboard.php");
		  }
		  else{
			  redirect_to("student-register.php");
		  }
		
	}
	
	
    
  } else {
    // This is probably a get request
    $_SESSION["message"] = "Please fill in the form to login.";
    redirect_to("student-register.php");
    
  } 
  
  function logging_student($idnumber){
	  global $db;
	  
	  $query  = "SELECT * FROM `student` WHERE `idnumber` = '{$idnumber}'";
	  $result = mysqli_query($db, $query);
	  if($result && $result->num_rows == 1) {
		if($user = mysqli_fetch_assoc($result)) {
			$_SESSION["authenticate"] = "Yes";
			$_SESSION["user"] = $user;
			$_SESSION["logouturl"] = "exam_list.php";
			  $_SESSION["message"] = "You are logged in successfully!";
			  redirect_to("sample.php");
			  return true;
         }
		 else
		 {
			$_SESSION["error_message"] = "Id number is wrong!";
			return false;
		 }
    } else {
      // Failure
      $_SESSION["error_message"] = "Id number is wrong!";
      return false;
    }
	  
	  
  }
  
  
?>