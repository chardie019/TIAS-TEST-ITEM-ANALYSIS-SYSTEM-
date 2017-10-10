<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $page = "manage-users.php"; ?>


<?php $exam_list = get_all_exams(); ?>


<?php
  
  $id = isset($_GET["exam_id"]) ? $_GET["exam_id"] : "";
  $quiz = get_exam_by_id($id);


  if(!$quiz) { redirect_to("manage-quizzes.php"); }
?>
 <?php $quiz_score = get_quiz_score_details($id); 
 
$quiz_q_count = get_quiz_question_count($id);
  ?>
<?php
?>
  



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
     
    </div>
      <?php include('../includes/layouts/admin-head.php'); ?>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav.php'); ?>

            <?php include('../includes/layouts/admin-profile.php'); ?>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>
  <div id="page-wrapper">
     <div id="page-wrapper">
    
    <div class="row">
      <div class="col-lg-12">

                 
              </div>  
                  
          </ol>
        </div>
      </div>
        </ol>

        <!-- Display conditional messages -->
        <?php echo user_form_success_msg(); ?>
        <?php echo delete_failure_msg(); ?>

        <div class="clearfix"></div>

       
        
        <div class="col-md-13">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
             
            </div>
         <div class="porlets-content">
         
         <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
        
        <thead>
                     <tr>
                      <div class="clearfix"></div>
     

 <th>No.<i class="fa fa-sort"></i></th>
                   <th>Fullname</th>
                  <th>Title<i class="fa fa-sort"></i></th>
                   <th>Term<i class="fa fa-sort"></i></th>
                  <th>Score(%)<i class="fa fa-sort"></i></th>
                  <th>Total Number Of (✓)<i class="fa fa-sort"></i></th>
                  <th>Total Questions<i class="fa fa-sort"></i></th>
                  <th>Subject<i class="fa fa-sort"></i></th>
                

                </tr>
              </thead>
              <tbody id="user-rows">     

             
                  <?php 
    for($i=1; $i <= $quiz_q_count;$i++){
     
      }
    ?>
    
    </tr>
    <?php 
    $cnt = 0;
    $questionwise_array = array();
    $userCnt = 0;
    $total_score = array();

    while($row = mysqli_fetch_assoc($quiz_score)) { 
      $cnt++;
       $userCnt++;
      $sc_analysis = get_score_analysis($row['answer_sl'],$row['exam_id']);
     
      foreach($sc_analysis as $key => $val){
      $questionwise_array[$key][] = $val;
      }
      
      $percent = get_percentage_score($sc_analysis);
      ?>
  
    <tr>
      <td><?php echo $cnt; ?></td>
    <td><?php $user = get_user_by_id($row['user_id']); echo $user['Firstname'] ;?> <?php echo $user['Middlename']; ?> <?php echo $user['Lastname']; ?> </td>
   
    <td><?php echo $quiz['exam_title']; ?></td>
    <td><?php echo $quiz['exam_term']; ?></td>
     <td><?php echo intval($percent);?>%</td>
    
    <?php foreach($sc_analysis as $k => $v){
      
      }
    ?>

    <td style="background-color:#fff;"><?php echo $total_score[] = array_sum($sc_analysis); ?></td>
   
     <td><?php echo $quiz_q_count ?></td>
       <td><?php echo $quiz['exam_subject']; ?></td>
 
   
    </tr>


  
  <?php   }   ?>
  
   
    </tr>  


   



                

              
               
          </div>
      </div>
    
        
      

  



<script src="js2/jquery-2.1.0.js"></script>
<script src="js2/bootstrap.min.js"></script>
<script src="js2/common-script.js"></script>
<script src="js2/jquery.slimscroll.min.js"></script>
<script src="plugins/data-tables/jquery.dataTables.js"></script>
<script src="plugins/data-tables/DT_bootstrap.js"></script>
<script src="plugins/data-tables/dynamic_table_init0.js"></script>
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