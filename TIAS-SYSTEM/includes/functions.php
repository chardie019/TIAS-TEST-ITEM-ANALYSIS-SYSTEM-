                                                                                                                                                                                                                                                                                            <?php

                                                                                                                                                                                                                                                                             

	

	function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;
	}

	function confirm_query($result_set) {
		if(!$result_set) {
			die("The Database Query Failed.");
		}
	}
	function get_all_questions_limit($start,$limit,$where = ' 1 = 1') {
		global $db;


		$where = ($where == "")?' 1 = 1':$where;
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE {$where} LIMIT {$start} ,{$limit}";
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}
	function get_quiz_score($qs_id) {
		global $db;


		$safe_user_id = mysqli_real_escape_string($db, $qs_id);

		$query 	= "SELECT * ";
		$query .= "FROM exam_score ";
		$query .= "WHERE qs_id = {$qs_id} ";
		$query .= "LIMIT 1";
		$user_set = mysqli_query($db, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user;
		} else {
			return null;
		}
	}
	function get_correct_answers($question_data) {
		global $db;
		
		
		
		$answer_data = array();
		foreach($question_data as $k=>$v)
		{
			$query = "SELECT answer_id FROM answer WHERE is_correct = 1 AND question_id = {$k}";
			$result = mysqli_query($db, $query);
			confirm_query($result);
			if($ans = mysqli_fetch_assoc($result)) {
				$answer_data[$k]=$ans['answer_id'];
			}
			else
			{
				$answer_data[$k] = "";
			}
		}
		return $answer_data;
	}


	function get_allowed_time($quiz_id) {
		
		global $db;
		$where = " exam_id={$quiz_id}";
	  	$query  = "SELECT allowed_time ";
	  	$query .= "FROM exam WHERE {$where} LIMIT 1";
	  	
		$user_set = mysqli_query($db, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user['allowed_time'];
		} else {
			return null;
		}
	  	
	}
function get_examcodes() {
		global $db;
		$query 	= "SELECT * ";
		$query .= "FROM exam ";
		$query .= "WHERE status = 1 ";
		
		$result = mysqli_query($db, $query);
		confirm_query($result);
		$examcode = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$examcode[] = $row['exam_code'];
		}
		return implode(" | ",$examcode);
	}

	function get_examname($quiz_id) {
		
		global $db;
		$where = " exam_id={$quiz_id}";
	  	$query  = "SELECT exam_title ";
	  	$query .= "FROM exam WHERE {$where} LIMIT 1";
	  	
		$user_set = mysqli_query($db, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user['exam_title'];
		} else {
			return null;
		}
	  	
	}

	
	
	
	function get_quiz_allowedTime($qs_id) {
		global $db;
		
		$safe_user_id = mysqli_real_escape_string($db, $qs_id);
		$query 	= "SELECT * ";
		$query .= "FROM exam ";
		$query .= "WHERE exam_id = {$qs_id} ";
		$query .= "LIMIT 1";
		
		$user_set = mysqli_query($db, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user['allowed_time'];
		} else {
			return null;
		}
	}

	
 function get_quiz_score_details($quiz_id) {
		global $db;

	  	$query  = "SELECT * ";
	  	$query .= "FROM `exam_score` where exam_id = {$quiz_id} ORDER BY `score` DESC";

	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}   

 function get_quiz_question_count($id) {
		global $db;
	  	$query  = "SELECT a.exam_id  FROM exam as a inner join exam_has_questions as b on a.exam_id = b.exam_id where a.exam_id = {$id}";
                $result = mysqli_query($db, $query);
	  	confirm_query($result);    
	  	return $result->num_rows;
	}
	

	
  function quesiton($question_data) {
		global $db;
		
		pr($question_data,1);
		$answer_data = array();
		foreach($question_data as $k=>$v)
		{
			$query = "SELECT answer_id FROM answer WHERE is_correct = 1 AND question_id = {$k}";
			$result = mysqli_query($db, $query);
			confirm_query($result);
			if($ans = mysqli_fetch_assoc($result)) {
				$answer_data[$k]=$ans['answer_id'];
			}
			else
			{
				$answer_data[$k] = "";
			}
		}
		return $answer_data;
	}
	
	function save_score($qs_id,$score) {
		global $db;
		$query1 = "UPDATE exam_score SET score = {$score} WHERE qs_id = {$qs_id}";
		$result = mysqli_query($db, $query1);
		confirm_query($result);
	}
	
  function get_score($question_data,$answer_data)
  {
	  $score = 0;
	  foreach($question_data as $k=>$v)
	  {
		  if($answer_data[$k] == $v) $score++;
	  }
	 return $score;
  }
	function get_all_users() {
		global $db;

	  	$query  = "SELECT * ";
	  	$query .= "FROM accounts where Usertype = 'teacher' ";


	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}


