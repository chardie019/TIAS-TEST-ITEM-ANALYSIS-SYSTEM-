<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>

<?php $page = "edit-exam.php"; ?>

<?php include('../includes/layouts/header.php'); ?>



<style>

.correct{color:#0EAF0E;font-weight:bold;}

</style>


<?php
  
  $id = isset($_GET["exam_id"]) ? $_GET["exam_id"] : "";
  $quiz = get_exam_by_id($id);


  if(!$quiz) { redirect_to("manage-exams.php"); }
?>

<?php

 
  
  if(isset($_POST['submit-edit-quiz'])) { 

    
    $fields_with_max_lengths = array("term" => 20, "title" => 50,
                                      "subject" => 50,"date" => 30, "allowed_time" => 50 );
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!value_within_range($value, 1, $max)) {
        $error_messages[$field] = ucfirst($field) . " is too long.";
      }
    }

    $fields_required = array("term", "title", "subject" , "date" , "allowed_time");
    foreach($fields_required as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)) {
        $error_messages[$field] = ucfirst($field) . " is required.";
      }
    }


    
    if(empty($error_messages)) {

      $_POST = array_map('mysql_real_escape_string',$_POST);

      $exam_id      = $id;
      $term    = $_POST['term'];
      $title     = $_POST['title'];
      $subject    = $_POST['subject'];
      $date    = $_POST['date'];
      $time     = $_POST['allowed_time'];


      
      if(!has_presence($subject)) {
        $query  = "UPDATE exam SET ";
        $query .= "exam_term = '{$term}', ";
        $query .= "exam_title = '{$title}', ";
        $query .= "exam_subject = NULL, ";
        $query .= "time= '{$allowed_time}' ";
        $query .= "WHERE exam_id = {$exam_id} ";
        $query .= "LIMIT 1";
      } else {
        $query  = "UPDATE exam SET ";
        $query .= "exam_term = '{$term}', ";
        $query .= "exam_title = '{$title}', ";
        $query .= "exam_subject = '{$subject}', ";
         $query .= "Date_Created = '{$date}', ";
        $query .= "allowed_time = '{$time}' ";
        $query .= "WHERE exam_id = {$exam_id} ";
        $query .= "LIMIT 1";
      }
      
      
      

      $result = mysqli_query($db, $query); 

      if($result && mysqli_affected_rows($db) != -1) {
        // Success
        $_SESSION["message"] = "Successfully updated exam: {$title}!";
        redirect_to("manage-exams.php");
      } else {
        // Failure
        $message = "Database insertion failure";
        
      }
    }

  } else {
    
  } 
?>

<body>

<div id="wrapper">

 
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <input type="text" class="hidden" ></av>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">ITEM ANALYZER</a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav.php'); ?>
        <?php include('../includes/layouts/admin-profile.php'); ?>

      
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <div id="page-wrapper">

    <div class="row">
      <div class="col-lg-12">
           
             
        
      
      
    </div>

    

    <?php echo display_form_errors($error_messages); ?>

<?php if(!empty($_POST)) { print_r($_POST); } ?>
<?php if(!empty($error_messages)) { print_r($error_messages); } ?>
<?php if(!empty($message)) { print_r($message); } ?>



      
      <div class="col-lg-12">
  <style type="text/css">
.legend { list-style: none; }
.legend li { float: left; margin-right: 12px; }
.legend span { border: 3px solid #ccc; float: left; width: 18px; height: 18px; margin: 0px; }
.legend spin { border: 3px solid #ccc; float: left; width: 18px; height: 18px; margin: 0px; }



.legend .superawesome { background-color: #0EAF0E ; }



</style>  
        <div class="panel tbp-panel-inverse">
          <div class="panel-heading">

            <?php $linked_questions = get_quiz_questions($id); ?>


            <h4><span >There are [<?php echo mysqli_num_rows($linked_questions); ?>] Questions Connected In This Examination </span> 
           
          
          </div>

                     
                        
          <div class="panel-body">

              <form id="edit-quiz-form"  role="form" action="edit-exam.php?exam_id=<?php echo $quiz["exam_id"]; ?>" method="post">
                <div class="form-group col-lg-3">
                  <label for="quiz_name" class="control-label">Examination Term</label>
                  <input type="text" class="form-control" id="term" value="<?php echo $quiz["exam_term"]; ?>" name="term" placeholder="Quiz Name">
                </div>
                <div class="form-group col-lg-3">
                  <label for="category" class="control-label">Examination Title</label>
                  <input type="text" class="form-control" id="title" value="<?php echo $quiz["exam_title"]; ?>" name="title" placeholder="Mathematics">
                </div>
                <div class="form-group col-lg-3">
                  <label for="deadline" class="control-label">Subject</label>
                  <input type="text" class="form-control" id="subject" value="<?php echo $quiz["exam_subject"]; ?>" name="subject" placeholder="Math 61">
                </div>
                <div class="form-group col-lg-3">
                  <label for="attempts" class="control-label">Time Given</label>
                    <input type="text" class="form-control" id="allowed_time" value="<?php echo $quiz["allowed_time"]; ?>" name="allowed_time" placeholder="1">
                </div>

                  <div class="form-group col-lg-3">
                  <label for="attempts" class="control-label">Date Created And Time Created</label>
                    <input type="text" class="form-control" id="date" value="<?php echo $quiz["Date_Created"]; ?>" name="date" placeholder="1" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="attempts" class="control-label">Examination Code</label>
                    <input style="color:red; "type="text" class="form-control" id="code" value="<?php echo $quiz["exam_code"]; ?>" name="code" placeholder="1" readonly>
                </div>

                    <a href="manage-exams.php" id="cancel-edit-quiz" name="cancel-edit-quiz" class="btn btn-default pull-right margin-right-10">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right" id="submit-edit-quiz" name="submit-edit-quiz" value="submit-edit-quiz">Save Changes</button>
                    <div class="btn-group pull-right">

                      
                    </div>
                </div>
                
                
                    <!-- Split button -->
                  
                   
              </form>

          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <tbody>
                <?php
                $i = 1;
                while($row = mysqli_fetch_assoc($linked_questions)) {
                  $current_question = get_question_by_id($row['question_id']);

                ?>
                    
                     <tr><td class="tbp-question-list-header">Question [<?php echo $i++; ?>]<div class="btn-group pull-right">
                      <a href="edit-question1.php?question_id=<?php echo htmlentities($row['question_id']); ?>" ><button type="button" class="btn btn-primary" >Edit Question</button>
                      
                    </div><h4></td></tr>

                      </td>
                      </tr>
                    <tr id="ans_<?php echo $row['question_id'];?> asdsadsa " +  >
                    <td colspan="7"><?php echo get_question_answers_html($row['question_id']);?>  </td>
                    </tr>
                    </tr>
                    <div class="modal fade" id="confirm-delete-modal<?php echo htmlentities($row['exam_id']); ?>" tabindex="-1" role="dialog" aria- labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
                        </div>
                        <div class="modal-body">
                          <!-- /#mag decide pako -->
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          <a href="delete-questions.php?question_id=<?php echo $row["question_id"]; ?>" class="btn btn-primary">Yes</a>
                        </div>
                      </div>
                    </div>
                  </div><!


                <?php } ?>

                

              </tbody>
            </table>
        </div>
           
          </div>
        </div>
        
       

  </div><!-- /#page-wrapper -->

<?php include('../includes/layouts/footer.php'); ?>

<?php require_once("../includes/db-connection-close.php"); ?>