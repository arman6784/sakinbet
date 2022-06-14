<?php
require('includes/applications.php');
header("X-XSS-Protection: 1; mode=block");

$userid1=$_SESSION['user_id'];
if (isset($_REQUEST['delform'])){
 $sql = "DELETE FROM forms WHERE form_user='$userid1' and form_done<'1' "; 
         mysql_query($sql)  or die(mysql_error());
}

//logoff
if ((isset($_REQUEST['where'])) AND ($_REQUEST['where'] == "logoff")) {
	tep_session_unregister('user_id');
	tep_session_unregister('user_user');
	tep_session_unregister('username');
	 echo "<script>document.location.href='http://bezjibet1.com/users/logout'</script>\n";
exit;
}
//get user info
if ((isset($_SESSION['user_id'])) AND ($_SESSION['user_id'] > 0)) {
	$userinfo = tep_db_fetch_array (tep_db_query("SELECT * FROM `users` WHERE id = '" . (int)$_SESSION['user_id'] . "'"));
}

 
?>


<?php 

$where=$_REQUEST['where'];
if ((isset($_REQUEST['where'])) AND ($where=="liveshockey")) {  include("pages/liveshockey.php");}else
if ((isset($_REQUEST['where'])) AND ($where=="livesbasket")) {  include("pages/livesbasket.php");}else{  include("pages/lives.php");}


?>