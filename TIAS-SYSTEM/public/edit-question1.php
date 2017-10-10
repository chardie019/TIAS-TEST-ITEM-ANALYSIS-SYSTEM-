<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>

<?php $page = "edit-question1.php"; 

if(isset($_SESSION["get_query"]) && $_SESSION["get_query"] != "")
$redirect_url = "manage-questions.php?".$_SESSION["get_query"];
else
$redirect_url = "manage-questions.php";
?>

<?php include('../includes/layouts/header.php'); ?>
<?php

 $id = isset($_REQUEST["question_id"]) ? $_REQUEST["question_id"] : ""; 
  
  $question = get_question_by_id($id);

  if(!$question) { redirect_to("manage-questions.php"); }
  $answer_set = get_question_answers($id);
?>

<?php
  
 

  if(isset($_POST['submit-edit-mc-question'])) {

  
    

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

      redirect_to("manage-questions.php");
    }

  
    $_POST = array_map('mysql_real_escape_string',$_POST);

    $question_id      = $_GET['question_id'];
  
    $question_text    =  $_POST['question_text'];
    $answer1          = $_POST['answer1'];
    $answer2          = $_POST['answer2'];
    $answer3          = $_POST['answer3'];
    $answer4          = $_POST['answer4'];
    $answer5          = $_POST['answer5'];
  
    $cb             = $_SESSION['user']['Username']; 
    $revised2         = 0; 

    
    

    $query  = "UPDATE question SET ";
    $query .= "question_text = '{$question_text}', ";
    $query .= "Created_By = '{$cb}',";
    $query .= "is_discarded = '{$revised2}'";
    $query .= "WHERE question_id = {$question_id} ";
    $query .= "LIMIT 1";

    $result = mysqli_query($db, $query);

    if ( false === $result ) {
     
      printf("error: %s\n", mysqli_error($db)); 
      $_SESSION["error_message"] = mysqli_error($db).". In edit-question1.php @ query.";
      redirect_to("manage-questions.php");

    } 


    $ischecked == false;
      
   
    if($_POST['ischecked'] == '1') { $ischecked = true; }

    $query1  = " UPDATE answer SET ";
    $query1 .= "answer_text = '{$answer1}', ";
    $query1 .= "question_id = '{$question_id}', ";
    $query1 .= "is_correct = '{$ischecked}' ";
    $query1 .= "WHERE answer_id = {$answer_set[0]['answer_id']} ";
    $query1 .= "LIMIT 1";
    

    $result1 = mysqli_query($db, $query1);

    if ( false === $result1 ) {
      
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = mysqli_error($db).". In edit-question1.php @ query1.";
      redirect_to("manage-questions.php");
    }  


    $ischecked = false; 

   
    if($_POST['ischecked'] == '2') { $ischecked = true; }

    $query2  = " UPDATE answer SET ";
    $query2 .= "answer_text = '{$answer2}', ";
    $query2 .= "question_id = '{$question_id}', ";
    $query2 .= "is_correct = '{$ischecked}' ";
    $query2 .= "WHERE answer_id = {$answer_set[1]['answer_id']} ";
    $query2 .= "LIMIT 1";

    $result2 = mysqli_query($db, $query2);

    if ( false === $result2 ) {
   
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = mysqli_error($db).". In edit-question1.php @ query2.";
      redirect_to("manage-questions.php");
    }

    $ischecked = false;

    if($_POST['ischecked'] == '3') { $ischecked = true; }

    $query3  = " UPDATE answer SET ";
    $query3 .= "answer_text = '{$answer3}', ";
    $query3 .= "question_id = '{$question_id}', ";
    $query3 .= "is_correct = '{$ischecked}' ";
    $query3 .= "WHERE answer_id = {$answer_set[2]['answer_id']} ";
    $query3 .= "LIMIT 1";

    $result3 = mysqli_query($db, $query3);

    if ( false === $result3 ) {
      // Query failed. Print out information.
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = mysqli_error($db).". In edit-question1.php @ query3.";
      redirect_to("manage-questions.php");
    }

    $ischecked = false;

 
    if($_POST['ischecked'] == '4') { $ischecked = true; }

    $query4  = "UPDATE answer SET ";
    $query4 .= "answer_text = '{$answer4}', ";
    $query4 .= "question_id = '{$question_id}', ";
    $query4 .= "is_correct = '{$ischecked}' ";
    $query4 .= "WHERE answer_id = {$answer_set[3]['answer_id']} ";
    $query4 .= "LIMIT 1";

    $result4 = mysqli_query($db, $query4);

    if ( false === $result4 ) {
     
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = mysqli_error($db).". In edit-question1.php @ query4.";
      redirect_to("manage-questions.php");
    }  
  
	  $ischecked = false;

    if($_POST['ischecked'] == '5') { $ischecked = true; }

    $query5  = "UPDATE answer SET ";
    $query5 .= "answer_text = '{$answer5}', ";
    $query5 .= "question_id = '{$question_id}', ";
    $query5 .= "is_correct = '{$ischecked}' ";
    $query5 .= "WHERE answer_id = {$answer_set[4]['answer_id']} ";
    $query5 .= "LIMIT 1";

    $result5 = mysqli_query($db, $query5);

    if ( false === $result5 ) {
     
      printf("error: %s\n", mysqli_error($db));
      $_SESSION["error_message"] = mysqli_error($db).". In edit-question1.php @ query5.";
      redirect_to("manage-questions.php");
    }  

	  $ischecked = false;


    
    $_SESSION["message"] = "Successfully updated !";
    redirect_to("manage-questions.php");
    

  } else {
    
    
  } 
