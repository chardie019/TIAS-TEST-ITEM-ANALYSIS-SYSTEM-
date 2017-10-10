<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php include('../includes/layouts/header.php'); ?>

<?php $page = "new-question.php"; ?>

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
       <?php include('../includes/layouts/admin-head.php'); ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav.php'); ?>

           <?php include('../includes/layouts/admin-profile.php'); ?>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>
  <div id="page-wrapper">

    

    <!-- Display conditional messages and/or errors -->
    <?php $error_messages = errors(); ?>
   
    <?php echo user_form_info_msg(); ?>
    
      
      
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-lg-12 ">
        
            <div class="bs-example">
              <ul class="nav nav-tabs" style="margin-bottom: 10px;">
                <li class="active"><a href="#new-mc-question-form" data-toggle="tab">Multiple Choice</a></li>
              
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in col-lg-offset-1 col-lg-10" id="new-mc-question-form">
                  <p>
                    <form class="form-horizontal" action="process-new-mc-question.php" method="post">
                      <div class="form-group">
                        <div class="col-sm-200">
                        <label for="question_text">QUESTION</label>
                        <textarea class="form-control ckeditor " rows="3" id="question_text" name="question_text" value="<?php echo isset($form_values['question_text']) ? $form_values['question_text'] : '' ?>"placeholder="Ex. What color is an apple?" class="input-xlarge"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                       <div class="col-sm-12 label label-success">
                       <label for="answer1 control-label" class="pull-left">CHOICE A</label>
                        <textarea class="form-control" rows="1" id="answer1" name="answer1" value="<?php echo isset($form_values['answer_text']) ? $form_values['answer_text'] : '' ?>"placeholder="" class="input-xlarge"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-13">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked1" value="1" checked>
                            Is Correct ✓
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12 label label-success">
                       <label for="answer1 control-label" class="pull-left">CHOICE B</label>
                        <textarea class="form-control" rows="1" id="answer2" name="answer2" value="<?php echo isset($form_values['answer_text']) ? $form_values['answer_text'] : '' ?>"class="input-xlarge"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-13">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked2" value="2">
                            Is Correct ✓
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12 label label-success">
                       <label for="answer1 control-label" class="pull-left">CHOICE C</label>
                        <textarea class="form-control" rows="1" id="answer3" name="answer3" value="<?php echo isset($form_values['answer_text']) ? $form_values['answer_text'] : '' ?>" class="input-xlarge"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-13">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked3" value="3">
                            Is Correct ✓
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12 label label-success">
                       <label for="answer1 control-label" class="pull-left">CHOICE D</label>
                        <textarea class="form-control" rows="1" id="answer4" name="answer4" value="<?php echo isset($form_values['answer_text']) ? $form_values['answer_text'] : '' ?>" class="input-xlarge"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-13">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked4" value="4">
                            Is Correct ✓
                          </label>
                        </div>
						</div>
						 <div class="form-group">
                       <div class="col-sm-12 label label-success">
                       <label for="answer1 control-label" class="pull-left">CHOICE E</label>
                        <textarea class="form-control" rows="1" id="answer5" name="answer5" value="<?php echo isset($form_values['answer_text']) ? $form_values['answer_text'] : '' ?>" class="input-xlarge"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-13">
                          <label class="text-info">
                            <input type="radio" name="ischecked" id="ischecked5" value="5">
                            Is Correct ✓  
                          </label>
                        </div>
                      </div>
                      
                      

                      <!-- Button -->
                      <div class="col-sm-offset-10 col-sm-2">
                        <label for="submit-new-mc-question"></label>
                          <button type ="submit" id="submit-new-mc-question" name="submit-new-mc-question" value="submit-new-mc-question" class="btn btn-primary pull-right tbp-flush-right">Create Question</button>
                      </div>

                    </form>
                  </p>
                </div>
                <div class="tab-pane fade col-lg-offset-1 col-lg-6" id="new-essay-question-form">
                  <p>
                    <form class="form-horizontal" action="process-new-user.php" method="post">
                      <div class="form-group">
                        <div class="col-sm-12">
                            
                  </p>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div><!-- /#page-wrapper -->
<script type="text/javascript" src="plugins/ckeditor/ckeditor.js"></script>
<script>
  function resetNewUserForm() {
    location.reload();
  }
</script>
<?php include('../includes/layouts/footer.php'); ?>
<?php require_once("../includes/db-connection-close.php"); ?>