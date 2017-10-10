<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>

<?php include('../includes/layouts/header.php'); ?>

<?php $page = "assign-question.php"; ?>

<?php
$check = "";
if(isset($_POST['assign-question']))
{
    $checkwithoutdiscard  = remove_discarded_question($_POST['check']);
    $check = implode(",", $checkwithoutdiscard);
}
if($_SESSION["get_query"] != "")
$redirect_url = "manage-questions.php?".$_SESSION["get_query"];
else
$redirect_url = "manage-questions.php";
  
  $id = isset($_GET["question_id"]) ? $_GET["question_id"] : "";
  if($id != ""){
    $question = get_question_by_id($id);
    if(!$question) { redirect_to($redirect_url); }
  }
?>

<?php
  
  if(isset($_POST['submit-assign-question'])) {
    
      $_POST = array_map('addslashes',$_POST);
      $_POST = array_map('htmlentities',$_POST);
      $exam_title   = $_POST['exam_title'];
      $query = "SELECT * FROM exam WHERE exam_title = '{$exam_title}' LIMIT 1";
      $result = mysqli_query($db, $query);
      if($result && mysqli_affected_rows($db) == 1) {
        $row = mysqli_fetch_assoc($result);
         $exam_id = $row["exam_id"];
        if(isset($_POST['question_ids']) && $_POST['question_ids'] != "")
        {
            $check = explode(",", $_POST['question_ids']);
            foreach($check as $c)
            {
                $query2 = "INSERT INTO exam_has_questions (exam_id, question_id) VALUES ( {$exam_id}, {$c} )";
                $result2 = mysqli_query($db, $query2);
            }
            $_SESSION["message"] = "Question id: {$_POST['question_ids']} is assigned to {$exam_title}!";
            redirect_to($redirect_url);
        }
        if($id != "")
        {
            $query2 = "INSERT INTO exam_has_questions (exam_id, question_id) VALUES ( {$exam_id}, {$id} )";
            $result2 = mysqli_query($db, $query2);
            if($result2 && mysqli_affected_rows($db) != -1) {
              
              $_SESSION["message"] = "Successfully assigned question id: {$id} to {$exam_title}!";
              redirect_to($redirect_url);
            } else {
              $_SESSION["message"] = "Question id: {$id} is already assigned to {$exam_title}!";
              redirect_to($redirect_url);
            }
        }
        
      }
  } else {
    // Do nothing. Re-display the Assign Question Form.
  } 
?>


<body>

<div id="wrapper">

  <!-- Sidebar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include('../includes/layouts/admin-head.php'); ?>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav.php'); ?>

      <?php include('../includes/layouts/admin-profile.php'); ?>
    </div><!-- /.navbar-collapse -->
  </nav>
  <div id="page-wrapper">

  
    <?php 
      if(!empty($message)) { 
    
        echo "<div class=\"alert alert-dismissable alert-danger col-lg-4 col-lg-offset-1 pull-left\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>";
        echo "<strong><?php echo $message; ?></strong>";
        echo "</div>";
      }
    ?>
    <?php echo display_form_errors($error_messages); ?>
  
      <div class="clearfix"></div>
        <div class="panel tbp-panel-inverse">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>SELECT FROM THE LIST</strong></h3>
          </div>
          <div class="panel-body">
             <form class="form" action="assign-question.php?question_id=<?php echo $id; ?>" method="post" role="form">
              <div class="row">
                <input type="hidden" name="question_ids" value ="<?php echo $check;?>">
                <div class="col-lg-6">
                  <label class="control-label">Select a Quiz that you Would Like to Assign this Question to</label>
                  <div>
                  <select class="form-control" id="exam_title" name="exam_title">
                    <?php 
                    $kiking = $_SESSION['user']['Username'];
                    $query = "SELECT exam_title FROM exam where Created_By = '{$kiking}'"; 
                      $result = mysqli_query($db, $query);
                      while ( $quiz_names_array = mysqli_fetch_array($result, MYSQLI_ASSOC) )
                      {
                         echo "<option value='".$quiz_names_array["exam_title"]."'>".htmlspecialchars($quiz_names_array["exam_title"])."</option>";
                      }
                    ?>
                  </select>

                  </div>
                </div>
              </div>
              <br />
              <div class="col-lg-6">
              <div class="form-group pull-right">
                <a href="manage-questions.php" id="cancel-assign-question" name="cancel-assign-question" class="btn btn-default">Cancel</a>
                <button type="submit" id="submit-assign-question" name="submit-assign-question" value="submit-assign-question" 
                  class="btn btn-primary">Assign Question Now</button>
              </div>
            </div>
            </form>
          </div>
      </div>
        
       

  </div><!-- /#page-wrapper -->

<?php include('../includes/layouts/footer.php'); ?>
<?php require_once("../includes/db-connection-close.php"); ?>