function get_all_users1() {
		global $db;

	  	$query  = "SELECT * ";
	  	$query .= "FROM accounts";


	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}


	function get_myaccount() {
		global $db;
		$cby = $_SESSION["user"]["Username"];
	  	$query  = "SELECT * ";
	  	$query .= "FROM accounts where Username = '{$cby}'";


	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}

	function get_myaccount1() {
		global $db;
		$cby = $_SESSION["user"]["idnumber"];
	  	$query  = "SELECT * ";
	  	$query .= "FROM student where idnumber = '{$cby}'";


	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}


	function get_user_by_id2($user_id) {
		global $db;

	
		$safe_user_id = mysqli_real_escape_string($db, $user_id);

		$query 	= "SELECT * ";
		$query .= "FROM accounts ";
		$query .= "WHERE Account_id = {$safe_user_id} ";
		$query .= "LIMIT 1";
		$user_set = mysqli_query($db, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user;


		} else {
			return null;
		}
	}




	function get_user_by_id($user_id) {
		global $db;

	
		$safe_user_id = mysqli_real_escape_string($db, $user_id);

		$query 	= "SELECT * ";
		$query .= "FROM student ";
		$query .= "WHERE Acc_Id = {$safe_user_id} ";
		$query .= "LIMIT 1";
		$user_set = mysqli_query($db, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user;
		} else {
			return null;
		}
	}




	function get_user_by_username($username) {
		global $db;

		$safe_username = mysqli_real_escape_string($db, $username);

		$query 	= "SELECT * ";
		$query .= "FROM accounts ";
		$query .= "WHERE username = {$safe_username} ";
		$query .= "LIMIT 1";
		$user_set = mysqli_query($db, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user;
		} else {
			return null;
		}
	}

	
function pagination($targetpage,$total,$limit,$page){

	
		if ($page == 0) $page = 1; 
		$prev = $page - 1;
		$next = $page + 1; 
		$lastpage = ceil($total/$limit); 
		$lpm1 = $lastpage - 1; 
		$adjacents = 3;
		$pagination = "";
		
		if($lastpage > 1)
		{ 
			$pagination .= "<ul class='pagination'>";
			
			if ($page > 1)
				$pagination.= "<li><a href=\"$targetpage&page=$prev\">&laquo;</a></li>";
			else
				$pagination.= "<li class='disabled'><a onclick='return false;'>&laquo;</a></li>";


			if ($lastpage < 7 + ($adjacents * 2)) 
			{ 
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
					$pagination.= "<li class='active'><a onclick='return false;' >$counter</a></li>";
					else
					$pagination.= "<li><a href=\"$targetpage&page=$counter\">$counter</a></li>"; 
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2)) 
			{
				
				if($page < 1 + ($adjacents * 2)) 
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
						$pagination.= "<li class='active'><a onclick='return false;' >$counter</a></li>";
						else
						$pagination.= "<li><a href=\"$targetpage&page=$counter\">$counter</a></li>"; 
					}
					$pagination.= "<li class='disabled'><a onclick='return false;'>......</li>";
					$pagination.= "<li><a href=\"$targetpage&page=$lpm1\">$lpm1</a></li>";
					$pagination.= "<li><a href=\"$targetpage&page=$lastpage\">$lastpage</a></li>"; 
				}
				
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<li><a href=\"$targetpage&page=1\">1</a></li>";
					$pagination.= "<li><a href=\"$targetpage&page=2\">2</a></li>";
					$pagination.= "<li class='disabled'><a onclick='return false;'>......</li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
						$pagination.= "<li class='active'><a href='#' >$counter</a></li>";
						else
						$pagination.= "<li><a href=\"$targetpage&page=$counter\">$counter</a></li>"; 
					}
					$pagination.= "<li class='disabled'><a onclick='return false;'>......</li>";
					$pagination.= "<li><a href=\"$targetpage&page=$lpm1\">$lpm1</a></li>";
					$pagination.= "<li><a href=\"$targetpage&page=$lastpage\">$lastpage</a></li>"; 
				}
				
				else
				{
					$pagination.= "<li><a href=\"$targetpage&page=1\">1</a></li>";
					$pagination.= "<li><a href=\"$targetpage&page=2\">2</a></li>";
					$pagination.= "<li class='disabled'><a onclick='return false;'>......</li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; 
					$counter++)
					{
						if ($counter == $page)
						$pagination.= "<li class='active'><a onclick='return false;' >$counter</a></li>";
						else
						$pagination.= "<li><a href=\"$targetpage&page=$counter\">$counter</a></li>"; 
					}
				}
			}

		
			if ($page < $counter - 1) 
				$pagination.= "<li><a href=\"$targetpage&page=$next\">&raquo;</a></li>";
			else
				$pagination.= "<li class='disabled'><a onclick='return false;'>&raquo;</a></li>";
			$pagination.= "</ul>\n"; 
		}
		return $pagination;
	}  

