<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation-functions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php include('../includes/layouts/header.php'); ?>

<?php $page = "new-exam.php"; ?>





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

    <div class="row">
     <div class="col-lg-12">
              <div class="">
                <div class="panel-heading">
                
                </div>
                <div class="panel-body">
                
                </div>
              </div>  
          
          </ol>
        </div>
      </div>
    <?php 
      if(!empty($message)) { 
    
        echo "<div class=\"alert alert-dismissable alert-danger col-lg-4 col-lg-offset-1 pull-left\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>";
        echo "<strong><?php echo $message; ?></strong>";
        echo "</div>";
      }
    ?>
    <?php echo display_form_errors($error_messages); ?>




      <div class="clearfix"></div>
        <div class="panel tbp-panel-inverse">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>FILL THE FOLLOWING DETAILS</strong></h3>
          </div>
          <div class="panel-body">
             <form class="form-horizontal" role="form" action="process-new-exam.php" method="post">
              <div class="form-group">
                <div class="col-lg-12"
             <label for="category" >Examination Term</label>
              <select class="form-control" id="term" name="term" class="input-xlarge" value="">
                <option value="Prelim">Prelim</option>
                <option value="Midterm">Midterm</option>
                <option value="Finals">Finals</option>
              </select>
              </div>
              
                 <div class="col-lg-12"
                <label for="category" >&nbsp;Examination Title</label>
                <div class="col-lg-13">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Calculus 1 Final Examination">
                </div>
              </div>
              <div class="col-lg-12"
                <label for="category" >&nbsp;Examination Subject</label>
                <div class="col-lg-13">
 <input class="form-control" id="subject" name="subject" type="text" placeholder="Math 61 (Calculus 1)  "/>         
                  </div
                        
                    <div class="col-lg-12"
              
                <div class="col-lg-13">
 <input type="hidden" class="form-control" id="date" name="date" type="date" placeholder="Math 61 (Calculus 1)  "/>         

<DIV>
                    
                    <div class="col-lg-13"
                <label for="category" >&nbsp;Time Limit (in Minutes)</label>
              
 <input class="form-control" id="allowed_time" name="allowed_time" type="integer" placeholder="Minutes"/>         


                  </div>     

<DIV>
                    
                    <div class="col-lg-13"
                <label for="category" >&nbsp;Exam Code</label>
              
 <textarea readonly id="code" type="text" name="code" style='width:100%;height:100px;color:red;font-size: 40px;'></textarea>


                  </div>

                  <br>
<button type="submit" class="btn btn-lg btn-primary pull-right" id="submit-new-quiz" name="submit-new-quiz"
                value="submit-new-quiz">Create</button>
        
               
             

              <div class="form-group">
                <div class="col-lg-offset-10 col-lg-0">
                 </div>
              </div>
          
            </form>
          </div>
      </div>
           
 
       

  </div><!-- /#page-wrapper -->
  <script type="text/javascript">

function randString(x){
    var s = "";
    while(s.length<x&&x>0){
        var r = Math.random();
        s+= (r<0.1?Math.floor(r*100):String.fromCharCode(Math.floor(r*26) + (r>0.5?97:65)));
    }
    return s;
}

document.getElementById("code").value = randString(18);


  </script>

<?php include('../includes/layouts/footer.php'); ?>