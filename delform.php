<?php
include'db.php';

$userid1=$_POST['uses'];
 $sql = "DELETE FROM forms WHERE form_user='$userid1' and form_done<'1' "; 
         mysql_query($sql)  or die(mysql_error());



$refer=$_SERVER['HTTP_REFERER'];

?>

<script>document.location.href='<?php echo $refer;  ?>'</script>
