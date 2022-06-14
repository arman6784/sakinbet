<?php
include'includes/dbc.php';
include_once("functions.php");

$result= mysqli_query($conn,"SELECT * FROM `settings` WHERE `code`='parskart_api'");
$row=mysqli_fetch_assoc($result);
$api_token= $row['value'];

$result2= mysqli_query($conn,"SELECT * FROM `settings` WHERE `code`='pasrkart_card'");
$row2=mysqli_fetch_assoc($result2);
$api_card_id= $row2['value'];	
	
$codek=rand(1000,99999).date('YmdHis');


$amount = $_POST['amount'];
$user = $_POST['user'];
$date=date('Y/m/d H:i:s');



if ($amount<1000){ 
 echo "<script>document.location.href='http://table.<?php echo $_SERVER[SERVER_NAME]; ?>/payment/credit'</script>\n"; 
 exit(); }
  
 
mysqli_query($conn,"INSERT INTO parskart (username,amount,tref,codek,date,status)
VALUES ('$user','$amount','0','$codek','$date','0')");

$amount=$amount*10;

$redirect = "http://table.".$_SERVER['SERVER_NAME']."/parskverify.php?code=".$codek;

$factorNumber = time();
$mobile = "09125877412";

 
$resultj = new_order($api_token, $api_card_id, $amount, $redirect, $factorNumber, $mobile);
$result = json_decode($resultj, true); 

 
$status1= $result['status'];
$redirect_url1= $result['redirect_url'];


if ($status1 == 1) {
   $go = $redirect_url1;
    header("Location: $go");
    echo 'Redirect to ' . $go . PHP_EOL;
} else {
    //echo "error " . $result->status . ' : ' . $result->message . PHP_EOL;

//Var_dump($result, $resultj) ;

}
 

?>










 