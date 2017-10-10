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
th {background-color:#d9edf7;}
td{background-color:#E0E6CF;}
th, td{ text-align:center;}
.no2_row td{background-color:#fcf8e3; ;}

</style>
      
  <div class="col-lg-15">
      

        <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title"> The Kuder Richardson Coefficient of reliability (KR 20) - (<?php echo $quiz['exam_title']; ?>)</h3>
              </div>
              <div class="panel-body">
       <div>

      <div>

      <h2></h2>

      
      <table  >


      <table  >
    <tr><th  rowspan="2" style="width:100px;">Fullname</th><th  rowspan="2" style="width:100px;">Total<br>Score (%)</th><th colspan="<?php echo $quiz_q_count;?>">Question No.</th><th  rowspan="2" style="width:50px;">Total<br>Score(No. Of 1's)</th></tr>
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
      
      $percent = round(intval(get_percentage_score($sc_analysis)),1);
      ?>
    <tr><td><?php $user = get_user_by_id($row['user_id']); echo $user['Lastname'] ;?> ...<?php echo $user['Firstname'];?>  <?php echo $user['Middlename'];?></td><td><?php echo $percent; ?></td>
    <?php foreach($sc_analysis as $k => $v){
      echo "<td>".$v."</td>";
      }
    ?>
    <td style="background-color:#fff;"><?php echo $total_score[] = array_sum($sc_analysis); ?></td>
    </tr>

  

  <?php   }   ?>
    <tr class="no2_row" ><td><strong>No of 1's</strong></td><td > </td>
    <?php foreach($questionwise_array as $k => $v){
      echo "<td>".array_sum($v)."</td>";
      }
    ?>
    <td style="background-color:#fff;"></td>
    </tr>  
    <tr class="no1_row"><td >Proportion Passed (p)</td><td> </td>
    <?php foreach($questionwise_array as $k => $v){
      echo "<td>".round((array_sum($v)/$userCnt),3)."</td>";
      }
    ?>
    <td style="background-color:#fff;"></td>
    </tr>
    <tr class="no_row"><td >Proportion Failed (q)</td><td> </td>
    <?php foreach($questionwise_array as $k => $v){
      echo "<td>".round((1 - (array_sum($v)/$userCnt)),3)."</td>";
      }
    ?>
    <td style="background-color:#fff;"></td>
    </tr>
       <tr ><td > p x q </td><td> </td>
    <?php 
    $sumPQ = 0;
    foreach($questionwise_array as $k => $v){
      $sumPQ += ((array_sum($v)/$userCnt)*(1 - (array_sum($v)/$userCnt)));
      echo "<td>".number_format(round(((array_sum($v)/$userCnt)*(1 - (array_sum($v)/$userCnt))),3),3)."</td>";
      }
      $st_dev = mystats_standard_deviation($total_score);
    ?>
    <td style="background-color:#fff;"><strong class="result"><?php echo round($sumPQ,3);?></strong></td>
    </tr>
    <tr><td colspan="30"><div style="text-align:left;margin-left:100px;"><strong>k = <?php echo $quiz_q_count; ?> i.e No. of Questions<br>
      

<?php
    /* To get the mean */ 
?>
    <?php $total_score2 = array_sum($total_score); ?>
    <?php $mean = $total_score2/$userCnt; ?>

    <?php
    /* end of quote */
?>

      x&#772; = <?php echo round($mean,3) ; ?><br>
      &Sigma;pq = <?php echo round($sumPQ,3) ; ?> i.e Summation of p x q<br>
      &sigma;<sup>2</sup> = <?php echo round(pow($st_dev,2),3); ?> i.e standard deviation squared/variance of Total score for each student<br>
      r<sub>KR20</sub> = [ k/(k-1) ] * [ 1- (&Sigma;pq/&sigma;<sup>2</sup>) ]<br>
      r<sub>KR20</sub> = [ <?php echo $quiz_q_count; ?>/(<?php echo $quiz_q_count; ?>-1) ] * [ 1- (<?php echo round($sumPQ,3); ?>/<?php echo round(pow($st_dev,2),3); ?>) ]<br>
        r<sub>KR20</sub> = [ <?php echo round(($quiz_q_count/($quiz_q_count -1)),3);?> ] * [ <?php echo round((1- (round($sumPQ,3)/($st_dev*$st_dev))),3); ?> ]<br>

      <p style="color:black; font-family:Courier New Lucida Console; font-size:200%;"  >  r<sub>KR20</sub> = <?php echo $reliability = round(($quiz_q_count/($quiz_q_count -1)) *  (1- ($sumPQ/($st_dev*$st_dev))),3);?> 
      <br><br>
      
<p class="pull-left">INTERPRETATION : 
</p> <?php echo reliability_interpretation($reliability);?></p><br>
      </br>
      </div>

      
    

    
    </strong></div></td></tr>
    
      </table>

   <div class="col-lg-12">

     
   
<div>
       <div class="col-lg-15">
      

  </div>

<?php include('../includes/layouts/footer.php'); ?>

<?php require_once("../includes/db-connection-close.php"); ?>