<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $page = "manage-users.php"; ?>

<?php $users_list = get_all_users1(); ?>





<?php include('../includes/layouts/header.php'); ?>



<link href="css2/admin.css" rel="stylesheet" type="text/css" />


<body>
   

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
     <?php include('../includes/layouts/admin-head2.php'); ?>
    </div>

 
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php include('../includes/layouts/admin-side-nav1.php'); ?>

           <?php include('../includes/layouts/admin-profile1.php'); ?>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>
  <div id="page-wrapper">
    
    <div class="row">
     <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title" style="color:black;">ACCOUNT MANAGEMENT - CONTROL PANEL</h3>
              </div>
              <div class="panel-body">
               <li class="active"><a href="#"><i class="icon-dashboard"></i>TEACHER'S LIST OF ACCOUNTS</a></li>   
              </div>
            </div>  
        
        </ol>
      </div>
    </div>


       
          
        </ol>

       
        <?php echo user_form_success_msg(); ?>
        <?php echo delete_failure_msg(); ?>

        <div class="clearfix"></div>

       
        
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
            
            </div>
         <div class="porlets-content">
         
         <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
        
        <thead>
                     <tr>
                   <th>Account ID <i class="fa fa-sort"></i></th>
                  <th>Firstname <i class="fa fa-sort"></i></th>
                  <th>Middlename <i class="fa fa-sort"></i></th>
                  <th>Lastname<i class="fa fa-sort"></i></th>
                  <th>Username<i class="fa fa-sort"></i></th>
                  <th>Usertype <i class="fa fa-sort"></i></th>
                   <th>Status<i class="fa fa-sort"></i></th>
                  <th>Edit</th>
                 
                 

                </tr>
              </thead>
              <tbody id="user-rows">     

              <?php

                while($row = mysqli_fetch_assoc($users_list)) {
               
              ?>
                  
                  <tr>
                    <td><?php echo $row['Account_id']; ?></td>
                    <td><?php echo $row['Firstname']; ?></td>
                    <td><?php echo $row['Middlename']; ?></td>
                    <td><?php echo $row['Lastname']; ?></td>
                    <td><?php echo $row['Username']; ?></td>
                    <td><?php echo $row['Usertype']; ?></td>
                    <input type="hidden" value="<?php echo $status= $row['status']; ?>">
                     <td> <?php echo account_status($status); ?></td>

                    
                    
                    
                     
                   <td>

                        <a href="edit-user.php?user_id=<?php echo htmlentities($row['Account_id']); ?>" ><i class="fa fa-edit fa-2x"></i> Edit</a>                
                    </td>
                
                  
                  </tr>

                    

                

                  <div class="modal fade" id="confirm-delete-modal<?php echo htmlentities($row['Account_id']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
                        </div>
                        <div class="modal-body">
                          You are about to delete a user. This action will be irreversible.<br />
                          Do you wish to proceed?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          <a href="delete-user.php?user_id=<?php echo htmlentities($row['Account_id']); ?>" class="btn btn-primary">Yes</a>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.modal fade -->


                  <div class="modal fade" id="acd<?php echo htmlentities($row['Account_id']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="confirm-delate-label">Warning!</h4>
                        </div>
                        <div class="modal-body">
                         You are about to deactivate a user.<br />
                          Do you wish to proceed?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          <a href="delete-user.php?user_id=<?php echo htmlentities($row['Account_id']); ?>" class="btn btn-primary">Yes</a>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.modal fade -->
              <?php
                }
              ?>
              <?php
                // Release the returned data
                mysqli_free_result($users_list);
              ?>
        
              </tbody>
            </table>
          </div><!-- /.table-responsive -->
      </div>
    
        
      

  



<script src="js2/jquery-2.1.0.js"></script>
<script src="js2/bootstrap.min.js"></script>
<script src="js2/common-script.js"></script>
<script src="js2/jquery.slimscroll.min.js"></script>
<script src="plugins/data-tables/jquery.dataTables.js"></script>
<script src="plugins/data-tables/DT_bootstrap.js"></script>
<script src="plugins/data-tables/dynamic_table_init.js"></script>
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

<script>
$('#acd').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});
</script>

<?php require_once("../includes/db-connection-close.php"); ?>