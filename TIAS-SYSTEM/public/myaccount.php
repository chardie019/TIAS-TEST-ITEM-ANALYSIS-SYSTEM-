<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $page = "manage-users.php"; ?>

<?php $users_list = get_myaccount(); ?>





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
     

           <?php include('../includes/layouts/studentprofile.php'); ?>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>
  <div id="page-wrapper">
    
    <div class="row">
     <div class="col-lg-12">
            <div class="panel panel-primary">
            
            </div>  
        
        </ol>
      </div>
    </div>


       
          
        </ol>

       
        <?php echo user_form_success_msg(); ?>
        <?php echo delete_failure_msg(); ?>

       
        
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