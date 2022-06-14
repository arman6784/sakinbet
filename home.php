<?php require('includes/applications.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript">
        var loaderURLFromRoot = 'bball/ajax-loader.gif';
    </script>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="bezjibet">
</head>

<body>
<div class="home">

<!--loading --><div id="loadinghome" class="loading"></div>

<?php 
$game_type = (isset($_GET['type']) ? $_GET['type'] : 'Football');
$game_type = trim($game_type);
$even = ($game_type == 'Football' || $game_type == 'handball' || $game_type == 'futsal' || $game_type == 'hockey' || $game_type == 'baseball' || $game_type == 'basketball' || $game_type == 'volleyball') ? true : false;
//check if game not ended
$newrat = 1;
$activecheck_query = tep_db_query("select * from `games` where game_status = 1 and game_time < '" . jdate('Y-m-d H:i:s') . "' and type = '" . $game_type . "' and `live` IS NULL  ");
if (tep_db_num_rows($activecheck_query) > 0 ) {
	while ($activecheck = tep_db_fetch_array($activecheck_query)) {
		tep_db_query("update `games` set game_status = 0, game_res = 'done' where game_id = " . $activecheck['game_id']);
		
		$checkform_query = tep_db_query("select form_id, form_res from `forms` where form_done = 0");
		while($checkform = tep_db_fetch_array($checkform_query)) {
			$game_info = explode ("=", $checkform['form_res']);
			
			for ($i = 0; $i <= 11; $i++) {
				$detail_info = explode ("-", $game_info[$i]);
				
				if ($detail_info[1] == $activecheck['game_id']) { } else {
					if($detail_info[1] > 0) {
						$endformres .= $detail_info[0] . '-' . $detail_info[1] . '-' . $detail_info[2] . '=' ;
						$newrat = round($detail_info[2] * $newrat, 2);
					}
				}
				
				unset($detail_info);
			}
			
			tep_db_query("update `forms` set form_res = '" . $endformres . "', form_rat = '" . $newrat . "' where form_id = " . $checkform['form_id']);
			unset($endformres);
			$newrat = 1;
		}
	}
}

?>


<div class="clear"></div>
<div class="box home" style="padding:0px; margin-top:5px;" >
<ul style="padding:0px; margin-top:0px;overflow: hidden;">
<li style="width:10%;"></li>
<li style="width:22%;"></li>
<li style="width:7%;height:33px;font-size:12px;">1</li>
<li style="width:7%;height:33px;font-size:12px;">X</li>
<li style="width:7%;height:33px;font-size:12px;">2</li>
<div class="desktop"  >
<li style="width:7%;height:33px;font-size:12px;">O</li>
<li style="width:5%;height:33px;font-size:12px;"></li>
<li style="width:7%;height:33px;font-size:12px;">U</li>
<li style="width:7%;height:33px;font-size:12px;">1X</li>
<li style="width:7%;height:33px;font-size:12px;">12</li>
<li style="width:7%;height:33px;font-size:12px;">2X</li>
</div>
 <li style="width:7%;"></li>

</ul>




<?php 
if (text_check('get', 'period') == 'back') {

$game = array();
$i = 0;
$showgame_q = tep_db_query("select * from `games` where `live` IS NULL and game_status='1' and type='" . $game_type . "' order by game_time ");

while ($showgame = tep_db_fetch_array($showgame_q)) {
	$i = $i + 1;
	$game['game_id'][$i] = $showgame['game_id'];
	$game['game_country'][$i] = $showgame['game_country'];
	$game['game_host'][$i] = $showgame['game_host'];
 	$game['game_guest'][$i] = $showgame['game_guest'];
 	$game['game_win'][$i] = $showgame['game_win'];
	$game['game_even'][$i] = $showgame['game_even'];
	$game['game_lose'][$i] = $showgame['game_lose'];
	$game['game_over'][$i] = $showgame['game_over'];
	$game['game_under'][$i] = $showgame['game_under'];
	$game['game_pair'][$i] = $showgame['game_pair'];
	$game['game_odd'][$i] = $showgame['game_odd'];

        $game['game_hover'][$i] = $showgame['game_hover'];
	$game['game_hunder'][$i] = $showgame['game_hunder'];
	$game['game_hpair'][$i] = $showgame['game_hpair'];
	$game['game_hodd'][$i] = $showgame['game_hodd'];

	$game['game_time'][$i] = $showgame['game_time'];
	$game['game_hwin'][$i] = $showgame['game_hwin'];
	$game['game_heven'][$i] = $showgame['game_heven'];
	$game['game_hlose'][$i] = $showgame['game_hlose'];
	$game['gamecounty'][$i] = $showgame['gamecounty'];

	$game['leage2'][$i] = $showgame['leage'];
	$game['game_tg1'][$i] = $showgame['game_tg1'];
	$game['game_tg2'][$i] = $showgame['game_tg2'];
	$game['game_tg3'][$i] = $showgame['game_tg3'];
	$game['game_tg4'][$i] = $showgame['game_tg4'];
	$game['game_tg5'][$i] = $showgame['game_tg5'];
	$game['game_tg6'][$i] = $showgame['game_tg6'];

	$game['type'][$i] = $showgame['type'];

	$game['game_2timgoly'][$i] = $showgame['game_2timgoly'];
	$game['game_2timgoln'][$i] = $showgame['game_2timgoln'];
	$game['game_moregolh1'][$i] = $showgame['game_moregolh1'];
	$game['game_moregolh2'][$i] = $showgame['game_moregolh2'];
	$game['game_moregoleqal'][$i] = $showgame['game_moregoleqal'];

	$game['game_duble1x'][$i] = $showgame['game_duble1x'];
	$game['game_duble2x'][$i] = $showgame['game_duble2x'];
	$game['game_duble12'][$i] = $showgame['game_duble12'];
	$game['game_link'][$i] = $showgame['game_link'];

$game['game_hfulh'][$i] = $showgame['game_hfulh'];
$game['game_hfulg'][$i] = $showgame['game_hfulg'];
$game['game_hfule'][$i] = $showgame['game_hfule'];
$game['game_hh1'][$i] = $showgame['game_hh1'];
$game['game_hh2'][$i] = $showgame['game_hh2'];
$game['game_gh1'][$i] = $showgame['game_gh1'];
$game['game_gh2'][$i] = $showgame['game_gh2'];
$game['game_hnoth'][$i] = $showgame['game_hnoth'];
$game['game_hone'][$i] = $showgame['game_hone'];
$game['game_htwo'][$i] = $showgame['game_htwo'];
$game['game_hthree'][$i] = $showgame['game_hthree'];
$game['game_gnoth'][$i] = $showgame['game_gnoth'];
$game['game_gone'][$i] = $showgame['game_gone'];
$game['game_gtwo'][$i] = $showgame['game_gtwo'];
$game['game_gthree'][$i] = $showgame['game_gthree'];
$game['game_winohost'][$i] = $showgame['game_winohost'];
$game['game_winoguest'][$i] = $showgame['game_winoguest'];
$game['game_winuhost'][$i] = $showgame['game_winuhost'];
$game['game_winuguest'][$i] = $showgame['game_winuguest'];
$game['game_over3'][$i] = $showgame['game_over3'];
$game['game_under3'][$i] = $showgame['game_under3'];
$game['game_h2win'][$i] = $showgame['game_h2win'];
$game['game_h2even'][$i] = $showgame['game_h2even'];
$game['game_h2lose'][$i] = $showgame['game_h2lose'];
$game['game_h2pair'][$i] = $showgame['game_h2pair'];
$game['game_h2odd'][$i] = $showgame['game_h2odd'];
	$game['game_hfhh1'][$i] = $showgame['game_hfhh1'];
	$game['game_hfxh2'][$i] = $showgame['game_hfxh2'];
	$game['game_hfhg3'][$i] = $showgame['game_hfhg3'];
	$game['game_hfhx4'][$i] = $showgame['game_hfhx4'];
	$game['game_hfxx5'][$i] = $showgame['game_hfxx5'];
	$game['game_hfgx6'][$i] = $showgame['game_hfgx6'];
	$game['game_hfgh7'][$i] = $showgame['game_hfgh7'];
	$game['game_hfxg8'][$i] = $showgame['game_hfxg8'];
	$game['game_hfgg9'][$i] = $showgame['game_hfgg9'];

}

$query3  = "SELECT * FROM games  where `live` IS NULL and game_status='1' and  type='" . $game_type . "' group by game_link  order by game_time ";
$result3 = mysql_query($query3) or die('مسابقه فعال ايجاد نشده است');
while ($row3=mysql_fetch_assoc($result3))
{ 
    
 
 
 $entryname2 = $row3['game_time'];
$entryname = str_replace("'"," ", $row3['game_link']);
	if (strlen($entryname) > 1) {
$countgame = tep_db_fetch_array(tep_db_query("select COUNT(game_id) from `games` where `live` IS NULL and game_link = '$entryname' and game_status='1' and type='" . $game_type . "' order by game_time "));
		if ($countgame['COUNT(game_id)'] > 0) {

$query101  = "SELECT * FROM games where game_link='$entryname' and game_status='1' and type='" . $game_type . "'  order by game_time ";
$result101 = mysql_query($query101) or die('عدم موفقيت دربرقراري ارتباط');
$row101=mysql_fetch_assoc($result101);
$gamecounty101=$row101['gamecounty'];


 
 if ((strpos($game['game_host'][$i], 'Special') !== false)  or
(strpos($game['game_link'][$i], 'Special') !== false)  or
 (strpos($game['game_link'][$i], 'Specials') !== false)  or
(strpos($game['game_link'][$i], '5x5') !== false))
{}else{  ?>
<table border="0" style="width:100%;background:#000000;color:#d6d6d6;border-bottom:1px solid #454545;" cellspacing="0" cellpadding="0">
		<tr>
<td height="30" width="10%"> <img src="images/country/<?php echo $gamecounty101; ?>.png" style="height:21px;width:25px;padding-right:5px;" /> </td>
<td height="30" width="90%" style="text-align:left;padding-left:5px;"><?php echo $entryname; ?></td></tr></table>

<?php   }
for ($i=1; $i <= 1000; $i++) {
	if (strlen($game['game_host'][$i]) > 2 and $game['game_link'][$i] == $entryname) {
		
		$show = true ;
		$showform = tep_db_fetch_array(tep_db_query("select * from `forms` where form_done = 0 and form_user = '" . (int)$_SESSION['user_id'] . "'"));
		$allgame = explode ("=", $showform['form_res']);
		for ($j = 0; $j <= 10; $j++) {
			$game_info = explode ("-", $allgame[$j]);
			if ($game_info[1] == $game['game_id'][$i]) $show = false;
		}
		
		if ($show == true) {
	
?>


<?  if ((strpos($game['game_host'][$i], 'Special') !== false)  or
(strpos($game['game_link'][$i], 'Special') !== false)  or
(strpos($game['game_link'][$i], '1x1') !== false)  or
(strpos($game['game_link'][$i], '2x2') !== false)  or
(strpos($game['game_link'][$i], '3x3') !== false)  or
(strpos($game['game_link'][$i], '4x4') !== false)  or
(strpos($game['game_link'][$i], '5x5') !== false)  or
(strpos($game['game_link'][$i], '6x6') !== false)  or
(strpos($game['game_link'][$i], '7x7') !== false)  or
(strpos($game['game_link'][$i], '1х1') !== false)  or
(strpos($game['game_link'][$i], '2х2') !== false)  or
(strpos($game['game_link'][$i], '3х3') !== false)  or
(strpos($game['game_link'][$i], '4х4') !== false)  or
(strpos($game['game_link'][$i], '5х5') !== false)  or
(strpos($game['game_link'][$i], '6х6') !== false)  or
(strpos($game['game_link'][$i], '7х7') !== false)  or
(strpos($game['game_host'][$i], ' team') !== false)  or
(strpos($game['game_host'][$i], ' Team') !== false)  or
(strpos($game['game_host'][$i], 'Home') !== false)  or
(strpos($game['game_guest'][$i], ' team') !== false)  or
(strpos($game['game_guest'][$i], ' Team') !== false)  or
 (strpos($game['game_link'][$i], 'Specials') !== false) )
{}else{  ?>

<ul style="padding:0px; margin-top:0px;overflow: hidden;" id="<?php echo 'gameline' . $game['game_id'][$i]; ?>">


<li2 style="width:10%;"><a style="height:35px;direction:ltr;font-size:10px;" href="option.php?homa=<?php echo $game['game_id'][$i]; ?>"><center><?php echo substr($game['game_time'][$i], 0, 16); ?></center></a></li2>

<li3 style="width:26%;"><a style="height:35px;text-align:left;font-size:10px;" href="option.php?homa=<?php echo $game['game_id'][$i]; ?>"><?php echo substr($game['game_host'][$i], 0, 24); ?><br />
<?php echo substr($game['game_guest'][$i], 0, 24); ?></a></li3>



<li style="width:7%;"><a id="move" style="height:35px;font-size:12px;text-align:center;" onClick="showformbox('win-<?php echo $game['game_id'][$i] . '-' . $game['game_win'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block;"><?php echo $game['game_win'][$i]; ?></span>
<div class="clear"></div>
</a></li>

<li style="width:7%;"><a style="height:35px;font-size:12px;text-align:center;" <?php if ($game['game_even'][$i] > 1) { ?> id="move" onClick="showformbox('even-<?php echo $game['game_id'][$i] . '-' . $game['game_even'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');" <?php } ?>><center><?php echo $game['game_even'][$i]; ?></center></a></li>

<li style="width:7%;"><a id="move" style="height:35px;font-size:12px;text-align:center;" onClick="showformbox('lose-<?php echo $game['game_id'][$i] . '-' . $game['game_lose'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_lose'][$i]; ?></span>
<div class="clear"></div>
</a></li>







<div class="desktop"  >

<?php if ($game['game_over'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('over-<?php echo $game['game_id'][$i] . '-' . $game['game_over'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_over'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>



 <li3 style="width:5%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="#">
<span style="display:block; ">2.5</span>
<div class="clear"></div>
</a></li3>

<?php if ($game['game_under'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('under-<?php echo $game['game_id'][$i] . '-' . $game['game_under'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_under'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>





<?php if ($game['game_duble1x'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('duble1x-<?php echo $game['game_id'][$i] . '-' . $game['game_duble1x'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_duble1x'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>

<?php if ($game['game_duble12'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('duble12-<?php echo $game['game_id'][$i] . '-' . $game['game_duble12'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_duble12'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>

<?php if ($game['game_duble2x'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('duble2x-<?php echo $game['game_id'][$i] . '-' . $game['game_duble2x'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_duble2x'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>

</div>
<!--
<li style="width:10%;"><a id="plus<?php echo $game['game_id'][$i]; ?>" onclick="showmorerate('<?php echo $game['game_id'][$i]; ?>')" style="height:35px;" ><center><?php /* echo rand(63,68); */ ?><img border="0" src="../images/more1.png" width="17" height="17"></center></a></li>
-->
 




 
</ul>

<?php } } } } } }}

}  else { ?>


<div class="clear"></div>

<?php //delete choose from form

if ((strlen(text_check('get', 'choose')) > 0) and (strlen(text_check('get', 'del')) > 0 )) {
	$delete = tep_db_fetch_array(tep_db_query("select * from `forms` where form_user = '" . number_check('get', 'user') . "' and form_done = 0"));
	
	if(preg_match('/=/i',$delete['form_res'])) {
		unset($delete_res);
		$delete_res_explode = explode ("=", $delete['form_res']);
		
		for ($i = 0; $i <= 20; $i++) {
			if (($delete_res_explode[$i] != text_check('get', 'choose')) and (strlen($delete_res_explode[$i])) > 0)
				$delete_res .= $delete_res_explode[$i] . "=";
		}
	
	} else unset($delete_res);
	
	$delete_rat_explode = explode ("-", text_check('get', 'choose'));
	$delete_rat = $delete['form_rat'] / $delete_rat_explode[2];
	
	tep_db_query("update `forms` set form_res = '" . $delete_res . "', form_rat = " . $delete_rat . " where form_user = '" . number_check('get', 'user') . "' and form_done = 0");
}
	
//show active games
$limityear = jdate("Y");
$limitmounth = jdate("m");
$limitday = jdate("d") + 7;

if ($limitday > 30) {
	$limitday = $limitday - 30;
	$limitmounth = $limitmounth + 1;
	if ($limitmounth > 12) {
		$limitmounth = 1;
		$limityear = $limityear + 1;
	}
}		

if (strlen($limitmounth) == 1) $limitmounth = "0" . $limitmounth;
if (strlen($limitday) == 1) $limitday = "0" . $limitday;

$limittime .= $limityear . "-";
$limittime .= $limitmounth . "-";
$limittime .= $limitday . " ";
$limittime .= jdate("H:i:s");

if ($_GET['period'] == 'all') {
	$game_query = tep_db_query("select * from `games` where game_status = 1 and game_time < '" . $limittime . "' and `live` IS NULL and type = ". $game_type." order by game_time");
	if (tep_db_num_rows ($game_query) > 0) {

?>

<div class="clear"></div>

<?php

while ( $game = tep_db_fetch_array($game_query) ) {
	
	$show = true ;

$showform_query = tep_db_query("select * from `forms` where form_done = 0 and form_user = '" . (int)$_SESSION['user_id'] . "'");
$showform = tep_db_fetch_array($showform_query);
	
	$allgame = explode ("=", $showform['form_res']);
	for ($i = 0; $i <= 10; $i++) {
		
		$game_info = explode ("-", $allgame[$i]);
		if ( $game_info[1] == $game['game_id'] ) {
			
			$show = false ;
			
		}
	}
	
if ( $show == true ) {
	
?>

<?  if ((strpos($game['game_host'][$i], 'Special') !== false)  or
(strpos($game['game_link'][$i], 'Special') !== false)  or
(strpos($game['game_link'][$i], '1x1') !== false)  or
(strpos($game['game_link'][$i], '2x2') !== false)  or
(strpos($game['game_link'][$i], '3x3') !== false)  or
(strpos($game['game_link'][$i], '4x4') !== false)  or
(strpos($game['game_link'][$i], '5x5') !== false)  or
(strpos($game['game_link'][$i], '6x6') !== false)  or
(strpos($game['game_link'][$i], '7x7') !== false)  or
(strpos($game['game_link'][$i], '1х1') !== false)  or
(strpos($game['game_link'][$i], '2х2') !== false)  or
(strpos($game['game_link'][$i], '3х3') !== false)  or
(strpos($game['game_link'][$i], '4х4') !== false)  or
(strpos($game['game_link'][$i], '5х5') !== false)  or
(strpos($game['game_link'][$i], '6х6') !== false)  or
(strpos($game['game_link'][$i], '7х7') !== false)  or
(strpos($game['game_host'][$i], ' team') !== false)  or
(strpos($game['game_host'][$i], ' Team') !== false)  or
(strpos($game['game_host'][$i], 'Home') !== false)  or
(strpos($game['game_guest'][$i], ' team') !== false)  or
(strpos($game['game_guest'][$i], ' Team') !== false)  or
 (strpos($game['game_link'][$i], 'Specials') !== false) )
{}else{  ?>

<ul style="padding:0px; margin-top:0px;overflow: hidden;" id="<?php echo 'gameline' . $game['game_id'][$i]; ?>">


<li2 style="width:10%;"><a style="height:35px;direction:ltr;font-size:10px;" href="option.php?homa=<?php echo $game['game_id']; ?>"><center><?php echo substr($game['game_time'], 0, 16); ?></center></a></li2>

<li3 style="width:26%;"><a style="height:35px;text-align:left;font-size:10px;" href="option.php?homa=<?php echo $game['game_id']; ?>"><?php echo substr($game['game_host'], 0, 24); ?><br />
<?php echo substr($game['game_guest'], 0, 24); ?></a></li3>



<li style="width:7%;"><a id="move" style="height:35px;font-size:12px;text-align:center;" onClick="showformbox('win-<?php echo $game['game_id'] . '-' . $game['game_win']; ?>', '<?php echo $game['type']; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id']; ?>');">
<span style="display:block;"><?php echo $game['game_win']; ?></span>
<div class="clear"></div>
</a></li>

<li style="width:7%;"><a style="height:35px;font-size:12px;text-align:center;" <?php if ($game['game_even'] > 1) { ?> id="move" onClick="showformbox('even-<?php echo $game['game_id'] . '-' . $game['game_even']; ?>', '<?php echo $game['type']; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id']; ?>');" <?php } ?>><center><?php echo $game['game_even']; ?></center></a></li>

<li style="width:7%;"><a id="move" style="height:35px;font-size:12px;text-align:center;" onClick="showformbox('lose-<?php echo $game['game_id'] . '-' . $game['game_lose']; ?>', '<?php echo $game['type']; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id']; ?>');">
<span style="display:block; "><?php echo $game['game_lose']; ?></span>
<div class="clear"></div>
</a></li>







<div class="desktop"  >

<?php if ($game['game_over'] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('over-<?php echo $game['game_id'] . '-' . $game['game_over']; ?>', '<?php echo $game['type']; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id']; ?>');">
<span style="display:block; "><?php echo $game['game_over']; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>


 <li3 style="width:5%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="#">
<span style="display:block; ">2.5</span>
<div class="clear"></div>
</a></li3>

<?php if ($game['game_under'] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('under-<?php echo $game['game_id'] . '-' . $game['game_under']; ?>', '<?php echo $game['type']; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id']; ?>');">
<span style="display:block; "><?php echo $game['game_under']; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>



<?php if ($game['game_duble1x'] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('duble1x-<?php echo $game['game_id'] . '-' . $game['game_duble1x']; ?>', '<?php echo $game['type']; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id']; ?>');">
<span style="display:block; "><?php echo $game['game_duble1x']; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>

<?php if ($game['game_duble12'] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('duble12-<?php echo $game['game_id'] . '-' . $game['game_duble12']; ?>', '<?php echo $game['type']; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id']; ?>');">
<span style="display:block; "><?php echo $game['game_duble12']; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>

<?php if ($game['game_duble2x'] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('duble2x-<?php echo $game['game_id'] . '-' . $game['game_duble2x']; ?>', '<?php echo $game['type']; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id']; ?>');">
<span style="display:block; "><?php echo $game['game_duble2x']; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>

</div>
<!--
<li style="width:10%;"><a id="plus<?php echo $game['game_id']; ?>" onclick="showmorerate('<?php echo $game['game_id']; ?>')" style="height:35px;" ><center><?php /* echo rand(63,68); */ ?><img border="0" src="../images/more1.png" width="17" height="17"></center></a></li>
-->
 




 
</ul>








<?php }

} } } } else {
	
$game = array();
$i = 0;
$showgame_q = tep_db_query("select * from `games` where `live` IS NULL and game_status='1' and type='" . $game_type . "' order by game_time ");

while ($showgame = tep_db_fetch_array($showgame_q)) {
	$i = $i + 1;
	$game['game_id'][$i] = $showgame['game_id'];
	$game['game_country'][$i] = $showgame['game_country'];
	$game['game_host'][$i] = $showgame['game_host'];
 	$game['game_guest'][$i] = $showgame['game_guest'];
 	$game['game_win'][$i] = $showgame['game_win'];
	$game['game_even'][$i] = $showgame['game_even'];
	$game['game_lose'][$i] = $showgame['game_lose'];
	$game['game_over'][$i] = $showgame['game_over'];
	$game['game_under'][$i] = $showgame['game_under'];
	$game['game_pair'][$i] = $showgame['game_pair'];
	$game['game_odd'][$i] = $showgame['game_odd'];

        $game['game_hover'][$i] = $showgame['game_hover'];
	$game['game_hunder'][$i] = $showgame['game_hunder'];
	$game['game_hpair'][$i] = $showgame['game_hpair'];
	$game['game_hodd'][$i] = $showgame['game_hodd'];

	$game['game_time'][$i] = $showgame['game_time'];
	$game['game_hwin'][$i] = $showgame['game_hwin'];
	$game['game_heven'][$i] = $showgame['game_heven'];
	$game['game_hlose'][$i] = $showgame['game_hlose'];
	$game['gamecounty'][$i] = $showgame['gamecounty'];

	$game['leage2'][$i] = $showgame['leage'];
	$game['game_tg1'][$i] = $showgame['game_tg1'];
	$game['game_tg2'][$i] = $showgame['game_tg2'];
	$game['game_tg3'][$i] = $showgame['game_tg3'];
	$game['game_tg4'][$i] = $showgame['game_tg4'];
	$game['game_tg5'][$i] = $showgame['game_tg5'];
	$game['game_tg6'][$i] = $showgame['game_tg6'];

	$game['type'][$i] = $showgame['type'];

	$game['game_2timgoly'][$i] = $showgame['game_2timgoly'];
	$game['game_2timgoln'][$i] = $showgame['game_2timgoln'];
	$game['game_moregolh1'][$i] = $showgame['game_moregolh1'];
	$game['game_moregolh2'][$i] = $showgame['game_moregolh2'];
	$game['game_moregoleqal'][$i] = $showgame['game_moregoleqal'];

	$game['game_duble1x'][$i] = $showgame['game_duble1x'];
	$game['game_duble2x'][$i] = $showgame['game_duble2x'];
	$game['game_duble12'][$i] = $showgame['game_duble12'];
	$game['game_link'][$i] = $showgame['game_link'];

$game['game_hfulh'][$i] = $showgame['game_hfulh'];
$game['game_hfulg'][$i] = $showgame['game_hfulg'];
$game['game_hfule'][$i] = $showgame['game_hfule'];
$game['game_hh1'][$i] = $showgame['game_hh1'];
$game['game_hh2'][$i] = $showgame['game_hh2'];
$game['game_gh1'][$i] = $showgame['game_gh1'];
$game['game_gh2'][$i] = $showgame['game_gh2'];
$game['game_hnoth'][$i] = $showgame['game_hnoth'];
$game['game_hone'][$i] = $showgame['game_hone'];
$game['game_htwo'][$i] = $showgame['game_htwo'];
$game['game_hthree'][$i] = $showgame['game_hthree'];
$game['game_gnoth'][$i] = $showgame['game_gnoth'];
$game['game_gone'][$i] = $showgame['game_gone'];
$game['game_gtwo'][$i] = $showgame['game_gtwo'];
$game['game_gthree'][$i] = $showgame['game_gthree'];
$game['game_winohost'][$i] = $showgame['game_winohost'];
$game['game_winoguest'][$i] = $showgame['game_winoguest'];
$game['game_winuhost'][$i] = $showgame['game_winuhost'];
$game['game_winuguest'][$i] = $showgame['game_winuguest'];
$game['game_over3'][$i] = $showgame['game_over3'];
$game['game_under3'][$i] = $showgame['game_under3'];
$game['game_h2win'][$i] = $showgame['game_h2win'];
$game['game_h2even'][$i] = $showgame['game_h2even'];
$game['game_h2lose'][$i] = $showgame['game_h2lose'];
$game['game_h2pair'][$i] = $showgame['game_h2pair'];
$game['game_h2odd'][$i] = $showgame['game_h2odd'];
	$game['game_hfhh1'][$i] = $showgame['game_hfhh1'];
	$game['game_hfxh2'][$i] = $showgame['game_hfxh2'];
	$game['game_hfhg3'][$i] = $showgame['game_hfhg3'];
	$game['game_hfhx4'][$i] = $showgame['game_hfhx4'];
	$game['game_hfxx5'][$i] = $showgame['game_hfxx5'];
	$game['game_hfgx6'][$i] = $showgame['game_hfgx6'];
	$game['game_hfgh7'][$i] = $showgame['game_hfgh7'];
	$game['game_hfxg8'][$i] = $showgame['game_hfxg8'];
	$game['game_hfgg9'][$i] = $showgame['game_hfgg9'];

}


$query3  = "SELECT * FROM games  where `live` IS NULL and game_status='1' and  type='" . $game_type . "' group by game_link  order by game_time ";
$result3 = mysql_query($query3) or die('مسابقه فعال ايجاد نشده است');
while ($row3=mysql_fetch_assoc($result3))
{ 

 
 $entryname2 = $row3['game_time'];
$entryname = str_replace("'"," ", $row3['game_link']);
	if (strlen($entryname) > 1) {
$countgame = tep_db_fetch_array(tep_db_query("select COUNT(game_id) from `games` where `live` IS NULL and game_link = '$entryname' and game_status='1' and type='" . $game_type . "' order by game_time "));
		if ($countgame['COUNT(game_id)'] > 0) {

$query101  = "SELECT * FROM games where game_link='$entryname' and game_status='1' and type='" . $game_type . "'  order by game_time ";
$result101 = mysql_query($query101) or die('عدم موفقيت دربرقراري ارتباط');
$row101=mysql_fetch_assoc($result101);
$gamecounty101=$row101['gamecounty'];


 
 if ((strpos($game['game_host'][$i], 'Special') !== false)  or
(strpos($game['game_link'][$i], 'Special') !== false)  or
 (strpos($game['game_link'][$i], 'Specials') !== false)  or
(strpos($game['game_link'][$i], '5x5') !== false))
{}else{  ?>
<table border="0" style="width:100%;background:#000000;color:#d6d6d6;border-bottom:1px solid #454545;" cellspacing="0" cellpadding="0">
		<tr>
<td height="30" width="10%"> <img src="images/country/<?php echo $gamecounty101; ?>.png" style="height:21px;width:25px;padding-right:5px;" /> </td>
<td height="30" width="90%" style="text-align:left;padding-left:5px;"><?php echo $entryname; ?></td></tr></table>

<?php   }
for ($i=1; $i <= 1000; $i++) {
	if (strlen($game['game_host'][$i]) > 2 and $game['game_link'][$i] == $entryname) {
		
		$show = true ;
		$showform = tep_db_fetch_array(tep_db_query("select * from `forms` where form_done = 0 and form_user = '" . (int)$_SESSION['user_id'] . "'"));
		$allgame = explode ("=", $showform['form_res']);
		for ($j = 0; $j <= 10; $j++) {
			$game_info = explode ("-", $allgame[$j]);
			if ($game_info[1] == $game['game_id'][$i]) $show = false;
		}
		
		if ($show == true) {
	
?>
 

<?  if ((strpos($game['game_host'][$i], 'Special') !== false)  or
(strpos($game['game_link'][$i], 'Special') !== false)  or
(strpos($game['game_link'][$i], '1x1') !== false)  or
(strpos($game['game_link'][$i], '2x2') !== false)  or
(strpos($game['game_link'][$i], '3x3') !== false)  or
(strpos($game['game_link'][$i], '4x4') !== false)  or
(strpos($game['game_link'][$i], '5x5') !== false)  or
(strpos($game['game_link'][$i], '6x6') !== false)  or
(strpos($game['game_link'][$i], '7x7') !== false)  or
(strpos($game['game_link'][$i], '1х1') !== false)  or
(strpos($game['game_link'][$i], '2х2') !== false)  or
(strpos($game['game_link'][$i], '3х3') !== false)  or
(strpos($game['game_link'][$i], '4х4') !== false)  or
(strpos($game['game_link'][$i], '5х5') !== false)  or
(strpos($game['game_link'][$i], '6х6') !== false)  or
(strpos($game['game_link'][$i], '7х7') !== false)  or
(strpos($game['game_host'][$i], ' team') !== false)  or
(strpos($game['game_host'][$i], ' Team') !== false)  or
(strpos($game['game_host'][$i], 'Home') !== false)  or
(strpos($game['game_guest'][$i], ' team') !== false)  or
(strpos($game['game_guest'][$i], ' Team') !== false)  or
 (strpos($game['game_link'][$i], 'Specials') !== false) )
{}else{  ?>

<ul style="padding:0px; margin-top:0px;overflow: hidden;" id="<?php echo 'gameline' . $game['game_id'][$i]; ?>">


<li2 style="width:10%;"><a style="height:35px;direction:ltr;font-size:10px;" href="option.php?homa=<?php echo $game['game_id'][$i]; ?>"><center><?php echo substr($game['game_time'][$i], 0, 16); ?></center></a></li2>

<li3 style="width:26%;"><a style="height:35px;text-align:left;font-size:10px;" href="option.php?homa=<?php echo $game['game_id'][$i]; ?>"><?php echo substr($game['game_host'][$i], 0, 24); ?><br />
<?php echo substr($game['game_guest'][$i], 0, 24); ?></a></li3>



<li style="width:7%;"><a id="move" style="height:35px;font-size:12px;text-align:center;" onClick="showformbox('win-<?php echo $game['game_id'][$i] . '-' . $game['game_win'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block;"><?php echo $game['game_win'][$i]; ?></span>
<div class="clear"></div>
</a></li>

<li style="width:7%;"><a style="height:35px;font-size:12px;text-align:center;" <?php if ($game['game_even'][$i] > 1) { ?> id="move" onClick="showformbox('even-<?php echo $game['game_id'][$i] . '-' . $game['game_even'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');" <?php } ?>><center><?php echo $game['game_even'][$i]; ?></center></a></li>

<li style="width:7%;"><a id="move" style="height:35px;font-size:12px;text-align:center;" onClick="showformbox('lose-<?php echo $game['game_id'][$i] . '-' . $game['game_lose'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_lose'][$i]; ?></span>
<div class="clear"></div>
</a></li>







<div class="desktop"  >

<?php if ($game['game_over'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('over-<?php echo $game['game_id'][$i] . '-' . $game['game_over'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_over'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>


 <li3 style="width:5%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="#">
<span style="display:block; ">2.5</span>
<div class="clear"></div>
</a></li3>

<?php if ($game['game_under'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('under-<?php echo $game['game_id'][$i] . '-' . $game['game_under'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_under'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:35px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>




<?php if ($game['game_duble1x'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('duble1x-<?php echo $game['game_id'][$i] . '-' . $game['game_duble1x'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_duble1x'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>

<?php if ($game['game_duble12'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('duble12-<?php echo $game['game_id'][$i] . '-' . $game['game_duble12'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_duble12'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>

<?php if ($game['game_duble2x'][$i] > 1) { ?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;font-size:12px;text-align:center;" onClick="showformbox('duble2x-<?php echo $game['game_id'][$i] . '-' . $game['game_duble2x'][$i]; ?>', '<?php echo $game['type'][$i]; ?>', '0', '<?php echo (int)$_SESSION['user_id']; ?>', '<?php echo 'gameline' . $game['game_id'][$i]; ?>');">
<span style="display:block; "><?php echo $game['game_duble2x'][$i]; ?></span>
<div class="clear"></div>
</a></li>
<?}else{?>
<li style="width:7%;"><a id="move" style="height:33px;padding:3px 3px 0 3px;" >
<div class="clear"></div>
</a></li><?}?>

</div>
<!--
<li style="width:10%;"><a id="plus<?php echo $game['game_id'][$i]; ?>" onclick="showmorerate('<?php echo $game['game_id'][$i]; ?>')" style="height:35px;" ><center><?php /* echo rand(63,68); */ ?><img border="0" src="../images/more1.png" width="17" height="17"></center></a></li>
-->

 



 
</ul>
<?php } } } } } } }}

?>

</div><?php } ?>

<!--show active form --></div>

</body></html>

<?php tep_session_close(); tep_db_close(); ?>