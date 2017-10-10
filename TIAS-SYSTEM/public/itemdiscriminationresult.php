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
       
 
    <?php echo display_form_errors($error_messages); ?>
<?php if(!empty($error_messages)) { print_r($error_messages); } ?>
<?php if(!empty($message)) { print_r($message); } ?>
<style>
table, th, td {   border: 1px solid black;} 
th {background-color:#D9EDF7;;}
td{background-color:#E0E6CF;}
th, td{ text-align:center;}
</style>
      
   <div class="col-lg-12">
  

      <div>
      
      <table  >
  
    <?php for($i=1; $i <= $quiz_q_count;$i++){
     
      }
    ?>
    
    </tr>
    <?php 
    $questionwise_array = array();
    $userCnt = 0;
    $quesDlevel = array();
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
      
      </div>
   
<div>
       <div class="col-lg-15">
       <div class="col-lg-15">

        <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title"> DISCRIMINATION INDEX RESULT OF <?php echo $quiz['exam_title']; ?></h3>
              </div>
              <div class="panel-body">
       <div>

      <div>

      <h2></h2>

      
      <table  >
    
    
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
       <tr class="grp1_<?php echo ($k);?>"><th   style="width:100px;">Item No.</th><th style="width:100px;">Group Criterion(27%)</th><th style="width:70px;"><?php echo ($correctAnsIndex == 0)?'<span style="color:#ff0000;">✓A</span>':'<span style="color:#000;">A</span>';?></th>
      <th style="width:70px;"><?php echo ($correctAnsIndex == 1)?'<span style="color:#ff0000;">✓B</span>':'<span style="color:#000;">B</span>';?></th><th style="width:70px;"><?php echo ($correctAnsIndex == 2)?'<span style="color:#ff0000;">✓C</span>':'<span style="color:#000;">C</span>';?></th><th style="width:70px;"><?php echo ($correctAnsIndex == 3)?'<span style="color:#ff0000;">✓D</span>':'<span style="color:#000;">D</span>';?></th>
      <th style="width:70px;"><?php echo ($correctAnsIndex == 4)?'<span style="color:#ff0000;">✓E</span>':'<span style="color:#000;">E</span>';?></th>
      <th style="width:70px;">NA</th><th >Discrimination Index</th><th >Remarks</th><th >Action</th></tr>
     <tr class="grp1_<?php echo ($k);?>"><td rowspan="2"><?php echo ($i);?></td><td >Upper Group(<?php echo $groupCnt;?>)</td><td><?php echo $di[0];?></td><td><?php echo $di[1]; ?></td><td><?php echo $di[2];?></td><td><?php echo $di[3]; ?></td><td><?php echo $di[4];?><td><?php echo $di[5];?></td></td><td rowspan="2"><?php echo $discIndex = round((($final_quesDU[$k][$correctAnsIndex] - $final_quesDL[$k][$correctAnsIndex])/$groupCnt),3)?></td><td rowspan="2"><?php echo $remark1 = range_discrimination($discIndex);?></td> <td rowspan="2"> &nbsp;<a target="_blank" class="btn btn-primary btn-xs" href="edit-question.php?question_id=<?php echo $k;?>">Revise</a> &nbsp;<a  data-toggle="modal" data-target="#confirm-delete-modal1"  class="btn btn-danger btn-xs" onclick="sendId1(<?php echo $k;?>);" style="cursor:pointer;" >Discard</a> &nbsp;<a  data-toggle="modal" data-target="#confirm-delete-modal"  class="btn btn-success btn-xs" onclick="sendId(<?php echo $k;?>);" style="cursor:pointer;" >Retain</a> &nbsp;</td></tr> 
     <tr class="grp1_<?php echo ($k);?>"><td >Lower Group(<?php echo $groupCnt;?>)</td><td><?php echo $final_quesDL[$k][0];?></td><td><?php echo $final_quesDL[$k][1]; ?></td><td><?php echo $final_quesDL[$k][2];?></td><td><?php echo $final_quesDL[$k][3]; ?></td><td><?php echo $final_quesDL[$k][4];?></td><td><?php echo $final_quesDL[$k][5];?></td></tr> 
  <?php 
      $i++;
      }?>


      
      <tr><td colspan="13">*NA stands for Not Attempted i.e. selected none of the 5 options</td></tr>
     </table>
       <!-- Confirm Deletion Modal -->
        <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
              </div>
              <div class="modal-body">
                Are you sure to retain this item?
                <input type="hidden" name="bookId" id="bookId" value=""/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a onclick="hideTr();" class="btn btn-primary">Yes</a>
              </div>
            </div>
          </div>
        </div><!-- /.modal fade -->
       
       <!-- Confirm Deletion Modal -->
        <div class="modal fade" id="confirm-delete-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
              </div>
              <div class="modal-body">
                Are you sure to discard this item?
                <input type="hidden" name="bookId1" id="bookId1" value=""/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a onclick="hideTr1();" class="btn btn-primary">Yes</a>
              </div>
            </div>
          </div>
        </div><!-- /.modal fade -->
    </div>

<script type='text/javascript'>
function sendId(value){
   $("#confirm-delete-modal .modal-body #bookId").val( value );
  }
function hideTr(){
  var id = $(".modal-body #bookId").val();
  $(".grp_"+id).hide();
  $('#confirm-delete-modal').modal('hide');
  $.ajax({url: "ajax-method1.php?method=retain&qid="+id, success: function(result){
    }});
  }
function sendId1(value){
   $("#confirm-delete-modal1 .modal-body #bookId1").val( value );
  }
function hideTr1(){
  var id = $(".modal-body #bookId1").val();
  $(".grp1_"+id).hide();
  $('#confirm-delete-modal1').modal('hide');
  $.ajax({url: "ajax-method.php?method=discard&qid="+id, success: function(result){
    }});
  }
</script>


  </div><!-- /#page-wrapper -->

<?php include('../includes/layouts/footer.php'); ?>

<?php require_once("../includes/db-connection-close.php"); ?>