function checkAnsFormat($ansHtml)
        {
            $html = "";
           
           if(preg_match("/(.*?)\<pre>(.*?)\<\/pre\>/is", html_entity_decode($ansHtml), $matches) == 1)
           {
              $html .= $matches[1];
              $html .= "<pre><code>";
              $html .= htmlentities($matches[2]);
              $html .= "</code></pre>";
              $html .= substr(html_entity_decode($ansHtml),strrpos(html_entity_decode($ansHtml),'</pre>'));
           }
            else
                $html .= html_entity_decode($ansHtml);
            return $html;
        }
        
	function get_all_exams() {
		global $db;
		$cby = $_SESSION["user"]["Username"];
	  	$query  = "SELECT * ";
	  	$query .= "FROM exam where Created_By = '{$cby}'";

	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}

	function get_all_exams2($examcode= "") {
		global $db;
	  	if($examcode != "")
	  	 $query  = "SELECT * FROM exam WHERE exam_code = '{$examcode}' ";
	  	else
	  	 $query  = "SELECT * FROM exam WHERE exam_code = '{$examcode}' ";
	  	       
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);
	  	return $result;
	}
	function get_all_exams1() {
		global $db;
		$examcode = $user=$_COOKIE['user'];
	  	$query  = "SELECT * ";
	  	$query .= "FROM exam where exam_code = '{$examcode}'";

	 
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	  
	 

	}


	function get_exam_by_id($exam_id) {
		global $db;

		$safe_quiz_id = mysqli_real_escape_string($db, $exam_id);

		$query 	= "SELECT * ";
		$query .= "FROM exam ";
		$query .= "WHERE exam_id = {$safe_quiz_id} ";
		$query .= "LIMIT 1";
		$quiz_set = mysqli_query($db, $query);
		confirm_query($quiz_set);
		if($quiz = mysqli_fetch_assoc($quiz_set)) {
			return $quiz;
		} else {
			return null;
		}
	}function get_exam_by_ids($exam_id) {
		global $db;

		
		$safe_quiz_id = mysqli_real_escape_string($db, $exam_id);

		$query 	= "SELECT * ";
		$query .= "FROM exam ";
		$query .= "WHERE exam_id = {$safe_quiz_id} ";
		$query .= "LIMIT 1";
		$quiz_set = mysqli_query($db, $query);
		confirm_query($quiz_set);
		if($quiz = mysqli_fetch_assoc($quiz_set)) {
			return $quiz;
		} else {
			return null;
		}
	}

	
 function checkUserType()
  {
      if(isset($_SESSION["user"]["Usertype"]))
          return $_SESSION["user"]["Usertype"];
      return false;
      
  }

  function get_non_rated_questions($where1 = ' is_discarded = 0') {
		global $db;
	    $cby = $_SESSION["user"]["Username"];
		$where1 = ($where1 == "")?' is_discarded = 0':$where1;
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE {$where1} AND Created_By = '{$cby}' ";
	  
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}

	 function get_revised_rated_questions($where = ' is_discarded = 2') {
		global $db;
	    $cby = $_SESSION["user"]["Username"];
		$where = ($where == "")?' is_discarded = 2':$where;
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE Created_By = '{$cby}' and {$where} ";
	  
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}
	 function get_retained_rated_questions($where = ' is_discarded = 2') {
		global $db;
	    $cby = $_SESSION["user"]["Username"];
		$where = ($where == "")?' is_discarded = 3':$where;
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE Created_By = '{$cby}' and {$where} ";
	  
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}
	
     function get_all_questions_discarded($where = ' is_discarded = 1') {
		global $db;
		$cby = $_SESSION["user"]["Username"];
		$where = ($where == "")?' is_discarded = 1':$where;
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE Created_By = '{$cby}' and {$where}";
	  
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}


	function get_all_questions_limit_discarded($start,$limit,$where = ' is_discarded = 1') {
		global $db;
		$cby = $_SESSION["user"]["Username"];
		$where = ($where == "")?' is_discarded = 1':$where;
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE Created_By = '{$cby}' and {$where} LIMIT {$start} ,{$limit}";
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}

	function get_all_questions_limit_nonrated($start,$limit,$where = ' is_discarded = 0') {
		global $db;
		$cby = $_SESSION["user"]["Username"];
		$where = ($where == "")?' is_discarded = 0':$where;
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE Created_By = '{$cby}' and {$where} LIMIT {$start} ,{$limit} ";
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}
	function get_all_revisedquestions_limit_nonrated($start,$limit,$where = ' is_discarded = 2') {
		global $db;
		$cby = $_SESSION["user"]["Username"];
		$where = ($where == "")?' is_discarded = 2':$where;
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE Created_By = '{$cby}' and {$where} LIMIT {$start} ,{$limit} ";
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}
	function get_all_retainedquestions_limit_nonrated($start,$limit,$where = ' is_discarded = 3') {
		global $db;
		$cby = $_SESSION["user"]["Username"];
		$where = ($where == "")?' is_discarded = 3':$where;
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE Created_By = '{$cby}' and {$where} LIMIT {$start} ,{$limit} ";
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}

	function remove_discarded_question($qs_list){
		$new_qa_list = array();
		if(is_array($qs_list)){
			foreach($qs_list as $qs){
				if(isDiscarded($qs) == 0) $new_qa_list[] = $qs;
			}
		}
		return $new_qa_list;
	}

	function isDiscarded($qid) {
		global $db;
		$query1 = "SELECT is_discarded FROM question WHERE question_id = {$qid}";
		$result = mysqli_query($db, $query1);
	confirm_query($result);
		if($user = mysqli_fetch_assoc($result)) {
		return $user['is_discarded'];
		} else {
			return null;
	}
	}

	function discard_question($qid) {
		global $db;
		$query1 = "UPDATE question SET is_discarded = 1 WHERE question_id = {$qid}";

		$result = mysqli_query($db, $query1);
		confirm_query($result);
	}


	function retain_question($qid) {
		global $db;
		$query1 = "UPDATE question SET is_discarded = 3 WHERE question_id = {$qid}";

		$result = mysqli_query($db, $query1);
		confirm_query($result);
	}
	 function isUserExists($user_id)
 {
	  global $db;

		
		$safe_user_id = mysqli_real_escape_string($db, $user_id);
		$query 	= "SELECT * ";
		$query .= "FROM student ";
		$query .= "WHERE idnumber = {$safe_user_id} ";
	   $query .= "LIMIT 1";
	   $user_set = mysqli_query($db, $query);
		if($user_set && $user_set->num_rows == 1) {
			return true;
	    }
	    else{
			return false;
		}   

	}

	 
	function get_quiz_questions_id($quiz_id) {
		
		global $db;
		$where = "question_id IN (SELECT question_id FROM exam_has_questions WHERE exam_id={$quiz_id})";
	  	$query  = "SELECT question_id ";
	  	$query .= "FROM question WHERE {$where}";
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);
		$q_ids= array();
		while ($row = mysqli_fetch_assoc($result)) {
		  $q_ids[$row["question_id"]] = "";
		}
	  	return $q_ids;
	  	
	}
    
 function get_score_analysis($answer_sl,$quiz_id)
  {
	  
	   $data = @unserialize($answer_sl);
		
		$question_data = array();
		foreach($data as $k => $v)
		{
			$key = substr($k,9);
			if(intval($key) == 0) continue;  
			$question_data[substr($k,9)] = $v;
		}
		$answer_data = get_correct_answers($question_data);
		
		  $all_q_id = get_quiz_questions_id($quiz_id);
		  
		  $final_result = array();
		  foreach($all_q_id as $k => $v){
			  $final_result[$k] = (@$answer_data[$k] == @$question_data[$k]) ? 1 : 0;
			  
		  }
		 return $final_result;
  }

