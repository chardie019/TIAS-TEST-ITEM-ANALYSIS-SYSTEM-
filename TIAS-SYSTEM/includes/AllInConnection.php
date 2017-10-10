
<?php
  $db_path='C:\wamp\www\ItemAnalysis\ITEMANALYSIS.FDB';
  $username='sysdba';
  $password='masterkey';
  ibase_connect($db_path,$username,$password) or die (ibase_errmsg());
	

	?>