<ul class="nav navbar-nav side-nav">
	<li class="<?php echo ($page == "teacher.php" ? "active" : "")?>"><a href="teacher.php"><i class="fa fa-dashboard"></i> TEACHER'S PAGE</a></li>

	

	<li class="dropdown <?php echo (($page == "new-exam.php" || $page == "new-question.php" || $page == "manage-exams.php" || $page == "discardedquestions.php" || $page == "import-question.php") ? "open" : "")?>">
	  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> EXAMS<b class="caret"></b></a>
	  <ul class="dropdown-menu">
	    <li class="<?php echo ($page == "new-exam.php" ? "active" : "")?>"><a href="new-exam.php">Create Examination</a></li>
	    <li class="<?php echo ($page == "new-question.php" ? "active" : "")?>"><a href="new-question.php">Create Test Question</a></li>
	    <li class="<?php echo ($page == "manage-quizzes.php" ? "active" : "")?>"><a href="manage-exams.php">Manage Examinations</a></li>

	  </ul>
	</li>

	<li class="dropdown <?php echo (($page == "manage-questions.php" || $page == "revised.php" || $page == "retained.php" || $page == "discardedquestions.php" || $page == "import-question.php") ? "open" : "")?>">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> QUESTION BANK<b class="caret"></b></a>
	  <ul class="dropdown-menu">
	    <li class="<?php echo ($page == "manage-questions.php" ? "active" : "")?>"><a href="manage-questions.php">Un-Evaluated</a></li>
	    <li class="<?php echo ($page == "revised.php" ? "active" : "")?>"><a href="revised.php">Revised Questions</a></li>
	     <li class="<?php echo ($page == "retained.php" ? "active" : "")?>"><a href="retained.php">Retained Questions</a></li>
	    <li class="<?php echo ($page == "discardedquestions.php" ? "active" : "")?>"><a href="discardedquestions.php">Discarded Questions</a></li>
	  </ul>
	</li>
<li class="dropdown <?php echo (($page == "studentsdata.php" || $page == "revised.php" || $page == "retained.php" || $page == "discardedquestions.php" || $page == "import-question.php") ? "open" : "")?>">
	  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>EXAM RESULT<b class="caret"></b></a>
	  <ul class="dropdown-menu">
	    <li class="<?php echo ($page == "studentsdata.php" ? "active" : "")?>"><a href="studentsdata.php">View Exam Result</a></li>

	  </ul>
	</li>

	
	<li class="dropdown <?php echo (($page == "KR20.php" || $page == "itemdifficulty.php" || $page == "itemdiscrimination.php" || $page == "distractoranalysis.php" || $page == "import-question.php") ? "open" : "")?>">
	  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>ITEM ANALYSIS<b class="caret"></b></a>
	  <ul class="dropdown-menu">
	    <li class="<?php echo ($page == "KR20.php" ? "active" : "")?>"><a href="KR20.php">TEST RELIABILITY</a></li>
	    <li class="<?php echo ($page == "itemdifficulty.php" ? "active" : "")?>"><a href="itemdifficulty.php">DIFFICULTY INDEX</a></li>
	    <li class="<?php echo ($page == "itemdiscrimination.php" ? "active" : "")?>"><a href="itemdiscrimination.php">DISCRIMINATION INDEX</a></li>
	     <li class="<?php echo ($page == "distractoranalysis.php" ? "active" : "")?>"><a href="distractoranalysis.php">DISTRACTOR ANALYSIS</a></li>
	   
	  </ul>
	 
	</li>


</ul>