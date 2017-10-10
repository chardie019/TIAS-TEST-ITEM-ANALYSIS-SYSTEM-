<?php require_once("../includes/sessions.php"); ?>

<?php 
if(isset($_SESSION['user']['quiz'])) unset($_SESSION['user']['quiz']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  
  
  
    <title>ITEM ANALYZER</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <style type="text/css">
 
    
    body {
        background-color: #444;
        background: url(assets/img/backgrounds/1.jpg);
        
    }
    .form-signin input[type="text"] {
        margin-bottom: 5px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        font-family: 'Open Sans', Arial, Helvetica, sans-serif;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .vertical-offset-100 {
        padding-top: 100px;
    }
    .img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
    margin: auto;
    }
    .panel {
    margin-bottom: 20px;
    background-color: rgba(255, 255, 255, 0.75);
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }
    </style>
    <script type="text/javascript">

     function checkPass()
    {
       
        var pass1 = document.getElementById('password');
        var pass2 = document.getElementById('confirm-password');
     
        var message = document.getElementById('confirmMessage');
      
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
      
        if(pass1.value = pass2.value){
          
            pass2.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "Passwords Match!"
        }else{
            
            pass2.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "Passwords Do Not Match!"
        }
    }  
        

    </script>
  
	<script src="otherassets/js/jelord1.js"></script>
     <script src="otherassets/bootstrap/jelord0.js"></script>
</head>
<body>
         <?php echo delete_failure_msg(); ?>
         <?php echo user_form_failure_msg(); ?>
        <?php echo user_form_success_msg(); ?>
        <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
		
        <link rel="stylesheet" href="asset/css/style.css">
		   <link rel="stylesheet" href="asset/style/design.css">
		

        <body>
            <div class="container">
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <div class="row-fluid user-row">
								<font  size="3" face="Courier New Bold Italic" color="black"> Mindanao State University At Naawan</font>
                                    <img src="assets/img/backgrounds/logo.png" class="img-responsive" alt="Conxole Admin"/>
                                </div>
                            </div>
							<p>EXAMINATION CODE : LwJxDqoFDz</p>
                            <div class="panel-body">
                                <form class="form-signin" method="post" action="process-studentlogin.php">
								
                                    <fieldset>
                                        <label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>
                                      </a>
                                        <input class="form-control" name="username" placeholder="Username" id="username" type="text">
                                        <input class="form-control" name="password" placeholder="Password" id="password" type="password">
                                        <input class="form-control" name="code" placeholder="Examination Code" id="code" type="password">
										
   
             
                                      
			  <div>

</form>
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">
        					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        				</button>
        				<h3 class="modal-title" id="modal-register-label">Create Your Account Here</h3>
						
        				<p>Fill in the form below to get instant access:</p>
        			</div>
        			
        			<div class="modal-body">
        				
	                    <form role="form"  action="processstudentreg.php" method="post" class="registration-form">
	                    	<div class="form-group">
	                    		<label class="sr-only" for="form-first-name">Firstname</label>
	                        	<input type="text" name="first_name" id="first_name" placeholder="First name..." class="form-first-name form-control" >
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-last-name">Middlename</label>
	                        	<input type="text" name="middle_name" placeholder="Middlename..." class="form-last-name form-control" id="middle_name"  >
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-email">Lastname</label>
	                        	<input type="text" name="last_name" placeholder="Lastname..." class="form-email form-control" id="last_name">
	                        </div>
							 <div class="form-group">
	                        	<label class="sr-only" for="form-email">Username</label>
	                        	<input type="text" name="username" placeholder="Account Username..." class="form-email form-control" id="username">
	                        </div>
							 <div class="form-group">
	                        	<label class="sr-only" for="pass1">Password</label>
	                        	<input type="password" id="password" name="password" placeholder="Account Password" class="form-control" id="password">
	                        </div>
							<div class="form-group">
	                        	<label class="sr-only" for="pass2">Password Confirmation</label>
	                        	<input type="password" id="confirm-password" name="confirm-password" placeholder="Password Confirmation" class=" form-control" onkeyup="checkPass(); return false;">
                                <span id="confirmMessage" class="confirmMessage"></span>
	                        </div>

                             <input class="form-control" type="hidden" id="status" name="status" value="ACTIVE">
							<label for="first_name">Identification Number: </label>
              <input class="form-control" style="width: 175px;" id="id_number" name="id_number" value="<?php echo isset($form_values['id_number']) ? $form_values['id_number'] : '' ?>" type="text" placeholder="Your ID Number" class="input-xlarge">	
	                        <div class="form-group">
							
	                        	 <label for="user_type">You're A</label>
              <select class="form-control" id="user_type" name="user_type" class="input-xlarge" value="">
               
                   <option value="student">Student</option>
              </select>
	                        </div>
	                        <button  class="pull-right btn btn-success" type ="submit" id="submit-new-user" name="submit-new-user" value="submit-new-user">Create My Account</button>
                            <a  type ="hidden" id="submit-new-user" name="submit-new-user" value="submit-new-user"> &nbsp;</a>
	                    </form>
	                    
        			</div>
        			
        		</div>
        	</div>
			
        </div>
		

                                        <br></br>
										
                               <input class="btn btn-lg btn-primary launch-modal btn btn-lg btn-" href="#" data-modal-id="modal-register"  type="submit" id="login" value="Create">
										  <input class="btn btn-lg btn-success" type="submit" name="submit-login"  id="submit-login" value="Log-in">
										 
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
            </div>
<script type="text/javascript">


$(document).ready(function() {
    $(document).mousemove(function(event) {
        TweenLite.to($("body"), 
        .5, {
            css: {
                backgroundPosition: "" + parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / '12') + "px, " + parseInt(event.pageX / '15') + "px " + parseInt(event.pageY / '15') + "px, " + parseInt(event.pageX / '30') + "px " + parseInt(event.pageY / '30') + "px",
            	"background-position": parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / 12) + "px, " + parseInt(event.pageX / 15) + "px " + parseInt(event.pageY / 15) + "px, " + parseInt(event.pageX / 30) + "px " + parseInt(event.pageY / 30) + "px"
            }
        })
    })
})
		
		 
	
		
</script>


              <script src="asset/js/jquery-1.11.1.min.js"> </script>
        <script src="asset/bootstrap/js/bootstrap.min.js"></script>
        <script src="asset/js/jquery.backstretch.min.js"></script>
        <script src="asset/js/scripts.js"></script>
<script type = "text/javascript" >
    history.pushState(null, null, 'studentsindex.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'studentsindex');
    });
    </script>   		
</body>
</html>
