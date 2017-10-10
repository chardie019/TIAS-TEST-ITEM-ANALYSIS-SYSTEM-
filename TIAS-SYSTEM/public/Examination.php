

<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $page = "examination.php"; 
error_reporting(E_ALL);
ini_set("display_errors",1);


if(isset($_GET['exam_id'])) $_SESSION['user']['quiz']['exam_id'] = $_GET['exam_id'];
if(isset($_SESSION['user']['quiz']['exam_id']) && $_SESSION['user']['quiz']['exam_id'] !="")
 $quiz_id = $_SESSION['user']['quiz']['exam_id'];
else
	redirect_to("exam_list.php");
?>


<style>
.correct{color:#0EAF0E;


}
.your-ans{

border:6px solid; padding-right:20px;



	 
	
  }




</style>
<style>
p.uppercase {
    text-transform: uppercase;
}

p.lowercase {
    text-transform: lowercase;
}

p.capitalize {
    text-transform: capitalize;
}
</style>


 
<?php 
$questions_list = get_quiz_questions1($quiz_id); 
$total = $questions_list->num_rows;

$allowedtime = get_quiz_allowedTime($quiz_id);
 $allowedTime = get_allowed_time($quiz_id);
 $examname = get_examname($quiz_id);
$begin_time = time();
$active =1;


if(isset($_SESSION['user']['quiz']['qs_id']) && $_SESSION['user']['quiz']['qs_id'] != "")
{

	$quiz_score  = get_quiz_score($_SESSION['user']['quiz']['qs_id']);
    
  
    $begin_time = time() - $quiz_score['lapse_time'];
    
	$data = @unserialize($quiz_score['answer_sl']);
	$active = $quiz_score['active'];
	unset($data['active']);
	unset($data['begin_time']);
	
	foreach($data as $k => $v)	{
		$key = substr($k,9);
		if(intval($key) == 0) continue;  
		$question_data[substr($k,9)] = $v;
	}
	
	if($active == 0)
	{
		$final_result['question_attempted'] = count($question_data);	
		$fquestion_data = array();
		$q_list = get_quiz_questions_id($quiz_id);

		foreach($q_list as $k =>$v)
		{
			$fquestion_data[$k] = isset($question_data[$k])?$question_data[$k]:"";
		}
		$answer_data = get_correct_answers($fquestion_data);
		$final_result['total_question'] = $total;
		$final_result['correct_answer'] = get_score($fquestion_data,$answer_data);
		$final_result['result_percentage'] = ($final_result['correct_answer']*100)/$total;
		save_score($_SESSION['user']['quiz']['qs_id'],$final_result['result_percentage']);
	}
}


if(isset($_POST['begin_time'])) {

	$totalq=$_POST['totalq'];
	$_POST = array_map('addslashes',$_POST);
  $_POST = array_map('htmlentities',$_POST);
	$lapse_time = time() - $_POST['begin_time'];
  $user_id = $_SESSION['user']['Acc_Id']; 
	$active = $_POST['active'];
	$answer_sl_array = $_POST;
	$answer_sl = serialize($_POST);
	$score ='0.00';
	if(isset($_SESSION['user']['quiz']['qs_id']) && $_SESSION['user']['quiz']['qs_id'] > 0)
	{
		$query1 = "UPDATE exam_score SET lapse_time = {$lapse_time},answer_sl ='{$answer_sl}',active = {$active} WHERE qs_id = {$_SESSION['user']['quiz']['qs_id']}";
            		$result1 = mysqli_query($db, $query1);
		if ( false === $result ) {
		 
		  printf("error: %s\n", mysqli_error($db));
		  $_SESSION["message"] = mysqli_error($db).". submitting quiz.";
		  redirect_to("examination.php");
		}
		else
		{
			$_SESSION["message"] = "Quiz saved successfully.";
			redirect_to("examination.php");
		}
	}
	else
	{
		$query2 = "INSERT INTO exam_score(user_id, exam_id,score,lapse_time,answer_sl) VALUES ( '{$user_id}','{$quiz_id}', '{$score}','{$lapse_time}','{$answer_sl}')";
		$result2 = mysqli_query($db, $query2);
		if($result2 && mysqli_affected_rows($db) != -1) {
			  // Success
			  $current_qs_id = mysqli_insert_id($db);
			  $_SESSION['user']['quiz']['qs_id'] = $current_qs_id;
			  $_SESSION["message"] = "Successfully submitted!";
			  redirect_to("examination.php");
		 } else {
			  $_SESSION["message"] = "Database Failure";
			  redirect_to("examination.php");
		}
    }
}

