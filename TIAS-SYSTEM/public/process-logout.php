<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>

<?php
$logouturl = "index.php";
 session_destroy();
 session_start();
 $_SESSION["message"] = "You are logged out successfully!";


 if($logouturl)
    redirect_to($logouturl);

 else
    redirect_to("index.php");
?>