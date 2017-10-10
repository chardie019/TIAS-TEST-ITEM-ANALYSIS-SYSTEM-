<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>

<?php $page = "edit-quiz.php"; ?>

<?php include('../includes/layouts/header.php'); ?>





<?php
  // If quiz does not exist, redirect back to Manage Quizzes Page
  $id = isset($_GET["quiz_id"]) ? $_GET["quiz_id"] : "";
  $quiz = get_quiz_by_id($id);


  if(!$quiz) { redirect_to("manage-quizzes.php"); }
?>

<?php

 
  
  if(isset($_POST['submit-edit-quiz'])) { 

    // The Edit Quiz Form was submitted

    // Validate Edit Quiz Form inputs
    $fields_with_max_lengths = array("exam_name" => 100, "category" => 100,
                                      "subject" => 50, "passing" => 50 );
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!value_within_range($value, 1, $max)) {
        $error_messages[$field] = ucfirst($field) . " is too long.";
      }
    }

    $fields_required = array("exam_name", "category", "subject" , "passing");
    foreach($fields_required as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)) {
        $error_messages[$field] = ucfirst($field) . " is required.";
      }
    }


    // If there are no errors, proceed with the update.
    if(empty($error_messages)) {

      $_POST = array_map('mysql_real_escape_string',$_POST);

      $quiz_id      = $id;
      $exam_name    = $_POST['exam_name'];
      $category     = $_POST['category'];
      $subject    = $_POST['subject'];
      $passing     = $_POST['passing'];


      
      if(!has_presence($subject)) {
        $query  = "UPDATE examination_details SET ";
        $query .= "Exam_name = '{$exam_name}', ";
        $query .= "Exam_Category = '{$category}', ";
        $query .= "Subject = NULL, ";
        $query .= "Passing_Score= '{$passing}' ";
        $query .= "WHERE Exam_id = {$quiz_id} ";
        $query .= "LIMIT 1";
      } else {
        $query  = "UPDATE examination_details SET ";
        $query .= "Exam_name = '{$exam_name}', ";
        $query .= "Exam_Category = '{$category}', ";
        $query .= "Subject = '{$subject}', ";
        $query .= "Passing_Score = '{$passing}' ";
        $query .= "WHERE Exam_id = {$quiz_id} ";
        $query .= "LIMIT 1";
      }
      
      
      

      $result = mysqli_query($db, $query); 

      if($result && mysqli_affected_rows($db) != -1) {
        // Success
        $_SESSION["message"] = "Successfully updated quiz: {$Exam_name}!";
        redirect_to("manage-quizzes.php");
      } else {
        // Failure
        $message = "Database insertion failure";
        
      }
    }

  } else {
    // Do nothing. Re-display the Edit User Form.
  } 
?>

<body>

<div id="wrapper">

  <!-- Sidebar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Test Builder Pro - Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav.php'); ?>

      <ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
            <li class="divider"></li>
            <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>
  <div id="page-wrapper">

    <div class="row">
      <div class="col-lg-12">
        <h1>Edit Quiz: <small><?php echo $quiz['Exam_name']; ?></small></h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="icon-dashboard"></i> Dashboard</a></li>
          <li class="active"><i class="icon-file-alt"></i> Edit Quiz</li>
        </ol>
        <hr />
      </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->

    <!-- Display conditional error message -->

    <?php echo display_form_errors($error_messages); ?>

<?php if(!empty($_POST)) { print_r($_POST); } ?>
<?php if(!empty($error_messages)) { print_r($error_messages); } ?>
<?php if(!empty($message)) { print_r($message); } ?>



      
      <div class="col-lg-12">

      
        <div class="panel tbp-panel-inverse">
          <div class="panel-heading">
            <?php $linked_questions = get_quiz_questions($id); ?>
            <h4><?php echo $quiz["Exam_name"]; ?><span> - There are <?php echo mysqli_num_rows($linked_questions); ?> Questions Linked to this Quiz.</span></h4>
          </div>
          <div class="panel-body">

              <form id="edit-quiz-form"  role="form" action="edit-quiz.php?quiz_id=<?php echo $quiz["question_id"]; ?>" method="post">
                <div class="form-group col-lg-3">
                  <label for="quiz_name" class="control-label">Examination Name</label>
                  <input type="text" class="form-control" id="exam_name" value="<?php echo $quiz["Exam_name"]; ?>" name="exam_name" placeholder="Quiz Name">
                </div>
                <div class="form-group col-lg-3">
                  <label for="category" class="control-label">Examination Category</label>
                  <input type="text" class="form-control" id="category" value="<?php echo $quiz["Exam_Category"]; ?>" name="category" placeholder="Mathematics">
                </div>
                <div class="form-group col-lg-3">
                  <label for="deadline" class="control-label">Subject</label>
                  <input type="text" class="form-control" id="subject" value="<?php echo $quiz["Subject"]; ?>" name="subject" placeholder="Math 61">
                </div>
                <div class="form-group col-lg-3">
                  <label for="attempts" class="control-label">Passing Score</label>
                    <input type="text" class="form-control" id="passing" value="<?php echo $quiz["Passing_Score"]; ?>" name="passing" placeholder="1">
                </div>
                  <button type="submit" class="btn btn-primary pull-right" id="submit-edit-quiz" name="submit-edit-quiz" value="submit-edit-quiz">Save Changes</button>
                </div>-->
                
                
                    <!-- Split button -->
                    <div class="btn-group pull-right">
                      <button type="button" class="btn btn-primary">Add Questions</button>
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">New Question</a></li>
                        <li><a href="#">From Existing Questions</a></li>
                      </ul>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right margin-right-10" id="submit-edit-quiz" name="submit-edit-quiz" value="submit-edit-quiz">Save Changes</button>
                    <a href="manage-quizzes.php" id="cancel-edit-quiz" name="cancel-edit-quiz" class="btn btn-default pull-right margin-right-10">Cancel</a>
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
                    
                    <tr><td class="tbp-question-list-header">Question <?php echo $i++; ?><h4></td></tr>
                    <tr><td><h4 class="tbp-question-list-body"><?php echo $current_question['question_text']; ?></h4></td></tr>
                    <tr>
                      <td>
                        <ul class="text-info tbp-question-list-links"><li><a href="#">Answers</a></li><li>|</li><li><a href="#">Used In</a></li><li class="pull-right"><i class="fa fa-minus"></i> <a href="#">Remove from Test</a></li></ul>
                      </td>
                    </tr>



                <?php } ?>

                

              </tbody>
            </table>
        </div>
           
          </div>
        </div>
        
       

  </div><!-- /#page-wrapper -->

<?php include('../includes/layouts/footer.php'); ?>

<?php require_once("../includes/db-connection-close.php"); ?>