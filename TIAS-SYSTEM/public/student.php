

<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db-connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $page = "student.php"; ?>
<head>
  <meta charset="utf-8">
  
  
  <link rel=dns-prefetch href="//fonts.googleapis.com">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>TEST ITEM ANALYSIS SYSTEM</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 376px; width: 1349px; z-index: -999999; position: fixed;"><img src="assets/img/backgrounds/1.jpg" style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1349px; height: 899.333px; max-height: none; max-width: none; z-index: -999999; left: 0px; top: -261.667px;"></div>
 
<img src="assets/img/backgrounds/1.jpg" style="position: absolute; margin: 0px; padding: 0px; backgroundsorder: none; width: 1349px; height: 899.333px; max-height: none; max-width: none; z-index: -999999; left: 0px; top: -180.667px;">
   <div>
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="css1/style.css"> 
  <link rel="stylesheet" href="css1/960.fluid.css"> 
  <link rel="stylesheet" href="css1/main.css">
  <link rel="stylesheet" href="css1/buttons.css"> <!-- Buttons, optional -->
  <link rel="stylesheet" href="css1/lists.css"> <!-- Lists, optional -->
  <link rel="stylesheet" href="css1/icons.css"> <!-- Icons, optional -->
  <link rel="stylesheet" href="css1/notifications.css"> <!-- Notifications, optional -->
  <link rel="stylesheet" href="css1/typography.css"> <!-- Typography -->
  <link rel="stylesheet" href="css1/forms.css"> <!-- Forms, optional -->
  <link rel="stylesheet" href="css1/tables.css"> <!-- Tables, optional -->
  <link rel="stylesheet" href="css1/charts.css"> <!-- Charts, optional -->
  <link rel="stylesheet" href="css1/jquery-ui-1.8.15.custom.css"> <!-- jQuery UI, optional -->
  <!-- end CSS-->
  
  <!-- Fonts -->
  <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
  <!-- end Fonts-->

  <script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body class="special-page">

    <section id="login-box">

     <script type="text/javascript">

     function checkPass()
    {
       
        var pass1 = document.getElementById('idnumber');
        var pass2 = document.getElementById('id2');
      
     
        var message = document.getElementById('msg');
      
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
      
        if(pass1.value == pass2.value) {
          
            pass1.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "WARNING : T"
        }else{
            
            pass2.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "NOTE : THIS ID NUMBER WILL SERVE AS YOUR ACCESS"
        }
    }  
        

    </script>
 
    <div class="grid_6">
        <div class="block-border">
          <div class="block-header">
           <h1> <center>Fill the following fields</center> </h1><span></span>
          </div>

          <form id="form" class="block-content form" action="process-student.php" method="post">
            <fieldset>
              <legend>Personal Information</legend>
              <div class="_50">
                <p><label for="textfield1">Firstname</label> <input type="text" name="first_name" class="form-control" placeholder="Jelord Rey" autofocus></p>
              </div>

              
              <div class="_50">
                <p><label for="textfield2">Middlename</label> <input type="text" name="middle_name" class="form-control" placeholder="Tapdasan" ></p>
              </div>
              
              <div class="_100">
                <p><label required for="textfield2">Lastname</label> <input type="text" name="last_name" class="form-control" placeholder="Gulle" ></p>
              </div>
            </fieldset>
            
            <fieldset>
              <legend>Your Identification Number</legend>
              <p class="inline-small-label">
                <label id=for="field4">ID NO.</label>
                 <input type="text" id="idnumber" name="idnumber" onkeyup="checkPass(); return false;" class="form-control" placeholder="Id Number" >
                <input type="hidden" value="9999" id="id2" type="text" name="id2">
                 <span id="msg" class="msg"></span>
              </p>
             
            </fieldset>
            
            <fieldset>
              <legend>CODE FOR ACCESS</legend>
              <div class="_100">
              <p class="inline-small-label">
                <label for="field5">Exam Code</label>
                <input style="color:red;font-size:180%;"  type="text" id="examcode" name="examcode" class="form-control"  placeholder="xHgsbY19" >
              </p>
            </div>

            </fieldset>
            
            <div class="block-actions">
              <ul class="actions-left">
             
              </ul>
              <ul class="actions-right">

            <button class="" type="submit" name="submit-login">PROCEED</button>

            <li></li>




              </ul>
            </div>
          </form>
        </div>
      </div>
      
    </section> <!--! end of #login-box -->
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script> <!-- lightweight wrapper for consolelog, optional -->
  <script defer src="js/mylibs/jquery.notifications.js"></script> <!-- Notifications  -->
  <script defer src="js/mylibs/jquery.uniform.min.js"></script> <!-- Uniform (Look & Feel from forms) -->
  <script defer src="js/mylibs/jquery.validate.min.js"></script> <!-- Validation from forms -->
  <script defer src="js/mylibs/jquery.tipsy.js"></script> <!-- Tooltips -->
  <script defer src="js/common.js"></script> <!-- Generic functions -->
  <script defer src="js/script.js"></script> <!-- Generic scripts -->
  
  <script type="text/javascript">
	$().ready(function() {
		
		/*
		 * Validate the form when it is submitted
		 */
		var validatelogin = $("#login-form").validate({
			invalidHandler: function(form, validator) {
      			var errors = validator.numberOfInvalids();
      			if (errors) {
        			var message = errors == 1
			          ? 'You missed 1 field. It has been highlighted.'
			          : 'You missed ' + errors + ' fields. They have been highlighted.';
        			$('#login-form').removeAlertBoxes();
        			$('#login-form').alertBox(message, {type: 'error'});
        			
      			} else {
       			 	$('#login-form').removeAlertBoxes();
      			}
    		}
		});
		
		jQuery("#reset-login").click(function() {
			validatelogin.resetForm();
		});
				
	});
  </script>
  <!-- end scripts-->

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>