function mystats_standard_deviation(array $a, $sample = false) {
        $n = count($a);
        $n2 = $n -1;
        if ($n === 0) {

        	
            trigger_error("The array has zero elements", E_USER_WARNING);
            $_SESSION["error_message"] = "WARNING: NOT ENOUGH DATA TO PERFORM THE TEST RELIABILITY!";
            redirect_to("error.php");
            return false;
        }
        if ($sample && $n === 1) {

        	
            trigger_error("The array has only 1 element", E_USER_WARNING);
            $_SESSION["error_message"] = "WARNING: NOT ENOUGH DATA TO PERFORM THE TEST RELIABILITY!";
            redirect_to("error.php");
            return false;
        }
        $mean = round((array_sum($a) / $n),2);
        $carry = 0;
        foreach ($a as $val) {
            $d = round($val,3) - $mean;
            $carry += pow($d,2);
        };
        if ($sample) {
           --$n;
        }
        return sqrt($carry / $n2);
    }


   function get_ques_difficulty_level($answer_sl,$quiz_id)
  {
	  $quesDlevel = array();
	   $data = @unserialize($answer_sl);
	
		$question_data = array();
		foreach($data as $k => $v)
		{
			$key = substr($k,9);
			if(intval($key) == 0) continue;  
			$question_data[substr($k,9)] = $v;
		}
		  $all_q_id = get_quiz_questions_id($quiz_id);
		  $final_result = array();
		  foreach($all_q_id as $k => $v){
				$q_ans =get_question_answers($k);
				$ans_id = @$question_data[$k];
				foreach($q_ans as $key => $val){
					$quesDlevel[$k][$key]= ($val['answer_id'] == $ans_id )?1:0;
					if($key == 4) {
						$quesDlevel[$k][5] = (array_sum($quesDlevel[$k]) == 0)?1:0;
					} 
				}
		  }
		 return $quesDlevel;
  }


    function get_questionwise_difficulty_index($questionwise_array,$userCnt){
	  $groupCnt = intval($userCnt*0.27);
	   $final_array = array();
	   $j = 0;
		foreach($questionwise_array as $v){
			for($i=0; $i<$groupCnt; $i++){
			@$final_array[$j]['c_u_grp'] += $v[$i];
		    }
		    for($i=($userCnt - $groupCnt); $i< $userCnt; $i++){
			@$final_array[$j]['c_l_grp'] += $v[$i];
		    }
		    
		    $final_array[$j]['difficulty'] = ($final_array[$j]['c_u_grp'] + $final_array[$j]['c_l_grp'])/($groupCnt*2);
		    $final_array[$j]['dicrimination'] = ($final_array[$j]['c_u_grp'] - $final_array[$j]['c_l_grp'])/($groupCnt);
		    $j++;
		}
	return $final_array;
	  
  }
  
  function question_status($value) {

  		  $text = "";
  		   if($value == "0")  
  		   	$text = '<span class="label label-success">UN-EVALUTED</span>';


  		   else if($value == "1") $text = '<span class="label label-danger">DISCARDED</span>';
  		     else if($value == "3") $text = '<span class="label label-warning">RETAINED</span>';
  		      else if($value == "2") $text = '<span class="label label-primary">REVISED</span>';
		 
		return $text;


  }

  


  function account_status($value) {
  		 $text = "";

  		 if($value == "1")  $text = '<span class="label label-success">ACTIVE<span>';
		else if($value == "0") $text = '<span class="label label-danger">INACTIVE</span>';
		else $text = '<span class="label label-warning">UNKNOWN STATUS</span>';
		return $text;


  }

  function range_difficulty($value){
	   $text = "";
		if($value >= 0.75)  $text = '<span class="label label-success">Easy</span>';
		else if($value < 0.75 && $value >= 0.25) $text = '<span class="label label-warning">Right Difficult</span>';
		else $text = '<span class="label label-danger">Difficult</span>';
		return $text;
	  }

  function range_discrimination($value){
	   $text = "";
		if($value >= 0.30)  $text = '<span class="label label-warning">Discriminating Item</span>';
		else if($value < 0.30 && $value >=0 ) $text = '<span class="label label-success">Non-Discriminating</span>';
		else if($value >= -1)  $text = '<span class="label label-danger">Negative Discrimination</span>';
		else $text = '<span class="label label-warning">Unknown</span>';
		return $text;


	  }

