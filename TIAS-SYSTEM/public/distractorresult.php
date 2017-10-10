
<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>

<?php $page = "edit-quiz.php"; ?>

<?php include('../includes/layouts/header.php'); ?>


 <link rel="stylesheet" href="css1/style.css"> <!-- Generic style (Boilerplate) -->
  <link rel="stylesheet" href="css1/960.fluid.css"> <!-- 960.gs Grid System -->
  <link rel="stylesheet" href="css1/main.css"> <!-- Complete Layout and main styles -->
  <link rel="stylesheet" href="css1/buttons.css"> <!-- Buttons, optional -->
  <link rel="stylesheet" href="css1/lists.css"> <!-- Lists, optional -->
  <link rel="stylesheet" href="css1/icons.css"> <!-- Icons, optional -->
  <link rel="stylesheet" href="css1/notifications.css"> <!-- Notifications, optional -->
  <link rel="stylesheet" href="css1/typography.css"> <!-- Typography -->
  <link rel="stylesheet" href="css1/forms.css"> <!-- Forms, optional -->
  <link rel="stylesheet" href="css1/tables.css"> <!-- Tables, optional -->
  <link rel="stylesheet" href="css1/charts.css"> <!-- Charts, optional -->
  <link rel="stylesheet" href="css1/jquery-ui-1.8.15.custom.css"> <!-- jQuery UI, optional -->


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


 
    <?php echo display_form_errors($error_messages); ?>
