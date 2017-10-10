
<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php include('../includes/layouts/header.php'); ?>

<?php $page = "new-user.php"; ?>

<body>

<div id="wrapper">

  
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <?php include('../includes/layouts/admin-head2.php'); ?>
    </div>

    
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav1.php'); ?>

      
           <?php include('../includes/layouts/admin-profile1.php'); ?>
        </li>
      </ul>
    </div>
  </nav>
  <div id="page-wrapper">

    <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Creating Account- Control Panel</h3><small>
              </div>
              <div class="panel-body">
       <div>

  
    <?php $error_messages = errors(); ?>
    <?php $form_values = form_history() ?>
    <?php echo display_form_errors($error_messages); ?>
    <?php echo user_form_info_msg(); ?>
    <?php echo user_form_failure_msg(); ?>
      
      
      <div class="clearfix"></div>
      <div class="col-lg-offset-1 col-lg-4">
        
        <form class="form-horizontal" action="process-new-user.php" method="post">
          <!-- Text input-->
		  
          <div class="form-group">
            <label for="first_name">Firstname</label>
              <input class="form-control" id="first_name" name="first_name" value="<?php echo isset($form_values['first_name']) ? $form_values['first_name'] : '' ?>" type="text" placeholder="Enter First Name" class="input-xlarge">
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label for="middle_name">Middlename</label>
              <input class="form-control" id="middle_name" name="middle_name" value="<?php echo isset($form_values['middle_name']) ? $form_values['middle_name'] : '' ?>" type="text" placeholder="Enter Your middle_name" class="input-xlarge">
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label for="last_name">Lastname</label>
              <input class="form-control" id="last_name" name="last_name" value="<?php echo isset($form_values['last_name']) ? $form_values['last_name'] : '' ?>" type="text" placeholder="Enter Your Lastname" class="input-xlarge">
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label for="username">Username</label>
              <input class="form-control" id="username" name="username" value="<?php echo isset($form_values['username']) ? $form_values['username'] : '' ?>" type="text" placeholder="Create a Username" class="input-xlarge">
          </div>

          <!-- Password input-->
          <div class="form-group">
            <label for="password">Password</label>
              <input class="form-control" id="password" name="password" type="password" placeholder="Create a Password" class="input-xlarge">
          </div>

           
              <input class="form-control" type="hidden" id="status" name="status" value="ACTIVE">
        


          <!-- Select Basic -->
          <div class="form-group">
            <label for="user_type">Select User Type</label>
              <select class="form-control" id="user_type" name="user_type" class="input-xlarge" value="">
                <option value="admin">Administrator</option>
                <option value="teacher">Teacher</option>
              </select>
			  <div>
			 
			 
			   <label for="first_name">Identification Number: </label>
              <input class="form-control" style="width: 175px;" id="id_number" name="id_number" value="<?php echo isset($form_values['id_number']) ? $form_values['id_number'] : '' ?>" type="text" placeholder="Your ID Number" class="input-xlarge">	
         
		</div>

          <!-- Button (Double) -->
          <div class="form-group pull-right">
		  
            <label for="submit-new-user"></label>
			<div>
			
              <button type ="submit" id="submit-new-user" name="submit-new-user" value="submit-new-user" class="btn btn-primary">Create</button>
              <button id="reset-new-user" name="reset-new-user" onclick="resetNewUserForm()" class="btn btn-default">Reset</button>
        
       

<script>
  function resetNewUserForm() {
    location.reload();
  }
</script>
<?php include('../includes/layouts/footer.php'); ?>
<?php require_once("../includes/db-connection-close.php"); ?>