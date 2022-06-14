<?php
require_once("p/data/html_dom/simple_html_dom.php");
$AccountID=$_GET['AccountID'];
$PassPhrase=$_GET['PassPhrase'];
$Payee_Account=$_GET['Payee_Account'];
$ev_number=$_GET['ev_number'];
$ev_code=$_GET['ev_code'];

$file= file_get_contents("https://perfectmoney.is/acct/ev_activate.asp?AccountID=$AccountID&PassPhrase=$PassPhrase&Payee_Account=$Payee_Account&ev_number=$ev_number&ev_code=$ev_code");
$html = str_get_html($file);

foreach ($html->find('table ') as $li) {
 
 $mablagh = $li->find("td ", 5)->innertext; 
 $batchid = $li->find("td ", 11)->innertext; 
 
 if ($batchid>1000){
 echo $mablagh;
 
}}
?>