?>

<body >

<div id="wrapper">

  <!-- Sidebar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
 
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
      
    

               
                
              </select>
          </div>

    <div class="clearfix"></div>
      <div class="row">
        <div class="col-lg-12 ">
         
            <div class="bs-example">
              <ul class="nav nav-tabs" style="margin-bottom: 10px;">
                <li class="active"><a href="  #new-mc-question-form" data-toggle="tab">Multiple Choice  </a> </li> 

          </div>
              
              </ul>
             
             
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in col-lg-offset-1 col-lg-10" id="new-mc-question-form">
                  <p>
                    <form class="form-horizontal" action="edit-question1.php?question_id=<?php echo $_GET["question_id"]; ?>" method="post">
                      <form class="form-horizontal" action="process-new-mc-question.php" method="post">
                      <div class="form-group">
                        <div class="col-sm-200">
                        <label for="question_text">Question Text</label>
                        <textarea class="form-control ckeditor" rows="3" id="question_text" name="question_text"  placeholder="Ex. What color is an apple?" class="input-xlarge"><?php echo $question["question_text"] ?></textarea>
                        </div>
                        <br>
                       


                      </div>
                      <div class="form-group ">
                        <div class="col-sm-12 label label-success">
                        <label for="answer1 control-label" class="pull-left">CHOICE A</label>
                        <textarea class="form-control " rows="1" id="answer1" name="answer1" placeholder="Ex. Orange" class="input-xlarge"><?php echo $answer_set[0]["answer_text"]; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked1" value="1" <?php echo ($answer_set[0]["is_correct"] == 1) ? "checked" : ""; ?>>
                            Is Correct ✓
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12 label label-success">
                       <label for="answer1 control-label" class="pull-left">CHOICE B</label>
                        <textarea class="form-control" rows="1" id="answer2" name="answer2" placeholder="Ex. Red" class="input-xlarge"><?php echo $answer_set[1]["answer_text"]; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group ">
                        <div class="col-sm-12 ">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked2" value="2" <?php echo ($answer_set[1]["is_correct"] == 1) ? "checked" : ""; ?>>
                            Is Correct ✓
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12 label label-success">
                     <label for="answer1 control-label" class="pull-left">CHOICE C</label>
                        <textarea class="form-control" rows="1" id="answer3" name="answer3" placeholder="Ex. Green" class="input-xlarge"><?php echo $answer_set[2]["answer_text"]; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked3" value="3" <?php echo ($answer_set[2]["is_correct"] == 1) ? "checked" : ""; ?>>
                            Is Correct ✓
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12 label label-success">
                       <label for="answer1 control-label" class="pull-left">CHOICE D</label>
                        <textarea class="form-control" rows="1" id="answer4" name="answer4" placeholder="Ex. Red or Green" class="input-xlarge"><?php echo $answer_set[3]["answer_text"]; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked4" value="4" <?php echo ($answer_set[3]["is_correct"] == 1) ? "checked" : ""; ?>>
                            Is Correct ✓
                          </label>
                        </div>
                      </div>
                       <div class="form-group">
                        <div class="col-sm-12 label label-success">
                      <label for="answer1 control-label" class="pull-left">CHOICE E</label>
                        <textarea class="form-control" rows="1" id="answer5" name="answer5" placeholder="Ex. Red or Green" class="input-xlarge"><?php echo $answer_set[4]["answer_text"]; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked5" value="5" <?php echo ($answer_set[4]["is_correct"] == 1) ? "checked" : ""; ?>>
                            Is Correct ✓
                          </label>
                        </div>

                   

                      <div class="form-group pull-right">
                        <label for="submit-edit-mc-question"></label>
                          <button type ="submit" id="submit-edit-mc-question" name="submit-edit-mc-question" value="submit-edit-mc-question" class="btn btn-primary">Update Question</button>
                          <a href="manage-questions.php" id="cancel-edit-question" name="cancel-edit-question" class="btn btn-default">Cancel</a>
                        
                          <a class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-modal">Delete Question</a> 
                      </div>

                     
                      <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
                            </div>
                            <div class="modal-body">
                              You are about to delete a question and ALL its associated answers. This action will be irreversible.<br />
                              Do you wish to proceed?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              <a href="delete-questions.php?question_id=<?php echo $_GET["question_id"]; ?>" class="btn btn-primary">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>

                    </form>
                  </p>
                </div>
                <div class="tab-pane fade col-lg-offset-1 col-lg-6" id="new-essay-question-form">
                  <p>
                    <form class="form-horizontal" action="process-new-user.php" method="post">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <label for="first_name">Question Text</label>
                        <textarea class="form-control" rows="4" id="question-text" name="question-text" value="<?php echo isset($form_values['question_text']) ? $form_values['question_text'] : '' ?>"
                          placeholder='Ex. If a six-string guitar is tuned in Standard E, what notes would each string be tuned to? List them from the lowest pitch to the highest.' class="input-xlarge"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                        <label for="answer1 control-label">Answer 1</label>
                        <textarea class="form-control" rows="10" id="answer1" name="answer1" value="<?php echo isset($form_values['answer_text']) ? $form_values['answer_text'] : '' ?>"
                          placeholder="Ex. E, A, D, G, B, E." class="input-xlarge"></textarea>
                        </div>
                      </div>

                      <div class="form-group pull-right">
                        <label for="submit-new-user"></label>
                        <button type ="submit" id="submit-edit-question" name="submit-edit-question" value="submit-edit-question" class="btn btn-primary">Update Question</button>
                        <a href="manage-questions.php" id="cancel-edit-question" name="cancel-edit-question" class="btn btn-default">Cancel</a>
                        <!-- Button trigger modal -->
                        <a class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-modal">Delete Question</a> 
                      </div>

                    </form>
                  </p>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div><!-- /#page-wrapper -->
<script type="text/javascript" src="plugins/ckeditor/ckeditor.js"></script>
<?php include('../includes/layouts/footer.php'); ?>
<?php require_once("../includes/db-connection-close.php"); ?>