?>



<?php include('../includes/layouts/header.php'); ?>

<body onLoad="ShowTime()" >
<script src="js/jquery-1.10.2.js"></script>
<div id="wrapper" style="padding-left:0px !important;">


  <div id="page-wrapper">
  
 
        <div class="panel panel-info">

              <div class="panel-heading">
        
    <center><p class="capitalize" style="color:black; font-family:; font-size:150%;" ><?php echo $examname;?> </p></center>

       
        
    
         
            

                <h3 class="panel-title"></h3>
              </div>

              <div class="panel-body">
             
       	
   

 


<div style="float:right; font-size: 30px; color:red;"><span id="stopwatch">00:00:00</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Count = <?php echo $total;?></div></h3>

			  


  <div class="panel panel-info"></div>
      <div class="col-lg-12">

        <div class="row">
        <div class="panel tbp-panel-inverse" >
          <div class="panel-heading">
          <ul class="legend">
 


         <li><p class="capitalize" style="color:white; font-family:Courier New Lucida Console; font-size:180%;"  >Examinee:   <?php echo $_SESSION['user']['Lastname'];?>, <?php echo $_SESSION['user']['Firstname'];?> <?php echo $_SESSION['user']['Middlename'];?></p><p  style="color:white; font-family:Courier New Lucida Console; font-size:180%;">Id No. : <?php echo $_SESSION['user']['idnumber'];?></p></li> 
<DIV>


       
   		<style type="text/css">
