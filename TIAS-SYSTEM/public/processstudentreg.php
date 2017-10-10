<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>

<?php
  



  if(isset($_POST['submit-new-user'])) {


    $fields_with_max_lengths = array("id_number" => 20,"first_name" => 30, "middle_name" => 30,
                                      "last_name" => 20, "username" => 30, "password" => 20 , "confirm-password" => 20);
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!value_within_range($value, 1, $max)) {
        $error_messages[$field] = ucfirst($field) . " is too long.";

        echo'<script>
            alert("Username Length Invalid Must Be 6 Above Characters");
            window.location = "accountregistration.php";
          </script>';
      }
    }

    
    $fields_required = array("id_number","first_name", "middle_name", "last_name",
                              "username", "password");
    foreach($fields_required as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)) {
        $error_messages[$field] = ucfirst($field) . " is required.";
      }
    }

	
    

    

   
    if(!empty($error_messages)) {
      $_SESSION["errors"] = $error_messages;

      $form_values = array("id_number" => $_POST['id_number'],
							"first_name" => $_POST['first_name'],
                           "middle_name" => $_POST['middle_name'],
                           "last_name" => $_POST['last_name'],
                           "username" => $_POST['username']);
      $_SESSION["form_history"] = $form_values;

      redirect_to("studentsindex.php");
    }

  
    $_POST = array_map('mysql_real_escape_string',$_POST);
	
	  $id_number     = $_POST['id_number'];
    $first_name   = $_POST['first_name'];
    $middle_name   = $_POST['middle_name'];
    $last_name    = $_POST['last_name'];
    $username     = $_POST['username'];
    $password     = $_POST['password'];


    $user_type    = $_POST['user_type'];
    $status    = $_POST['status'];

    

    $query  = "INSERT INTO accounts (";
    $query .= " Idnumber, Firstname, Middlename, Lastname, Username, Password, Usertype, status";
    $query .= ") VALUES (";
    $query .= "  '{$id_number}','{$first_name}', '{$middle_name}', '{$last_name}',";
    $query .= "  '{$username}', '{$password}', '{$user_type}', '{$status}'";
    $query .= ")";

    $result = mysqli_query($db, $query);

    if($result) {
      
      $_SESSION["message"] = "Account Successfully Created: {$username}!";
      redirect_to("studentsindex.php");
	   echo user_form_success_msg();
      
    } else {
     
      $_SESSION["error_message"] = "Database insertion failure";
      redirect_to("studentsindex.php");
      
    }

  } else {
   
    $_SESSION["message"] = "Please fill in the form to create a new user.";
    redirect_to("studentsindex.php");
    
  } 
?>

<?php require_once("../includes/db-connection-close.php"); ?>