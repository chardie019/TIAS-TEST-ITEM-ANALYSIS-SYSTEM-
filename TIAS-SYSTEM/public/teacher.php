


<?php include('../includes/layouts/header.php'); ?>
<?php $page = "index.php"; ?>
<?php require_once("../includes/sessions.php"); ?>
  
<link rel="stylesheet" href="css/style.css"> <!-- Generic style (Boilerplate) -->
  <link rel="stylesheet" href="css1/960.fluid.css"> <!-- 960.gs Grid System -->
  <link rel="stylesheet" href="css1/main.css"> <!-- Complete Layout and main styles -->
  <link rel="stylesheet" href="css1/buttons.css"> <!-- Buttons, optional -->
  <link rel="stylesheet" href="css1/lists.css"> <!-- Lists, optional -->
  <link rel="stylesheet" href="css1/icons.css"> <!-- Icons, optional -->
  <link rel="stylesheet" href="css1/notifications.css"> <!-- Notifications, optional -->
  <link rel="stylesheet" href="css1/typography.css"> <!-- Typography -->
  <link rel="stylesheet" href="css1/forms.css"> <!-- Forms, optional -->
  <link rel="stylesheet" href="css1/tables.css"> <!-- Tables, optional -->
  <link rel="stylesheet" href="css1/charts.css"> <!-- Charts, optional -->
  <link rel="stylesheet" href="css1/jquery-ui-1.8.15.custom.css"> 
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

      
      
      <div class="grid_13">
        <div class="block-border1">
          <div class="block-content1">
            <ul class="shortcut-list">

              <li>
                  
                <a href="manage-questions.php">
                  
                  <img src="img/icons/packs/crystal/48x48/apps/kedit.png">


                </a>
                  <centeR><P class="label label-success">Bank(Un-evaluated)</P></CENTER>
              </li>
              <li>
                <a href="discardedquestions.php">
                   
                  <img src="img/icons/packs/crystal/48x48/apps/folder_red.png">
               
                </a>
                 <centeR><P class="label label-success">Bank(Discarded)</P></CENTER>
              </li>
              <li>
                <a href="retained.php">
                   
                  <img src="img/icons/packs/crystal/48x48/apps/folder_green.png">
               
                </a>
                <centeR><P class="label label-success">Bank(Retained)</P></CENTER>
              </li>
              <li>
                <a href="revised.php">
                   
                  <img src="img/icons/packs/crystal/48x48/apps/folder_blue.png">
               
                </a>
                <centeR><P class="label label-success">Bank(Revised)</P></CENTER>
              </li>
              <li>
               
                <a href="studentsdata.php">
                      
          <img src="img/icons/packs/crystal/48x48/apps/kdmconfig.png">>
                  
                </a>
                <centeR><P class="label label-success">Student's Scores</P></CENTER>
              </li>
              <li>
                <a href="KR20.PHP">
                  
                  <img src="img/icons/packs/crystal/48x48/apps/xcalc.png">
                 
                </a>
                  <centeR><P class="label label-success">Test Reliability (kr20)</P></CENTER>
              </li>
              <li>
                <a href="distractoranalysis.php">
                 
                  <img src="img/icons/packs/crystal/48x48/apps/Volume Manager.png">
                  
                </a>
                  <centeR><P class="label label-success">Distractor Analysis</P></CENTER>
              </li>
              <li>
          
                <a href="itemdiscrimination.php">
                  
                  <img src="img/icons/packs/crystal/48x48/apps/kspread.png">
              
                </a>
                  <centeR><P class="label label-success">Discrimination Index</P></CENTER>
              </li>
              <li>
                <a href="itemdifficulty.php">
              
                  <img src="img/icons/packs/crystal/48x48/apps/kformula.png">
               
                </a>
                  <centeR><P class="label label-success">Difficulty Index</P></CENTER>
              </li>
               <li>
            </ul>
            <div class="clear"></div>
          </div>
        </div>
      </div>
      
      <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script> <!-- lightweight wrapper for consolelog, optional -->
  <script defer src="js/mylibs/jquery-ui-1.8.15.custom.min.js"></script> <!-- jQuery UI -->
  <script defer src="js/mylibs/jquery.notifications.js"></script> <!-- Notifications  -->
  <script defer src="js/mylibs/jquery.uniform.min.js"></script> <!-- Uniform (Look & Feel from forms) -->
  <script defer src="js/mylibs/jquery.validate.min.js"></script> <!-- Validation from forms -->
  <script defer src="js/mylibs/jquery.dataTables.min.js"></script> <!-- Tables -->
  <script defer src="js/mylibs/jquery.tipsy.js"></script> <!-- Tooltips -->
  <script defer src="js/mylibs/excanvas.js"></script> <!-- Charts -->
  <script defer src="js/mylibs/jquery.visualize.js"></script> <!-- Charts -->
  <script defer src="js/mylibs/jquery.slidernav.min.js"></script> <!-- Contact List -->
  <script defer src="js/common.js"></script> <!-- Generic functions -->
  <script defer src="js/script.js"></script> <!-- Generic scripts -->

  </div><!-- /#page-wrapper -->

<?php include('../includes/layouts/footer.php'); ?>