<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php $users_list = get_myaccount(); ?>
<?php

                while($row = mysqli_fetch_assoc($users_list)) {
               
              ?>
   
        <thead>
<ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown user-dropdown">
          <input type="hidden" id="creadtedby" name="createdby" value"<?php echo $createdby = $_SESSION['user']['Username']; ?>" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user']['Firstname'];?> <?php echo $_SESSION['user']['Middlename'];?> <?php echo $_SESSION['user']['Lastname'];?>  <b class="caret"></b></a>
          <ul class="dropdown-menu">
          	<input type="hidden" id="creadtedby" name="createdby" value"<?php echo $createdby = $_SESSION['user']['Username']; ?>" >

          
           <td>
                            <li><a href="changeaccount.php?user_id=<?php echo htmlentities($row['Account_id']); ?>" ><i class="fa fa-gear"></i> Settings</a></li>  
                    </td>
                   
            
            <li class="divider"></li>
            <li><a href="process-logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
          </ul>
    </li>
</ul>

 <?php
                }
              ?>
              <?php
              
                mysqli_free_result($users_list);
              ?>