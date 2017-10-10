


<?php include('../includes/layouts/header.php'); ?>
<?php $page = "index.php"; ?>
<?php require_once("../includes/sessions.php"); ?>
  

<body>

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
    </div>
  </nav>
  <div id="page-wrapper">
<div class="col-lg-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">REDIRECTED HERE FOR A REASON OF</h3>
                </div>
                <div class="panel-body">
                 <li class="active"><a href="KR20.php"><i class="icon-dashboard"></i>BACK</a></li>   
                </div>
              </div>  
          
          </ol>
        </div>
      </div>
      <?php echo user_form_failure_msg(); ?>

  </div>

<?php include('../includes/layouts/footer.php'); ?>