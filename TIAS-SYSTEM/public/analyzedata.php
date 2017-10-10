<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>

<?php $page = "edit-quiz.php"; ?>

<?php include('../includes/layouts/header.php'); ?>





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

    <div class="row">
      <div class="col-lg-12">
        <h1>EXAMINATION NAME: <small><?php echo $quiz['exam_title']; ?></small></h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="icon-dashboard"></i> Dashboard</a></li>
          <li class="active"><i class="icon-file-alt"></i>Item Analysis</li>
        </ol>
        <hr />
      </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->

 
    <?php echo display_form_errors($error_messages); ?>
<?php if(!empty($error_messages)) { print_r($error_messages); } ?>
<?php if(!empty($message)) { print_r($message); } ?>
<style>
table, th, td {   border: 1px solid black;} 
th {background-color:#B4A682;}
td{background-color:#E0E6CF;}
th, td{ text-align:center;}
</style>
      
   <div class="col-lg-12">
<p style="color:black; font-family:Courier New Lucida Console; font-size:180%;">Table 1. displays the results of <?php echo $quiz_q_count ?> questions on an examination. Note that the students are arranged with the top overall scorers at the top of the table. "1" indicates the answer was correct; "0" indicates it was incorrect.</p>

      <div>
      
      <table  >
    <tr><th  rowspan="2" style="width:100px;">Name</th><th  rowspan="2" style="width:100px;">Total<br>Score (%)</th><th colspan="<?php echo $quiz_q_count;?>">Question</th></tr>
    <tr>
    <?php for($i=1; $i <= $quiz_q_count;$i++){
      echo "<th style='width:45px;'>".$i."</th>";
      }
    ?>
    
    </tr>
    <?php 
    $questionwise_array = array();
    $userCnt = 0;
    while($row = mysqli_fetch_assoc($quiz_score)) { 
       $userCnt++;
      $sc_analysis = get_score_analysis($row['answer_sl'],$row['exam_id']);
      foreach($sc_analysis as $key => $val){
      $questionwise_array[$key][] = $val;
      }
      
      $percent = get_percentage_score($sc_analysis);
      ?>
    <tr><td><?php $user = get_user_by_id($row['user_id']); echo $user['Firstname']; ?> <?php echo$user['Middlename']; ?> <?php echo $user['Lastname'] ?></td><td><?php echo intval($percent); ?> %</td>


    <?php foreach($sc_analysis as $k => $v){
      echo "<td>".$v."</td>";

      }
    ?>
  
    </tr>
  
  <?php   }   ?>
      
      
      </table>
      
      </div>
   
<div>
       <div class="col-lg-15">
       <div>

      <div>

      <h2></h2>
<p style="color:black; font-family:Courier New Lucida Console; font-size:180%;">Table 2. Shows the Difficulty Index and the Discrimination Index based on the score of students of the examination :  <?php echo $quiz['exam_title'];    ?></p>
      
      <table  >
    <tr><th   style="width:100px;">Item</th><th  style="width:100px;"># Correct<br>(Upper group)</th>
    <th ># Correct<br>(Lower group)</th><th >Difficulty<br>(p)</th><th >Discrimination<br>(D)</th><th>Edit</th></tr>
    
    <?php 
    $difficultyIndex = get_questionwise_difficulty_index($questionwise_array,$userCnt);
    foreach($difficultyIndex as $k=>$di){
    ?>
     <tr><td>Question<br><?php echo ($k+1);?></td><td><?php echo $di['c_u_grp'];?></td><td><?php echo $di['c_l_grp'];?></td><td><?php echo $di['difficulty'];?></td><td><?php echo $di['dicrimination'];?> <td>
                        <a href="edit-question.php?question_id=<?php echo htmlentities($row['question_id']); ?>" ><i class="fa fa-edit fa-2x"></i> Edit</a>                
                    </td></td></tr> 
      <?php }?>
      </table>
      
      </div>

  </div>
<div>

</div>

<?php include('../includes/layouts/footer.php'); ?>

<?php require_once("../includes/db-connection-close.php"); ?>