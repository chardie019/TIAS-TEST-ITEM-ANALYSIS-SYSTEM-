<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>

<?php
 
 // Temporary hack to supply user id for data insertion

  if(isset($_POST['submit-new-quiz'])) {
    // The New User Form was submitted

    $fields_with_max_lengths = array("term" => 7, "title" => 50, "subject" => 30, "allowed_time" => 20,  "code" => 20);
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!value_within_range($value, 1, $max)) {
        $error_messages[$field] = ucfirst($field) . " is too long.";
      }
    }

    // Validate New User Form inputs
    $fields_required = array("term", "title",  "subject","allowed_time", "code");
    foreach($fields_required as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)) {
        $error_messages[$field] = ucfirst($field) . " is required.";
      }
    }

    


    // If there were errors, redirect back to the form.
    if(!empty($error_messages)) {
      $_SESSION["errors"] = $error_messages;

      $form_values = array("term" => $_POST['term'],
                           "title" => $_POST['title'],
                           "subject" => $_POST['subject'],
        
                    
                             "code" => $_POST['code'],
                           "allowed_time" => $_POST['allowed_time']);
      $_SESSION["form_history"] = $form_values;

      redirect_to("new-exam.php");
    }

    // If inputs were valid begin insertion.
    $_POST = array_map('mysql_real_escape_string',$_POST);

    $term   = $_POST['term'];
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $time = $_POST['allowed_time'];
    $cb   = $_SESSION['user']['Username'];
    $code = $_POST['code'];


    
    if($subject != '') {
      $query  = "INSERT INTO exam (";
      $query .= "  exam_term, exam_title, exam_subject , Created_By, allowed_time, exam_code";
      $query .= ") VALUES (";
      $query .= "  '{$term}' , '{$title}', '{$subject}','{$cb}','{$time}','{$code}'";
      $query .= ")";
    } 
    

    $result = mysqli_query($db, $query);

    if($result) {
      // Success
      $_SESSION["message"] = "Successfully created : {$exam_title}!";
      redirect_to("new-question.php");
      
    } else {
      // Failure
      $_SESSION["error_message"] = "Database insertion failure";
      redirect_to("new-exam.php");
      
    }

  } else {
   
    $_SESSION["message"] = "Please fill in the form to create a new quiz.";
    redirect_to("new-exam.php");
    
  } 
?>

<?php require_once("../includes/db-connection-close.php"); ?>