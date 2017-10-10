<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php include('../includes/layouts/header.php'); ?>

<?php $page = "changeaccount.php"; ?>

<?php
  
  $id = isset($_GET["user_id"]) ? $_GET["user_id"] : "";
  $user = get_user_by_id2($id);
  if(!$user) { redirect_to("manage-users.php"); }
?>

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
      $middle_name    = $_POST['middle_name'];
      $last_name     = $_POST['last_name'];
      $username       = $_POST['username'];
      $password     = $_POST['password'];
      $user_type    = "teacher";
      $status       = $_POST['status'];

      $query  = "UPDATE accounts SET ";
      $query .= "Firstname = '{$first_name}', ";
      $query .= "Middlename = '{$middle_name}', ";
      $query .= "Lastname = '{$last_name}', ";
      $query .= "Username = '{$username}', ";
      $query .= "Password = '{$password}', ";
      $query .= "Usertype = '{$user_type}', ";
       $query .= "status = '{$status}' ";
      $query .= "WHERE Account_id = {$user_id} ";
      $query .= "LIMIT 1";

      $result = mysqli_query($db, $query);

      if($result && mysqli_affected_rows($db) == 1) {
        // Success
        $_SESSION["message"] = "Successfully updated user: {$username}!";
        redirect_to("myaccount.php");
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

  
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
   <?php include('../includes/layouts/admin-head.php'); ?>
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
              <div class="">
                <div class="panel-heading">
                
                </div>
                <div class="panel-body">
                
                </div>
              </div>  
          
          </ol>
        </div>
      </div>
    <?php 
      if(!empty($message)) { 
    
        echo "<div class=\"alert alert-dismissable alert-danger col-lg-4 col-lg-offset-1 pull-left\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>";
        echo "<strong><?php echo $message; ?></strong>";
        echo "</div>";
      }
    ?>
    <?php echo display_form_errors($error_messages); ?>





      <div class="clearfix "></div>
        <div class="panel tbp-panel-inverse pull-left">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>CHANGE PASSWORD</strong></h3>
          </div>
          <div class="panel-body">
 <form class="form-horizontal" action="changeaccount.php?user_id=<?php echo $user["Account_id"]; ?>" method="post">
          <!-- Text input-->
              <div class="form-group">
                <div class="col-lg-12"
              <div class="form-group">
            
            <label for="first_name">FIRSTNAME</label>
              <input readonly class="form-control" id="first_name" name="first_name" value="<?php echo $user["Firstname"]; ?>" type="text" placeholder="Enter First Name" class="input-xlarge readonly">
          </div>
              
                 <div class="col-lg-12"
                <div class="form-group">
            <label for="last_name">MIDDLENAME</label>
              <input readonly  class="form-control" id="middle_name" name="middle_name" value="<?php echo $user["Middlename"]; ?>" type="text" placeholder="Enter Last Name" class="input-xlarge readonly">
          </div>
             <div class="col-lg-12"
                <div class="form-group">
                 <label for="email">LASTNAME</label>
              <input readonly  class="form-control" id="last_name" name="last_name" value="<?php echo $user["Lastname"]; ?>" type="text" placeholder="Enter Lastname" class="input-xlarge readonly">
          </div>
                        
                    <div class="col-lg-12"
              
                < <div class="form-group">
            <label for="username">USERNAME</label>
              <input readonly  class="form-control" id="username" name="username" value="<?php echo $user["Username"]; ?>" type="text" placeholder="Create a Username" class="input-xlarge readonly">
          </div>
                     <div class="col-lg-12"
                    <div class="form-group">
            <label for="password">PASSWORD</label>
              <input style="color:red;" class="form-control" id="password" name="password" type="password" value="<?php echo $user["Password"]; ?>"placeholder="Create a Password" class="input-xlarge">
          </div>
                    
                  <div class="col-lg-12"
                    <div class="form-group">
            <label for="password">Account Status</label>
              <input readonly  class="form-control " id="status" name="status" type="text" value="<?php echo $user["status"]; ?>"placeholder="Create a Password" class="input-xlarge">
          </div>
                  <div>

               
             

          
         
          </div>
      </div>
           <button class="btn btn btn-primary pull-right" type ="submit" id="submit-edit-user" name="submit-edit-user" value="submit-edit-user" class="btn btn-primary""
                value="submit-new-quiz">Change</button>
<a href="myaccount.php" id="cancel-edit-user" name="cancel-edit-user" class="btn btn-warning">Cancel</a>
        
    </form>
       

  </div><!-- /#page-wrapper -->
  <script type="text/javascript">

function randString(x){
    var s = "";
    while(s.length<x&&x>0){
        var r = Math.random();
        s+= (r<0.1?Math.floor(r*100):String.fromCharCode(Math.floor(r*26) + (r>0.5?97:65)));
    }
    return s;
}

document.getElementById("code").value = randString(10);


  </script>

<?php include('../includes/layouts/footer.php'); ?>