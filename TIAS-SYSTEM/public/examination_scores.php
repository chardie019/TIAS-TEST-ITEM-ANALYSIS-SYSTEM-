  <?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>

<?php $page = "kr20result.php"; ?>

<?php include('../includes/layouts/header.php'); ?>





<?php
  
  $id = isset($_GET["exam_id"]) ? $_GET["exam_id"] : "";
  $quiz = get_exam_by_id($id);


  if(!$quiz) { redirect_to("manage-exams.php"); }
?>
 <?php $quiz_score = get_quiz_score_details($id); 
 
$quiz_q_count = get_quiz_question_count($id);
  ?>
<?php
?>
  
<body>

<div id="wrapper">

  
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   
    <?php include('../includes/layouts/admin-head.php'); ?>

  
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav.php'); ?>

      <?php include('../includes/layouts/admin-profile.php'); ?>
    </div>
  </nav>
  <div id="page-wrapper">

    <div class="row">
    <div class="col-lg-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">SCORE MANAGEMENT - CONTROL PANEL</h3>
                </div>
                <div class="panel-body">
                 <li class="active"><a href="index.php"><i class="icon-dashboard"></i>The table displays the results of  <?php echo $quiz_q_count ?> questions of the <?php echo $quiz['exam_title']; ?> Exam taken by the students. Note that the students are arranged with the top overall scorers at the top of the table.<LI>"1"  indicates the answer was correct; "0" indicates it was incorrect.</a></li>   
                </div>
              </div>  
          
          </ol>
        </div>
      </div>

     

 <style>




.result{

border:8px solid; padding-left:130px; padding-right:140 ;
color:#0EAF0E;



   
  
  }




</style>
     <?php echo display_form_errors($error_messages); ?>
<?php if(!empty($error_messages)) { print_r($error_messages); } ?>
<?php if(!empty($message)) { print_r($message); } ?>
<style>
table, th, td {   border: 1px solid black;} 
th {background-color:#B4A682;}
td{background-color:#E0E6CF;}
th, td{ text-align:center;}
.no_row td{background-color:#66C12D ;}

</style>

</style>
     <?php echo display_form_errors($error_messages); ?>
<?php if(!empty($error_messages)) { print_r($error_messages); } ?>
<?php if(!empty($message)) { print_r($message); } ?>
<style>
table, th, td {   border: 1px solid black;} 
th {background-color:#B4A682;}
td{background-color:#E0E6CF;}
th, td{ text-align:center;}
.no1_row td{background-color:#6DBBC3; ;}

</style>
<style>
table, th, td {   border: 1px solid black;} 
th {background-color:#D9EDF7;}
td{background-color:#E0E6CF;}
th, td{ text-align:center;}
.no2_row td{background-color:#fcf8e3; ;}

</style>
     
   <div class="col-lg-12">

      <table  >
    <tr><th  rowspan="2" style="width:100px;">Fullname</th><th  rowspan="2" style="width:100px;">Total<br>Score (%)</th><th colspan="<?php echo $quiz_q_count;?>">Question No.</th><th  rowspan="2" style="width:50px;">Total Score<br>(No. Of ✓)</th></tr>
    <tr>
    <?php 
    for($i=1; $i <= $quiz_q_count;$i++){
      echo "<th style='width:45px;'>".$i."</th>";
      }
    ?>
    
    </tr>
    <?php 
    $questionwise_array = array();
    $userCnt = 0;
    $total_score = array();
    while($row = mysqli_fetch_assoc($quiz_score)) { 
       $userCnt++;
      $sc_analysis = get_score_analysis($row['answer_sl'],$row['exam_id']);
     
      foreach($sc_analysis as $key => $val){
      $questionwise_array[$key][] = $val;
      }
      
      $percent = get_percentage_score($sc_analysis);
      ?>
    <tr><td><?php $user = get_user_by_id($row['user_id']);  echo $user['Lastname'] ;?>,<?php echo $user['Firstname'];?>  <?php echo $user['Middlename'];?></td><td><?php echo intval($percent);?>%</td>
    <?php foreach($sc_analysis as $k => $v){
      echo "<td>".$v."</td>";
      }
    ?>
    <td style="background-color:#fff;"><strong class="label label-success"><?php echo $total_score[] = array_sum($sc_analysis); ?> Correct Answer</strong></td>
    </tr>
  
  <?php   }   ?>
    
    <?php foreach($questionwise_array as $k => $v){
     
      }
    ?>
 
    </tr>  
   
   
   
    
    
      </table>

   <div class="col-lg-12">

     
   
<div>
       <div class="col-lg-15">
      

  </div>

<?php include('../includes/layouts/footer.php'); ?>

<?php require_once("../includes/db-connection-close.php"); ?>