<?php if(!empty($error_messages)) { print_r($error_messages); } ?>
<?php if(!empty($message)) { print_r($message); } ?>
<style>
table, th, td {   border: 1px solid black;} 
th {background-color:#D9EDF7;}
td{background-color:#f5f5f5;}
th, td{ text-align:center;}
</style>
      
   <div class="col-lg-12">

      <div>
      
     
    <?php for($i=1; $i <= $quiz_q_count;$i++){
     

      }
    ?>
    
    </tr>
    <?php 
    $questionwise_array = array();
    $userCnt = 0;
    $quesDlevel = array();
    $total_score = array();
    while($row = mysqli_fetch_assoc($quiz_score)) { 
       $userCnt++;
      $sc_analysis = get_score_analysis($row['answer_sl'],$row['exam_id']);
      $quesDlevel[$row['user_id']] =  get_ques_difficulty_level($row['answer_sl'],$row['exam_id']);
      foreach($sc_analysis as $key => $val){
      $questionwise_array[$key][] = $val;
      }
      
      $percent = get_percentage_score($sc_analysis);
      ?>
   

    <?php foreach($sc_analysis as $k => $v){
     

      }
    ?>
  
    </tr>
  
  <?php   }   ?>
      

      
      </table>
    
<style>




.result{

border:8px solid; padding-left:130px; padding-right:140 ;
color:#0EAF0E;



   
  
  }




</style>

       <div>
  <div class="grid_6">
        <div class="block-border2" id="tab-panel-1">
          <div class="block-header2">
            <h1>#DISTRACTOR ANALYSIS</h1>
            <ul class="tabs">
              
            </ul>
          </div>
          <div class="block-content tab-container">
            <div id="tab-1" class="tab-content">
              <p></p>
              <p>Distractors are the multiple choice response options that are not the correct answer..</p>
              <p>They are plausible but incorrect options that are often developed based upon students’ common misconceptions or miscalculations.</p>
              <p> Item analysis software typically indicates the percentage of students who selected each option, distractors and key.</p>
            </div>
            <div id="tab-2" class="tab-content">
              <p>(*) - MEANS DISTRACTOR</p>
            </div>
            <div id="tab-3" class="tab-content">
              <p >(NA) - MEANS TOTAL COUNT OF STUDENT WHO DID NOT SELECT AMONG THE ITEM (LOWER) & (UPPER)</p>
            </div>
            <div id="tab-3" class="tab-content">
              <p STYLE="COLOR:RED;">(✓) - MEANS CORRECT ANSWER</p>
            </div>
          </div>

          <div class="block-content dark-bg">
            <p>Theoretically, distractors should not be selected by students who have a good understanding of the material. So it’s important to determine whether your best students (on the exam) are, for some reason, being drawn to an incorrect answer. A plus (+) in the response table provided by Scanning Operations will indicate that this may be happening.<a ></a>
          </div>
        </div>
      </div>
      </div>
   
<div>
 
    <?php 

    $difficultyIndex = get_questionwise_difficulty_index($questionwise_array,$userCnt);
    foreach($difficultyIndex as $k=>$di){
      
    ?>
     
    </tr> 
     
      <?php }

      ?>
      <?php 


      ?>
      </table>
      

      </div>

  </div>
<div>

</div>
 <div class="col-lg-12">
    <table  >
    
    <?php 
    
    $groupCnt = intval($userCnt*0.27);
  
    $quesDlevelU = array();
    $quesDlevelL = array();
    $i = 0 ;
    foreach($quesDlevel as $key=>$quesD){
      if($i< $groupCnt){
        $quesDlevelU[$key] = $quesD;
        }
        if($i >= ($userCnt - $groupCnt)){
        $quesDlevelL[$key] = $quesD;
        }
        $i++;
    }
    $final_quesDL = array();
    $final_quesDU = array();
    
    foreach($quesDlevelU as $quesD){
      foreach($quesD as $k=>$qu){
         if(!is_array(@$final_quesDU[$k])) $final_quesDU[$k] = array();
        $c = array_map(function () {
          return array_sum(func_get_args());
        },$qu,@$final_quesDU[$k]);
        $final_quesDU[$k] = $c;
      }
    }
    foreach($quesDlevelL as $quesD){
      foreach($quesD as $k=>$qu){
         if(!is_array(@$final_quesDL[$k])) $final_quesDL[$k] = array();
        $c = array_map(function () {
          return array_sum(func_get_args());
        },$qu,@$final_quesDL[$k]);
        $final_quesDL[$k] = $c;
      }
    }
    $i =1;
    foreach($final_quesDU as $k=>$di){
      $correctAnsIndex = 0;
      $q_ans = get_question_answers($k);
      foreach($q_ans as $p=>$v){
        if($v['is_correct'] == 1)  $correctAnsIndex = $p;
        }
       ?>
       <tr class="grp1_<?php echo ($k);?>"><th   style="width:100px;">Item No.</th><th style="width:100px;">Group Criterion(27%)</th><th style="width:70px;"><?php echo ($correctAnsIndex == 0)?'<span style="color:#ff0000;">✓A</span>':'<span style="color:#000;">A*</span>';?></th>
      <th style="width:70px;"><?php echo ($correctAnsIndex == 1)?'<span style="color:#ff0000;">✓B</span>':'<span style="color:#000;">B*</span>';?></th><th style="width:70px;"><?php echo ($correctAnsIndex == 2)?'<span style="color:#ff0000;">✓C</span>':'<span style="color:#000;">C*</span>';?></th><th style="width:70px;"><?php echo ($correctAnsIndex == 3)?'<span style="color:#ff0000;">✓D</span>':'<span style="color:#000;">D*</span>';?></th>
      <th style="width:70px;"><?php echo ($correctAnsIndex == 4)?'<span style="color:#ff0000;">✓E</span>':'<span style="color:#000;">E*</span>';?></th>
      <th style="width:70px;">NA</th> <th style="width:70px;" colspan="11">Discrimination And Difficulty Index</th></tr>
     <tr class="grp1_<?php echo ($k);?>"><td rowspan="2"><?php echo ($i);?></td><td >Upper Group(<?php echo $groupCnt;?>)</td><td><?php echo $di[0];?></td><td><?php echo $di[1]; ?></td><td><?php echo $di[2];?></td><td><?php echo $di[3]; ?></td><td><?php echo $di[4];?><td><?php echo $di[5];?></td></td><td rowspan="2"><?php echo $discIndex = round((($final_quesDU[$k][$correctAnsIndex] - $final_quesDL[$k][$correctAnsIndex])/$groupCnt),3)?></td><td rowspan="2"><?php echo $remark1 = range_discrimination($discIndex);?></td> <td rowspan="2"><?php echo $diffIndex = round(($final_quesDU[$k][$correctAnsIndex] + $final_quesDL[$k][$correctAnsIndex])/($groupCnt*2),3); ?></td><td rowspan="2"><?php echo range_difficulty($diffIndex);?></td></tr> 
     <tr class="grp1_<?php echo ($k);?>"><td >Lower Group(<?php echo $groupCnt;?>)</td><td><?php echo $final_quesDL[$k][0];?></td><td><?php echo $final_quesDL[$k][1]; ?></td><td><?php echo $final_quesDL[$k][2];?></td><td><?php echo $final_quesDL[$k][3]; ?></td><td><?php echo $final_quesDL[$k][4];?></td><td><?php echo $final_quesDL[$k][5];?></td></tr> 
  <?php 
      $i++;
      }?>


      <div>

      <h2></h2>

      
      <table  >
    
    
    <?php 
    $difficultyIndex = get_questionwise_difficulty_index($questionwise_array,$userCnt);
    foreach($difficultyIndex as $k=>$di){
    ?>
    
      <?php }?>
      </table>
      
      </div>
       
       <div class="col-lg-12">

      <table  >
      <tr><th colspan="7" style="width:70px;">CHOICES</th>
    
    <tr><th  style="width:100px;">Question No.</th><th style="width:70px; color:red;">A</th>
    <th style="width:70px; color:blue;">B</th><th style="width:70px; color:orange;">C</th><th style="width:70px; color:maroon;">D</th><th style="width:70px; color:green;">E</th><th style="width:70px; color:black-solid;">NA</th></tr>
    
    <?php 
    $final_quesD = array();
    foreach($quesDlevel as $quesD){
      foreach($quesD as $k=>$qu){
         if(!is_array(@$final_quesD[$k])) $final_quesD[$k] = array();
        $c = array_map(function () {
          return array_sum(func_get_args());
        },$qu,@$final_quesD[$k]);
        $final_quesD[$k] = $c;
      }
    }
    $i =1;
    foreach($final_quesD as $k=>$di){
      $q_ans = get_question_answers($k);
       ?>
     <tr><td>#<?php echo ($i);?></td>
    <td> 
   <p> <?php echo $di[0]; echo ($q_ans[0]['is_correct'] == 1)?'*':'';?></td></p>
     <p><td><?php echo $di[1]; echo ($q_ans[1]['is_correct'] == 1)?'*':'';?></td></p>
     <td><?php echo $di[2]; echo ($q_ans[2]['is_correct'] == 1)?'*':'';?></td>
     <td><?php echo $di[3]; echo ($q_ans[3]['is_correct'] == 1)?'*':'';?></td>
     <td><?php echo $di[4]; echo ($q_ans[4]['is_correct'] == 1)?'*':'';?></td>
     <td><?php echo $di[5];?></td></tr> 
      <?php 
      $i++;
      }?>
      <tr><td colspan="7">*NA stands for Not Attempted i.e. Count of students who did not select among the 5 choices</td></tr>
      </table>
      
      </div>

  </div><!-- /#page-wrapper -->

  </div>
<div>

</div>

<?php include('../includes/layouts/footer.php'); ?>

<?php require_once("../includes/db-connection-close.php"); ?>