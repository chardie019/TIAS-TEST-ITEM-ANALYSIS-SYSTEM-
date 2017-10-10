
<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $page = "take-quizzes.php"; ?>

<?php include('../includes/layouts/header.php'); ?>
<?php $exam_list = get_all_exams1(); 
if(isset($_SESSION['user']['exam_id'])) unset($_SESSION['user']['exam_id']);
?>


<body>

<link href="css2/admin.css" rel="stylesheet" type="text/css" />

<link href="plug  ins/data-tables/DT_bootstrap.css" rel="stylesheet">
<link href="plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
<link href="plug  ins/data-tables/DT_bootstrap.css" rel="stylesheet">
<link href="plugins/advanced-datatable/css/demo_table.css" rel="stylesheet"
<div id="wrapper">

  
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  
    <?php include('../includes/layouts/admin-head.php'); ?>
     <?php include('../includes/layouts/studentprofile.php'); ?>



    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

  
    <div class="row">
	   
      <ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown user-dropdown">
 
  
         
           
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <div id="page-wrapper">
    

    
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

  </nav>
  <div class="col-lg-12">
       <div class="panel panel-info">
              <div class="panel-heading">
                <strong class="panel-title">WELCOME   
                  <?php echo $_SESSION['user']['Lastname']; ?>, <?php echo $_SESSION['user']['Firstname']; ?>
                  <?php echo $_SESSION['user']['Middlename']; ?>
                </strong>
       
              </div>
              <div class="panel-body">
               <P>*SELECT FROM THE LIST OF EXAMINATION THAT YOU WANTED TO TAKE<P>
           
              </div>
            </div>
    
  
 
        <ol class="breadcrumb">
         
        </ol>

        <?php echo user_form_success_msg(); ?>
        <?php echo delete_failure_msg(); ?>
 <script type="text/javascript">
<!--
 $('#user').modal({ show: true });
//-->
</script>
        
  
       <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
             
            </div>
         <div class="porlets-content">
         
         <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
        
        <thead>

                 <th>Created By :<i class="fa fa-sort"></i></th>
                 
                  <th>Exam Term<i class="fa fa-sort"></i></th>
                  <th width="20%">Name Of The Exam</th>
                  <th width="15%">Title</i></th>
                  <th>Total Number Of Questions</th>
                  
                  <th>Action</th>
                 
                  </tr>
              </thead>
              <tbody id="user-rows">     

              <?php
 $cnt = 0;
                while($row = mysqli_fetch_assoc($exam_list)) {
               
                $cnt++;
              ?>

                  <tr

                    <td>
</td>
                 
                     
                     


                    <td><?php echo $row['Created_By']; ?></td>
                    <td><?php echo $row['exam_term']; ?></td>
                    <td><?php echo $row['exam_title']; ?></td>
                    <td><?php echo $row['exam_subject']; ?></td>
                    <td><?php echo get_quiz_question_count($row['exam_id']); ?></td>
                   
					    
                    <td>
				
					 <input type="checkbox" class="chk1" name="name" /><label>Validate  ✓</label>
					<a id="btnClick" disabled="disabled" class="btn btn-danger" href="Examination.php?exam_id=<?php echo htmlentities ($row['exam_id']); ?>"  data-target="#take" >TAKE NOW</a></div>
					 
                    </td>
                  </tr>

              <?php
                }
              ?>
              
              <?php
                // Release the returned data
                mysqli_free_result($exam_list);
              ?>
        <script type="text/javascript">
<!--
 $('#take').modal({ show: true });
//-->
</script>



              </tbody>
            </table>
		
          </div>
      </div>
    </div>

  </div>

<?php include('../includes/layouts/footer.php'); ?>
<?php require_once("../includes/db-connection-close.php"); ?>

<script src="js2/jquery-2.1.0.js"></script>
<script src="otherassets/js/enable.js"></script>
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
 
