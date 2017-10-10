<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>

<?php $page = "edit-user.php"; ?>

<?php include('../includes/layouts/header.php'); ?>

<?php
  
  $id = isset($_GET["user_id"]) ? $_GET["user_id"] : "";
  $user = get_user_by_id2($id);
  if(!$user) { redirect_to("manage-users.php"); }
?>

<?php
  
  if(isset($_POST['submit-edit-user'])) {

   
    $fields_with_max_lengths = array("first_name" => 30, "middle_name" => 30,
                                      "last_name" => 20, "username" => 30, "password" => 16);
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!value_within_range($value, 1, $max)) {
        $error_messages[$field] = ucfirst($field) . " is too long.";
      }
    }

    $fields_required = array("first_name", "middle_name", "last_name",
                              "username", "password");
    foreach($fields_required as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)) {
        $error_messages[$field] = ucfirst($field) . " is required.";
      }
    }

   

    // If there are no errors, proceed with the update.
    if(empty($error_messages)) {

      $_POST = array_map('mysql_real_escape_string',$_POST);

      $user_id      = $id;
      $first_name   = $_POST['first_name'];
      $last_name    = $_POST['middle_name'];
      $username     = $_POST['last_name'];
      $email        = $_POST['username'];
      $password     = $_POST['password'];
      $user_type    = $_POST['user_type'];
      $status       = $_POST['status'];

      $query  = "UPDATE accounts SET ";
      $query .= "Firstname = '{$first_name}', ";
      $query .= "Middlename = '{$last_name}', ";
      $query .= "Lastname = '{$username}', ";
      $query .= "Username = '{$email}', ";
      $query .= "Password = '{$password}', ";
      $query .= "Usertype = '{$user_type}', ";
       $query .= "status = '{$status}' ";
      $query .= "WHERE Account_id = {$user_id} ";
      $query .= "LIMIT 1";

      $result = mysqli_query($db, $query);

      if($result && mysqli_affected_rows($db) == 1) {
        // Success
        $_SESSION["message"] = "Successfully updated user: {$username}!";
        redirect_to("manage-users.php");
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
      <a class="navbar-brand" href="index.php">Item Analyzer</a>
    </div>

  
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav1.php'); ?>

           <?php include('../includes/layouts/admin-profile1.php'); ?>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <div id="page-wrapper">


    <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-info">
              <div class="panel-heading">
             
                <h3 class="panel-title">USER UPDATE - CONTROL PANEL</h3><small>
              </div>
              <div class="panel-body">
       <div>
      


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
      <div class="col-lg-offset-1 col-lg-4">
        
        <form class="form-horizontal" action="edit-user.php?user_id=<?php echo $user["Account_id"]; ?>" method="post">
          <!-- Text input-->
          <div class="form-group">
            <label for="first_name">FIRSTNAME</label>
              <input class="form-control" id="first_name" name="first_name" value="<?php echo $user["Firstname"]; ?>" type="text" placeholder="Enter First Name" class="input-xlarge">
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label for="last_name">MIDDLENAME</label>
              <input class="form-control" id="middle_name" name="middle_name" value="<?php echo $user["Middlename"]; ?>" type="text" placeholder="Enter Last Name" class="input-xlarge">
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label for="email">LASTNAME</label>
              <input class="form-control" id="last_name" name="last_name" value="<?php echo $user["Lastname"]; ?>" type="text" placeholder="Enter Lastname" class="input-xlarge">
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label for="username">USERNAME</label>
              <input class="form-control" id="username" name="username" value="<?php echo $user["Username"]; ?>" type="text" placeholder="Create a Username" class="input-xlarge">
          </div>

          <!-- Password input-->
          <div class="form-group">
            <label for="password">PASSWORD</label>
              <input class="form-control" id="password" name="password" type="password" value="<?php echo $user["Password"]; ?>"placeholder="Create a Password" class="input-xlarge">
          </div>

         
          <div class="form-group">
            <label for="user_type">USERTYPE :</label>
              <select readonly class="form-control" id="user_type" name="user_type" class="input-xlarge" value="<?php echo $user["Usertype"]; ?>">
               
                <option value="teacher" <?php if($user["Usertype"] == "teacher") { echo "selected"; } ?> >Teacher</option>
                 <option value="admin" <?php if($user["Usertype"] == "admin") { echo "selected"; } ?> >Administrator</option>
                 

                


                
              </select>
          </div>
          <div class="form-group">
            <label for="user_type">STATUS : </label>
              <select class="form-control" id="status" name="status" class="input-xlarge" value="<?php echo $user["status"]; ?>">
                <option value="1" <?php if($user["status"] == "1") { echo "selected"; } ?> >ACTIVATE</option>
                <option value="0" <?php if($user["status"] == "0") { echo "selected"; } ?> >DEACTIVATE</option>
                
              </select>
          </div>

          <!-- Button (Double) -->
          <div class="form-group pull-right">
            <label for="submit-edit-user"></label>
              <button type ="submit" id="submit-edit-user" name="submit-edit-user" value="submit-edit-user" class="btn btn-primary">Update User</button>
              <a href="manage-users.php" id="cancel-edit-user" name="cancel-edit-user" class="btn btn-default">Cancel</a>
              <!-- Button trigger modal -->
              
          </div>
        </form>

        <!-- Confirm Deletion Modal -->
        <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
              </div>
              <div class="modal-body">
                You are about to delete a user. This action will be irreversible.<br />
                Do you wish to proceed?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a href="delete-user.php?user_id=<?php echo $user["Account_id"]; ?>" class="btn btn-primary">Yes</a>
              </div>
            </div>
          </div>
        </div><!-- /.modal fade -->

      </div><!-- /.col-lg-6 -->

    </div><!-- /.row -->

  </div><!-- /#page-wrapper -->

<?php include('../includes/layouts/footer.php'); ?>
<?php require_once("../includes/db-connection-close.php"); ?>