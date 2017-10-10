<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $page = "manage-users.php"; ?>


<?php $exam_list = get_all_exams(); ?>
<?php $createdby = get_creator($quiz_id); ?>




<?php include('../includes/layouts/header.php'); ?>



<link href="css2/admin.css" rel="stylesheet" type="text/css" />


<body>
   

<link href="plug  ins/data-tables/DT_bootstrap.css" rel="stylesheet">
<link href="plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">


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
      <a class="navbar-brand" href="index.php">ITEM ANALYZER </a>
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
    </div><!-- /.navbar-collapse --><?php 
  $exam_list = get_all_exams2();
if($_SESSION["user"]["Usertype"] == "student"){
  if(isset($_SESSION["examcode"]) && $_SESSION["examcode"] != "") $exam_list = get_all_exams2($_SESSION["examcode"]); 
}
if(isset($_SESSION['user']['quiz'])) unset($_SESSION['user']['quiz']);
?>

  </nav>
  <div id="page-wrapper">
     <div id="page-wrapper">
    
    <div class="row">
      <div class="col-lg-12">
        <h1>List Of Examinations <?php echo $createdby; ?> <small>Control Panel</small></h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="icon-dashboard"></i> Dashboard</a></li>
          <li class="active"><i class="icon-file-alt"></i> Manage Exams</li>
        </ol>
    <div class="row">
    
       
          
        </ol>

        <!-- Display conditional messages -->
        <?php echo user_form_success_msg(); ?>
        <?php echo delete_failure_msg(); ?>

        <div class="clearfix"></div>

       
        
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Select From The List SD <?php echo $_POST['examcode']; ?></h3>

            </div>
         <div class="porlets-content">
         
         <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
        
        <thead>
                     <tr>
                   <th>Exam ID <i class="fa fa-sort"></i></th>
                  <th>Examination Term <i class="fa fa-sort"></i></th>
                  <th>Examination Title<i class="fa fa-sort"></i></th>
                  <th>Examination Subject<i class="fa fa-sort"></i></th>
                  <th>Time Given<i class="fa fa-sort"></i></th>
                  <th>Scores<i class="fa fa-sort"></i></th>
                  
                  <th>TAKE<i class="fa fa-sort"></i></th>
                  

                </tr>
              </thead>
              <tbody id="user-rows">     

              <?php

              while($row = mysqli_fetch_assoc($exam_list)) {
               
              ?>
                  
                  <tr>
                    <td><?php echo $row['exam_id']; ?></td>
                    <td><?php echo $row['exam_term']; ?></td>
                    <td><?php echo $row['exam_title']; ?></td>
                    <td><?php echo $row['exam_subject']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                  
                 <td>
                        <a href="edit-user.php?quiz_id=exam_id=<?php echo htmlentities($row['exam_id']); ?><i class="fa fa-bar-chart-o fa-2x"></i> Scores</a>                
                    </td>
                   
                    <td>
                        <a href="examination.php?exam_id=<?php echo htmlentities($row['exam_id']); ?>" ><i class="fa fa-edit fa-2x"></i> Take Exam</a>                
                    </td>
                   
                  


                

              
                  <!-- Confirm Deletion Modal -->
                 

              <?php
                }
              ?>
              
              <?php
                // Release the returned data
                mysqli_free_result($exam_list);
              ?>
          </div><!-- /.table-responsive -->
      </div>
    
        
      

  



<script src="js2/jquery-2.1.0.js"></script>
<script src="js2/bootstrap.min.js"></script>
<script src="js2/common-script.js"></script>
<script src="js2/jquery.slimscroll.min.js"></script>
<script src="plugins/data-tables/jquery.dataTables.js"></script>
<script src="plugins/data-tables/DT_bootstrap.js"></script>
<script src="plugins/data-tables/dynamic_table_init2.js"></script>
<script src="plugins/edit-table/edit-table.js"></script>
<script>
          jQuery(document).ready(function() {
              EditableTable.init();
          });
 </script>
 
 <script src="js2/jPushMenu.js"></script> 
<script src="js2/side-chats.js"></script>

<script>
$('#confirm-delete-modal').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});
</script>

<?php require_once("../includes/db-connection-close.php"); ?>