.legend { list-style: none; }
.legend li { float: left; margin-right: 12px; }
.legend span { border: 3px solid #ccc; float: left; width: 18px; height: 18px; margin: 0px; }
.legend spin { border: 3px solid #ccc; float: left; width: 18px; height: 18px; margin: 0px; }



.legend .superawesome { background-color: #0EAF0E	; }
.legend .jelord { background-color: #EC1522	; }
.legend .awesome { background-color: #000C0C; }


</style>	
<div>
<br>
	<?php if($active == 0) { ?>
<div style="float:right; margin-right: -150px; "><h2 class="panel-title"><strong><spin class="jelord"></spin>Time Limit (Minutes)


 <div></div>

         <h2 class="panel-title"><strong><li><span class="superawesome" ></span> ✓-Correct Answer</li> <li><span class="awesome"></span>  X-Wrong Answer</li></strong>

           <?php }
      else {
       ?>

       <?php } ?>
		<?php if($active == 0) { ?>
       
      
     <right> <a class="btn btn-success " data-toggle="modal" data-target="#stat"  >View My Score</a></div></right>
        <?php }
      else {
       ?>
               
              
              <?php } ?>
<br>   </div>
        <br>
            <div class="row">

            </div>
		  </div>
		
		  
        </div>
        <script type="text/javascript">
        $(function () {
            $('.chk1').change(function () {
                if ($(this).is(":checked")) {
                    $('#btnClick').removeAttr('disabled');
                }
                else {
                    var isChecked = false;
                    $('.chk1').each(function () {
                        if ($(this).is(":checked")) {
                            $('#btnClick').removeAttr('disabled');
                            isChecked = true;
                        }
                    });
                    if (!isChecked) {
                        $('#btnClick').attr('disabled', 'disabled');
                    }
                }
 
 
            })
        });
    </script>
		 

		<center><p style="color:red; font-family:verdana;"  style="" style="color:red;"> 
		

          <div class="table-responsive">
            <form  action="" method="post" id="myform" name ="myform">
			<input type="hidden" value="<?php echo $begin_time;?>" name="begin_time" id ="begin_time" >
			<input type="hidden" value="1" name="active" id ="active" >

			
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  	<ul>

				
                  <th>NO.</th>
                  <th>QUESTIONS</th>
               
                </tr>
              </thead>
              <tbody id="user-rows">     
 <?php
				$cnt = 0;
                while($row = mysqli_fetch_assoc($questions_list)) {
				
				$cnt++;
				$answer_set = get_question_answers($row['question_id']);
				$disabled = ($active == 0)?' disabled="disabled"':'';
				$ans_html = '<div style="padding-left:30px;">';
				$checked = (isset($question_data[$row['question_id']]) && $question_data[$row['question_id']] == $answer_set[0]['answer_id'])?" checked='checked'":"";
				$fontClass ="";
				$fontClass .= ($checked!= '')? "your-ans":""; 
			
			
				
				$fontClass .= ($active == 0 && @$answer_data[$row['question_id']] == $answer_set[0]['answer_id'])?" correct":"";
				
				$ans_html .= '<input type="radio" name="question_'.$row['question_id'].'" value="'.$answer_set[0]['answer_id'].'" '.$checked.' '.$disabled.'><a STYLE="COLOR:RED;" class="pull-left">A.</a> <span class="'.$fontClass.'">'.$answer_set[0]["answer_text"].'</span><br>' ; 
				$checked = (isset($question_data[$row['question_id']]) && $question_data[$row['question_id']] == $answer_set[1]['answer_id'])?" checked='checked'":"";
				$fontClass ="";
				$fontClass .= ($checked!= '')? "your-ans":"";
				$fontClass .= ($active == 0 && @$answer_data[$row['question_id']] == $answer_set[1]['answer_id'])?" correct":"";
				
				
			
				$ans_html .= '<input type="radio" name="question_'.$row['question_id'].'" value="'.$answer_set[1]['answer_id'].'" '.$checked.''.$disabled.'><a STYLE="COLOR:RED;" class="pull-left">B.</a> <span class="'.$fontClass.'">'.$answer_set[1]["answer_text"].'</span><br>' ;
				
				$checked = (isset($question_data[$row['question_id']]) && $question_data[$row['question_id']] == $answer_set[2]['answer_id'])?" checked='checked'":"";
				$fontClass ="";
				$fontClass .= ($checked!= '')? "your-ans":"";
				$fontClass .= ($active == 0 && @$answer_data[$row['question_id']] == $answer_set[2]['answer_id'])?" correct":"";
				$ans_html .= '<input type="radio" name="question_'.$row['question_id'].'" value="'.$answer_set[2]['answer_id'].'" '.$checked.''.$disabled.'> <a STYLE="COLOR:RED;" class="pull-left">C.</a><span class="'.$fontClass.'">'.$answer_set[2]["answer_text"].'</span><br>' ;
				
				
				
				
				$checked = (isset($question_data[$row['question_id']]) && $question_data[$row['question_id']] == $answer_set[3]['answer_id'])?" checked='checked'":"";
				$fontClass ="";
				$fontClass .= ($checked!= '')? "your-ans":"";
				$fontClass .= ($active == 0 && @$answer_data[$row['question_id']] == $answer_set[3]['answer_id'])?" correct":"";
				
				$ans_html .= '<input type="radio" name="question_'.$row['question_id'].'" value="'.$answer_set[3]['answer_id'].'" '.$checked.''.$disabled.'><a STYLE="COLOR:RED;" class="pull-left">D.</a> <span class="'.$fontClass.'">'.$answer_set[3]["answer_text"].'</span><br>' ;
				
				$checked = (isset($question_data[$row['question_id']]) && $question_data[$row['question_id']] == $answer_set[4]['answer_id'])?" checked='checked'":"";
				$fontClass ="";
				$fontClass .= ($checked!= '')? "your-ans":"";
				$fontClass .= ($active == 0 && @$answer_data[$row['question_id']] == $answer_set[4]['answer_id'])?" correct":"";
			   
			
				$ans_html .= '<input type="radio" name="question_'.$row['question_id'].'" value="'.$answer_set[4]['answer_id'].'" '.$checked.' '.$disabled.'><a STYLE="COLOR:RED;" class="pull-left">E.</a><span class="'.$fontClass.'">'.$answer_set[4]["answer_text"].'</span><br>' ;
				
			
				$ans_html .= '</div>' ;
				
				
              ?>

                  <tr>
                    <td><?php echo $cnt; ?> .)</td>
                    <td><?php echo $row['question_text']; ?>  <?php echo $ans_html;?></td>
					    
            
                  </tr>
              
              <?php
                }
              ?>
              <?php
                
                mysqli_free_result($questions_list);
              ?>
        
              </tbody>
            </table>
            <div class="form-group pull-right" >
             <label for="submit-edit-mc-question"></label>
            <?php if($active == 0) { ?>
       
      
        <?php }
      else {
       ?>
			 				 <input type="checkbox" class="chk1" name="name" /><label>Validate  ✓</label>
                  <button id="btnClick" disabled="disabled" type ="submit" id="submit-quiz-question" name="submit-quiz-question" value="submit-quiz-question" class="btn btn-success" onSubmit="ShowLoading()">Submit Answer</button>
              
               <?php } ?>
              
            
             </div>
            </form>
          </div><!-- /.table-responsive -->
          
          
       
        <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
              </div>
              <div class="modal-body">
                You are about to complete this Quiz. This action will be irreversible.<br />
                Do you wish to proceed?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a onclick="getFormSubmit();" class="btn btn-primary">Yes</a>
              </div>
            </div>
          </div>
        </div>
		
	
         <script type="text/javascript">
<!--
 $('#memberModal').modal({ show: true });
//-->
</script>
 <script type="text/javascript">
<!--
 $('#stat').modal({ show: true });
//-->
</script>
          
          
      </div>
    </div>

  </div>
 
        <div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
              </div>
              <div class="modal-body">
               Processing Answers
              </div>
              <div class="modal-footer">
              
              
              </div>
            </div>
          </div>
        </div>
	
	
		
		  <div class="modal fade" id="stat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="confirm-delate-label"></h4>   <h4 class="modal-title" id="confirm-delate-label">Time Consumed: <?php echo $quiz_score['lapse_time'] ?></h4>
				
				
              </div>
              <div class="modal-body">
            Total Question = <?php echo $final_result['total_question'];?> &larr;<br>   
				 Total Questions Answered = <?php echo $final_result['question_attempted'];?>&larr;<br>
				 Total Number Of Correct Answers = <?php echo $final_result['correct_answer'];?>&larr;<br>
						
				Score(In %) = Your Score Is = [<?php echo $final_result['correct_answer'];?>] Which Is <?php echo $final_result['result_percentage'];?>%&larr;</div><div style="float:left;"> 
							
              </div>
			  
              <div class="modal-footer">
			  
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="star/index.html" class="btn btn-primary">Log-out</a>
              </div>
            </div>
          </div>
        </div>

          
<?php include('../includes/layouts/footer.php'); ?>


	 <script type = "text/javascript" >
    history.pushState(null, null, 'examination.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'examination.php');
    });
    </script>
    <script type ="text/javascript" >
    document.onkeydown = function(){
  switch (event.keyCode){
        case 116 : //F5 button
            event.returnValue = false;
            event.keyCode = 0;
            return false;
        case 82 : //R button
            if (event.ctrlKey){ 
                event.returnValue = false;
                event.keyCode = 0;
                return false;
            }
    }
}

	</script>
<?php include('../includes/layouts/footer.php'); ?>


<script>
function getFormSubmit()
{
		document.getElementById('active').value = 0;
		document.getElementById('myform').submit();
		 
}	
$('#stopwatch').timer({
			<?php if($allowedtime > 0){ ?>
			duration: '<?php echo $allowedtime; ?>m',
			countdown: true,
			<?php }  ?>
			format: '%M : %S',
			
			callback: function() {
				
				$('#stopwatch').timer('pause');
				getFormSubmit();
			}
});
$(window).scroll(function(){
 $("#tbp-panel").css({"margin-left": ($(window).scrollTop()) + "px", "margin-right":($(window).scrollLeft()) + "px"});
});
</script>
<?php require_once("../includes/db-connection-close.php"); ?>
<?php if($active == 0){ ?>
<script type='text/javascript'>
$( document ).ready(function() {
	$('#stopwatch').timer('remove');
});
</script>
<?php } ?>
<?php require_once("../includes/db-connection-close.php"); ?>

	

	
	