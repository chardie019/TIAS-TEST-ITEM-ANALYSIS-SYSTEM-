<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $page = "manage-users.php"; ?>

<?php $exam_list = get_all_exams(); ?>






<?php include('../includes/layouts/header.php'); ?>



<link href="css2/admin.css" rel="stylesheet" type="text/css" />


<body>
 <link href="common.css" rel="stylesheet" />
  
  <script type="text/javascript">
  
  function fShowLoading(){
   
        $("<div class='jf-spinner'><img class='jf-spinner-img' src='jf-spinner-img.gif' alt='' /></div>").appendTo("body");
        setTimeout(function () {
            $("body div.jf-spinner").remove();

        }, 1000);
  }

  </script>  

<link href="plug  ins/data-tables/DT_bootstrap.css" rel="stylesheet">
<link href="plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">


<div id="wrapper">

  
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php include('../includes/layouts/admin-head.php'); ?>
    </div>

    
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
                  
                    <th>EXAM.ID <i class="fa fa-sort"></i></th>
                  <th>EXAMINATION TERM <i class="fa fa-sort"></i></th>
                  <th>EXAMINATION NAME<i class="fa fa-sort"></i></th>
                  <th>SUBJECT<i class="fa fa-sort"></i></th>
                  <th>TOTAL NO. OF QUESTIONS<i class="fa fa-sort"></i></th>
                  <th>DIFFICULTY INDEX<i class="fa fa-sort"></i></th>
               
                
              </tr>
              </thead>
              <tbody id="user-rows">     


              <?php

              while($row = mysqli_fetch_assoc($exam_list)) {
               
              ?>
                  
                  <tr>
                    <td><?php echo $row['exam_id']; ?></td>
                    <td><?php echo $row['exam_term']; ?></td>
                    <td><?php echo $row['exam_title']; ?></td>
                    <td><?php echo $row['exam_subject']; ?></td>
                    <td><?php echo get_quiz_question_count($row['exam_id']); ?></td>
                    
                  
                
                   <td>
                        <a type="button" value="Test Loading" onclick="fShowLoading();" href="itemdifficultyresult.php?exam_id=<?php echo htmlentities($row['exam_id']); ?>" ><i class="fa fa-bar-chart-o fa-2x"></i>PERFORM</a>               
                    </td>

                    
                  
                    
                  </tr>


              
                
                  <div class="modal fade" id="confirm-delete-modal<?php echo htmlentities($row['exam_id']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
                        </div>
                        <div class="modal-body">
                          You are about to delete an examination. This action will be irreversible.<br />
                          Do you wish to proceed?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          <a href="delete-exam.php?exam_id=<?php echo $row["exam_id"]; ?>" class="btn btn-primary">Yes</a>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.modal fade -->

              <?php
                }
              ?>
              
              <?php
                // Release the returned data
                mysqli_free_result($exam_list);
              ?>
          </div><!-- /.table-responsive -->
      </div>
    
        
      

  



<script src="js2/jquery-2.1.0.js"></script>
<script src="js2/bootstrap.min.js"></script>
<script src="js2/common-script.js"></script>
<script src="js2/jquery.slimscroll.min.js"></script>
<script src="plugins/data-tables/jquery.dataTables.js"></script>
<script src="plugins/data-tables/DT_bootstrap.js"></script>
<script src="plugins/data-tables/dynamic_table_init1.js"></script>
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