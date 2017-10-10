<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>

<?php $page = "assign-question.php"; ?>

<?php include('../includes/layouts/header.php'); ?>

<?php
  // If question does not exist, redirect back to Manage Questions Page
  $id = isset($_GET["question_id"]) ? $_GET["question_id"] : "";
  $question = get_question_by_id($id);
  if(!$question) { redirect_to("manage-questions.php"); }
?>

<?php
  
  if(isset($_POST['submit-assign-question'])) {

    // The Assign Question Form was submitted

      $_POST = array_map('mysql_real_escape_string',$_POST);

      $exam_title = $_POST['exam_title'];

      $query = "SELECT * FROM exam WHERE exam_title = '{$exam_title}' LIMIT 1";

      $result = mysqli_query($db, $query);

      if($result && mysqli_affected_rows($db) == 1) {
        $row = mysqli_fetch_assoc($result);
        $exam_id = $row["exam_id"];
        $query2 = "INSERT INTO exam_has_questions (exam_id, question_id) VALUES ( {$exam_id}, {$id} )";
        $result2 = mysqli_query($db, $query2);
        if($result2 && mysqli_affected_rows($db) != -1) {
          // Success
          $_SESSION["message"] = "Successfully assigned question id: {$id} to {$exam_title}!";
          redirect_to("manage-questions.php");
        } else {
          $_SESSION["message"] = "Question id: {$id} is already assigned to {$exam_title}!";
          redirect_to("manage-questions.php");
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
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">ITEM ANALYZER</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav.php'); ?>

      <ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>JELORD REY GULLE<b class="caret"></b></a>
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
        <h1>Assigning Question To A Quiz : <small>Control Panel</small></h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="icon-dashboard"></i> Dashboard</a></li>
          <li class="active"><i class="icon-file-alt"></i> Assign Question</li>
        </ol>
        <hr />
      </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->

    <!-- Display conditional error message -->
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
            <h3 class="panel-title"><strong>Assign Question</strong></h3>
          </div>
          <div class="panel-body">
             <form class="form" action="assign-question.php?question_id=<?php echo $id; ?>" method="post" role="form">
              <div class="row">
                <div class="col-lg-6">
                  <label class="control-label">Select a Quiz that you Would Like to Assign this Question to</label>
                  <div>
                  <select class="form-control" id="exam_title" name="exam_title">
                    <?php $query = "SELECT exam_title FROM exam"; 
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