function reliability_interpretation($value) {

		 $text = "";

	   if($value >= 0.90)  $text = '<span class="alert alert-dismissable alert-success">Excellent reliability; at the level of the best standardized tests</span>';
		else if
		($value >= 0.80) $text = '<span class="alert alert-dismissable alert-success">Very Good For Classroom Test</span>';
	    else if
		($value >=  0.70) $text = '<span class="alert alert-dismissable alert-success">Good for classroom test; in the range of the most. There are probably a few items which could be improved</span>';
	   else if
		($value >= 0.60 ) $text = '<span class="alert alert-dismissable alert-info">"Somewhat low. This test needs to be supplemented by other measures (e.g., more tests) to determine grades. There are probably some items which could be improved.</span>';
	   else if
		($value >= 0.50) $text = '<span style="font-size: 80%" class="alert alert-dismissable alert-warning">Suggest needs for revision of test, unless it is quite short (ten or fewer items). The test definitely needs to be supplemented by other measures (e.g., more tests) for grading.</span>';
	    else if
		($value <= 0.50 ) $text = '&nbsp;<span class="alert alert-dismissable alert-danger">Questionable reliability. This test should not contribute heavily to the course grade, and it needs revision.</span>&nbsp;';

		else $text = "There must be some problem with the calculation";
		return $text;
	  }

