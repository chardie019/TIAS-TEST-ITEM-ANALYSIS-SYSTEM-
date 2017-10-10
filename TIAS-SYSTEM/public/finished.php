<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
  $quiz = get_exam_by_id($_GET["exam_id"]); 
  if(!$quiz) {
   
    $_SESSION["error_message"] = "Failed to send code for this exam. Exam does not exist.";
    redirect_to("manage-exams.php");
  }
  $id = $quiz["exam_id"];
  $quiz_name = $quiz["exam_name"];
  $query = "UPDATE exam SET status = 0 WHERE exam_id = {$id} LIMIT 1";
  $result = mysqli_query($db, $query);
  if($result && mysqli_affected_rows($db) == 1) {
      
        $_SESSION["message"] = "You have successfully marked the examination as done";
        redirect_to("manage-exams.php");
  

  } else {
  
    redirect_to("manage-exams.php");
    
  }
?>