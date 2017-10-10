<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>

<?php
  

  if(isset($_POST['submit-login'])) {
   

    $fields_with_max_lengths = array("username" => 40, "password" => 40);
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!value_within_range($value, 1, $max)) {
        $error_messages[$field] = ucfirst($field) . " is too long.";
      }
    }

  
    $fields_required = array("username", "password");
    foreach($fields_required as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)) {
        $error_messages[$field] = ucfirst($field) . " is required.";
      }
    }

    
    if(!empty($error_messages)) {
      $_SESSION["errors"] = $error_messages;

      $form_values = array("username" => $_POST['username']);
      $_SESSION["form_history"] = $form_values;

      redirect_to("studentsindex.php");
    }

   
    $_POST = array_map('addslashes',$_POST);
    $_POST = array_map('htmlentities',$_POST);
    
    $username        = $_POST['username'];
    $password     = $_POST['password'];
    $usertype     = "student";
    $examcode     = $_POST['code'];
    setcookie("user",$examcode,time()+10000);


	$query  = "SELECT * FROM `accounts` WHERE `status` = 'ACTIVE' AND `username` = '{$username}' AND `password` = '{$password}' AND `usertype` = '{$usertype}'";
	
    $result = mysqli_query($db, $query);
    if($result && $result->num_rows == 1  ) {
		if($user = mysqli_fetch_assoc($result)) {
			$_SESSION["authenticate"] = "Yes";
			unset($user["password"]);
			$_SESSION["user"] = $user;

	     
      if ($usertype == 'student')  {
         $_SESSION["message"] = "You are logged in successfully!";
        redirect_to("exam_list.php");
      }      
			  $_SESSION["message"] = "You are logged in successfully!";
			  redirect_to("exam_list.php");
         }

		 else
		 {
			$_SESSION["error_message"] = "Username/Password Wrong";
			redirect_to("xml_get_current_byte_index(parser).php");
		 }
    } else {
     
      $_SESSION["error_message"] = "Username/Password Wrong";
      redirect_to("studentsindex.php");
	
    }

  } else {
   
    $_SESSION["message"] = "Please fill in the form to login.";
    redirect_to("studentsindex.php");
    
  } 

?>

<?php require_once("../includes/db-connection-close.php"); ?>