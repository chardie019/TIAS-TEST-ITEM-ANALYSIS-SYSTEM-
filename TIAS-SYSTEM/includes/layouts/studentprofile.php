
   
      
<ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown user-dropdown">
          
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user']['Firstname'];?> <?php echo $_SESSION['user']['Middlename'];?> <?php echo $_SESSION['user']['Lastname'];?>  <b class="caret"></b></a>
          <ul class="dropdown-menu">
           
                   
            
            <li class="divider"></li>
            <li><a href="student.php"><i class="fa fa-power-off"></i> Log Out</a></li>
          </ul>
    </li>
</ul>
