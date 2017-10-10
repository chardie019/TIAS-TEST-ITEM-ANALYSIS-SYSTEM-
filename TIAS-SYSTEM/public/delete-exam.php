

<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php

  $exam = get_exam_by_id($_GET["exam_id"]); 
  if(!$exam) {
    // Quiz id was missing or invalid or
    // could not be found in the database.
    $_SESSION["error_message"] = "Failed to delete exam. Exam does not exist.";
    redirect_to("manage-exams.php");
  }

  $id = $exam["exam_id"];
  $exam_title = $exam["exam_title"];
  $query = "DELETE FROM exam WHERE exam_id = {$id} LIMIT 1";
  $result = mysqli_query($db, $query);

  if($result && mysqli_affected_rows($db) == 1) {
    $query2 = "DELETE FROM exam_has_questions WHERE exam_id = {$id}";
    $result2 = mysqli_query($db, $query2);
    if($result2) {
      // Success
        $_SESSION["message"] = "Successfully deleted exam: {$exam_title}.";
        redirect_to("manage-exams.php");
    } 
  } else {
    // Failure
    redirect_to("manage-exams.php");
    
  }

?>