function get_percentage_score($final_result){
	  $score = 0;
	  foreach($final_result as $k=>$v){
		  $score += $v;
	  }
	 $percent = ($score*100)/count($final_result);
	  return number_format($percent,2);
  }
function get_quiz_questions_limit($quiz_id,$start,$limit) {
		
		global $db;
		$where = "question_id IN (SELECT question_id FROM exam_has_questions WHERE exam_id={$quiz_id})";
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE {$where} LIMIT {$start} ,{$limit}";
	  
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}
	

	function get_question_by_id($question_id) {
		global $db;

		
		$safe_question_id = mysqli_real_escape_string($db, $question_id);

		$query 	= "SELECT * ";
		$query .= "FROM question ";
		$query .= "WHERE question_id = {$safe_question_id} ";
		$query .= "LIMIT 1";
		$question_set = mysqli_query($db, $query);
		confirm_query($question_set);
		if($question = mysqli_fetch_assoc($question_set)) {
			return $question;
		} else {
			return null;
		}
	}

	function get_quiz_questions($quiz_id) {
		global $db;

	
		$safe_quiz_id = mysqli_real_escape_string($db, $quiz_id);

		$query 	= "SELECT * ";
		$query .= "FROM exam_has_questions ";
		$query .= "WHERE exam_id = {$safe_quiz_id}";
		$question_set = mysqli_query($db, $query);
		confirm_query($question_set);

			
		return $question_set;
	}

	function get_quiz_questions1($quiz_id) {
		global $db;
		$where = "question_id IN (SELECT question_id FROM exam_has_questions WHERE exam_id={$quiz_id})";
	  	$query  = "SELECT * ";
	  	$query .= "FROM question WHERE {$where}";
	  	
	  	$result = mysqli_query($db, $query);
	  	confirm_query($result);

	  	return $result;
	}


	function get_question_answers_html($question_id) {
		global $db;

		
		$safe_question_id = mysqli_real_escape_string($db, $question_id);

		$query 	= "SELECT * ";
		$query .= "FROM answer ";
		$query .= "WHERE question_id = {$safe_question_id}";
		$result = mysqli_query($db, $query);
		confirm_query($result);
		$answer_set = array();
		$id = 0;  	
		$ansHtml = '<div style="padding-left:70px;">';
		while ($row = mysqli_fetch_assoc($result)) {
		  $answer_set[$id++] = $row; 
		  $fontClass = ($row['is_correct'] == 1)?"correct":"";
            
                  $ansHtml .= $id.'. <span class="'.$fontClass.'">'.checkAnsFormat($row['answer_text']).'</span><br>';
		}
		$ansHtml .= '</div>';	
		return $ansHtml;
	}

	function get_question_answers($question_id) {
		global $db;

	
		$safe_question_id = mysqli_real_escape_string($db, $question_id);

		$query 	= "SELECT * ";
		$query .= "FROM answer ";
		$query .= "WHERE question_id = {$safe_question_id}";
		$result = mysqli_query($db, $query);
		confirm_query($result);
		$answer_set = array();
		$id = 0;
		while ($row = mysqli_fetch_assoc($result)) {
		  $answer_set[$id++] = $row; 
		}
			
		return $answer_set;
	}

  
?>