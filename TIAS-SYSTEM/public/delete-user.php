<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php

  $user = get_user_by_id($_GET["user_id"]); 
  if(!$user) {
   
    $_SESSION["error_message"] = "Failed to delete user. User does not exist.";
    redirect_to("manage-users.php");
  }

  $id = $user["Account_id"];
  $username = $user["Username"];
  $query = "DELETE FROM accounts WHERE Account_id = {$id} LIMIT 1";
  $result = mysqli_query($db, $query);

  if($result && mysqli_affected_rows($db) == 1) {
  
    $_SESSION["message"] = "Successfully deleted user: {$username}.";
    redirect_to("manage-users.php");
    
  } else {
   
    redirect_to("manage-users.php");
    
  }

?>