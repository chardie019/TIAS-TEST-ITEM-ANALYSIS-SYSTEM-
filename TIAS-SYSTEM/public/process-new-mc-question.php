<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>

<?php
  

 

  if(isset($_POST['submit-new-mc-question'])) {

  
    $fields_required = array("question_text", "answer1", "answer2",
                              "answer3", "answer4","answer5");
    foreach($fields_required as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)) {
        $error_messages[$field] = ucfirst($field) . " is required.";
      }
    }

    

    if(!empty($error_messages)) {
      $_SESSION["errors"] = $error_messages;

      $form_values = array("question_text" => $_POST['question_text'],
                           "answer1"  => $_POST['answer1'],
                           "answer2"  => $_POST['answer2'],
                           "answer3"  => $_POST['answer3'],
                           "answer4"  => $_POST['answer4'],
                           "answer5"  => $_POST['answer5']);
      $_SESSION["form_history"] = $form_values;

      redirect_to("new-question.php");
    }

    
    $_POST = array_map('mysql_real_escape_string',$_POST);

    $question_text    = $_POST['question_text'];
    $answer1          = $_POST['answer1'];
    $answer2          = $_POST['answer2'];
    $answer3          = $_POST['answer3'];
    $answer4          = $_POST['answer4'];
    $answer5          = $_POST['answer5'];
    $cb             = $_SESSION['user']['Username'];
    $discarded          = "0";
    $query  = "INSERT INTO question (";
    $query .= "  question_text, Created_By, is_discarded";
    $query .= ") VALUES (";
    $query .= "  '{$question_text}', '{$cb}', '{$discarded}'";
    
    $query .= ")";

    $result = mysqli_query($db, $query);

    if ( false === $result ) {
     
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = "Database insertion failure";
      redirect_to("new-question.php");

    } 

    $inserted_question_id = mysqli_insert_id($db);

  
    $ischecked = false;
      
 
    if($_POST['ischecked'] == '1') { $ischecked = true; }

    $query1  = "INSERT INTO answer (";
    $query1 .= "  answer_text, question_id, is_correct";
    $query1 .= ") VALUES (";
    $query1 .= "  '{$answer1}', '{$inserted_question_id}', '{$ischecked}'";
    $query1 .= ")";

    $result1 = mysqli_query($db, $query1);

    if ( false === $result1 ) {
     
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = "Database insertion failure";
      redirect_to("new-question.php");
    }

    $ischecked = false; 
	
	

 
    if($_POST['ischecked'] == '2') { $ischecked = true; }

    $query2  = "INSERT INTO answer (";
    $query2 .= "  answer_text, question_id, is_correct";
    $query2 .= ") VALUES (";
    $query2 .= "  '{$answer2}', '{$inserted_question_id}', '{$ischecked}'";
    $query2 .= ")";

    $result2 = mysqli_query($db, $query2);

    if ( false === $result2 ) {
  
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = "Database insertion failure";
      redirect_to("new-question.php");
    }

    $ischecked = false;

   
    if($_POST['ischecked'] == '3') { $ischecked = true; }

    $query3  = "INSERT INTO answer (";
    $query3 .= "  answer_text, question_id, is_correct";
    $query3 .= ") VALUES (";
    $query3 .= "  '{$answer3}', '{$inserted_question_id}', '{$ischecked}'";
    $query3 .= ")";

    $result3 = mysqli_query($db, $query3);

    if ( false === $result3 ) {
      
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = "Database insertion failure";
      redirect_to("new-question.php");
    }

    $ischecked = false;


    if($_POST['ischecked'] == '4') { $ischecked = true; }

    $query4  = "INSERT INTO answer (";
    $query4 .= "  answer_text, question_id, is_correct";
    $query4 .= ") VALUES (";
    $query4 .= "  '{$answer4}', '{$inserted_question_id}', '{$ischecked}'";
    $query4 .= ")";

    $result4 = mysqli_query($db, $query4);

    if ( false === $result4 ) {
   
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = "Database insertion failure";
      redirect_to("new-question.php");
    }

	 $ischecked = false;

    if($_POST['ischecked'] == '5') { $ischecked = true; }

    $query5  = "INSERT INTO answer (";
    $query5 .= "  answer_text, question_id, is_correct";
    $query5 .= ") VALUES (";
    $query5 .= "  '{$answer5}', '{$inserted_question_id}', '{$ischecked}'";
    $query5 .= ")";

    $result5 = mysqli_query($db, $query5);

    if ( false === $result5 ) {
     
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = "Database insertion failure";
      redirect_to("new-question.php");
    } 
	
	 $ischecked = false;



    $_SESSION["message"] = "Successfully created";
    redirect_to("new-question.php");
    





  } else {
   
    $_SESSION["message"] = "Please fill in the form";
    redirect_to("new-question.php");
    
  } 
?>

<?php require_once("../includes/db-connection-close.php"); ?>