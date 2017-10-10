<?php require_once("../includes/sessions.php"); ?>

<?php $page = "index.php"; ?>
 

<!DOCTYPE html>
<html lang="en">

    <head>
    
        <?php echo delete_failure_msg(); ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ATIAS</title>

        <!-- CSS -->
        <link rel="stylesheet" href="assets/bootstrap/css/jelord.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body onload="ini()">

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1 style="color:grey"><strong style="color:grey;">TEST ITEM ANALYSIS SYSTEM</strong >(TIAS)</h1>    
                            <div class="description">
                            	
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>System Login</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                  <form class="form-signin" method="post" action="process-login.php">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	 <input onkeypress="ini()" type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus>
			                        </div>
			                        <div class="form-group">
			                        	<label onkeypress="ini()" class="sr-only" for="form-password">Password</label>
			                        	 <input type="password" id="password" name="password" class="form-control" placeholder="Password">
			                        </div>
                                       
                                        <select placeholder="" style="color:grey;" class="form-control" id="usertype" name="usertype" class="input-xlarge" value="Usertype" onchange="ini()">
               <option  value="0">Usertype</option>
                <option  value="admin">Administrator</option>
                <option value="teacher">Teacher</option>
                  
              </select>
                <label for="user_type"></label>
                                    <div>
                                  
             <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit-login" name="submit-login">Log in</button>
			                      
			                    </form>
		                    </div>
                          

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
     	<script type="text/javascript">
	function ini() {
		var index=document.getElementById('usertype').selectedIndex;
		if (index==0) {
			document.getElementById('submit-login').disabled=true;
		}
		else {
			document.getElementById('submit-login').disabled=false;
		}
	}
</script>

    </body>
<script type = "text/javascript" >
    history.pushState(null, null, 'index.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'index.php');
    });
    </script>
<script>

</html>