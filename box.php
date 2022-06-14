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

</head>
<body>
<style>input{color:#000000;}</style>

<div class="form">
<div id="loadingbox" class="loading"></div>

<?php
//if user cheat
//if (!preg_match('/win/i',$_SERVER['HTTP_REFERER'])) exit;
if (HAHAA != 'wearegood') exit;

//check if game not ended
$newrat = 1;
$activecheck_query = tep_db_query("select * from `games` where game_status = 1 and game_time < '" . jdate('Y-m-d H:i:s') . "' and `live` IS NULL ");
if (tep_db_num_rows($activecheck_query) > 0 ) {
	while ($activecheck = tep_db_fetch_array($activecheck_query)) {
		tep_db_query("update `games` set game_status = 0, game_res = 'done' where game_id = '" . $activecheck['game_id'] . "'");
		
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

//add formline to database
if ($_SESSION['user_id'] > 0) {
	$checkform = tep_db_fetch_array(tep_db_query("select form_id, form_res, form_rat from `forms` where form_done = 0 and form_user = '" . $_SESSION['user_id'] . "'"));
	
	if ($checkform['form_id'] > 0) {
		if(preg_match('/=/i',$checkform['form_res'])) {
			$formconter_check = explode ("=", $checkform['form_res']);
			$formconter = 0 ;
			for ($i = 0; $i <= 20; $i++) if (strlen($formconter_check[$i]) > 0) $formconter = $formconter + 1 ;
		
		} else {
			$formconter_check = explode ("-", $checkform['form_res']);
			$formconter = 0;
			if ($formconter_check[1] > 0) $formconter = $formconter + 1;
		}
		
		if (strlen(text_check('get', 'choose')) > 2 and strlen($checkform['form_res']) > 2) $formconter = $formconter + 1;
		
		if ($formconter < 11) {
			if (!preg_match('/' . text_check('get', 'choose') . '/i', $checkform['form_res'])) {
				unset($newformres);
				$form_rat = explode("-", text_check('get', 'choose'));
				$checkgame = tep_db_fetch_array(tep_db_query("select game_id, game_" . $form_rat[0] . " from `games` where game_id = '" . $form_rat[1] . "'"));
				$gamerate = $checkgame["game_$form_rat[0]"];
				if ($gamerate > 0 and $checkgame['game_id'] > 0) {
					$corrent_choose = $form_rat[0] . '-' . $checkgame['game_id'] . '-' . $gamerate;
					$newformres .= $checkform['form_res'];
					$newformres .= '=';
					$newformres .= $corrent_choose;
					if ($checkform['form_rat'] > 0 and $gamerate > 0) $newformrat = $gamerate * $checkform['form_rat'];
					elseif ($checkform['form_rat'] > 0 and $gamerate < 1) $newformrat = $checkform['form_rat'];
					elseif ($checkform['form_rat'] < 1 and $gamerate > 0) $newformrat = $gamerate;
					//check form rat






$game_info = explode ("=", $checkform['form_res']);
			for ($i = 0; $i <= 8; $i++) {
			$detail_info = explode ("-", $game_info[$i]);
$endformres11 .= $detail_info[0] . '-' . $detail_info[1] . '-' . $detail_info[2] . '=' ;
			$oldgameid=$detail_info[1];		



if ($checkgame['game_id'] == $detail_info[1]) { echo '<div class="error"> لطفا از یک  بازی فقط یک ضریب را انتخاب نمایید. </div>';
$userid1=$_SESSION['user_id'];
 $sql = "DELETE FROM forms WHERE form_id='$checkform[form_id]' "; 
         mysql_query($sql)  or die(mysql_error());

}}



if ($newformrat > 100) echo '<div class="error"> ضریب فرم نمی تواند از 99 بزرگتر باشد. </div>';


else tep_db_query("update `forms` set form_res = '" . $newformres . "', form_rat = '" . round($newformrat, 2) . "' where form_id = " . $checkform['form_id']);
}	

				}				
			
		

		} else echo '<div class="error"> حداکثر می توانید 10 بازی را در یک فرم انتخاب نمایید </div>';
		
	} else {
		$form_rat = explode("-", text_check('get', 'choose'));
		
		tep_db_query("insert into `forms` ( form_id, form_user, form_period, form_res, form_bet, form_rat, form_done, form_check ) values ('" . (int)$form_id . "', '" . $_SESSION['user_id'] . "', '0', '" . text_check('get', 'choose') . "', '0', '" . round($form_rat[2], 2) . "', '0', '0')");
		


	}
}
$game_type = (isset($_REQUEST['type']) ? $_REQUEST['type'] : 'Football');
$game_type = trim($game_type);
//if ok update database or show some error
$formdone = false;

if ($formconter < 1 and number_check('get', 'bet') > 1) {
	echo '<div class="error"> حداقل باید 1 بازی را در یک فرم انتخاب نمایید. </div>';
	$_REQUEST['final'] = 'notok';
	
} elseif ($formconter == 12 and number_check('get', 'bet') > 1) {
	echo '<div class="error"> فرم ترکیبی مجاز نیست. لطفا یک، سه و یا بیشتر از سه بازی در فرم انتخاب کنید </div>';
	$_REQUEST['final'] = 'notok';
	
} elseif ($formconter == 1 and number_check('get', 'bet') > FORM_SINGLE_MAX_BET) {
	echo '<div class="error"> مبلغ  برای فرم های تک بازی نمی تواند بیشتر از ' . FORM_SINGLE_MAX_BET . ' تومان باشد. </div>';
	$_REQUEST['final'] = 'notok';
	
} elseif (number_check('get', 'bet') < FORM_MIN_BET and number_check('get', 'bet') > 1) {
	echo '<div class="error"> مبلغ  نمی تواند کمتر از ' . FORM_MIN_BET . ' تومان باشد. </div>';
	$_REQUEST['final'] = 'notok';
	
} elseif ($formconter > 1 and number_check('get', 'bet') > FORM_MAX_BET) {
	echo '<div class="error"> مبلغ نمی تواند بزرگتر از ' . FORM_MAX_BET . ' تومان باشد. </div>';
	$_REQUEST['final'] = 'notok';

} elseif (number_check('get', 'bet') > 999) {
	$checkuser = tep_db_fetch_array(tep_db_query("select user_id, user_point from `users1` where user_id = '" . $_SESSION['user_id'] . "'"));
	$checkuser2 = tep_db_fetch_array(tep_db_query("select id, cash from `users` where id = '" . $_SESSION['user_id'] . "'"));

	
	if ( number_check('get', 'bet') > $checkuser2['cash'] or $checkuser2['cash'] < 0 or ($checkuser2['cash'] - number_check('get', 'bet')) < 0) {
		echo '<div class="error"> موجودی حساب شما کمتر از مبلغ شرط بندی است. </div>';
		$_REQUEST['final'] = 'notok';
		
	} else $formdone = true;
}

if (text_check('get', 'final') == 'ok') {
	$checkform = tep_db_fetch_array(tep_db_query("select form_id, form_bet, form_res from `forms` where form_done = 0 and form_user = '" . $_SESSION['user_id'] . "'"));
	//
	if ($checkform['form_id'] > 0) {
		if(preg_match('/=/i',$checkform['form_res'])) {
			$formconter_check = explode ("=", $checkform['form_res']);
			$formconter = 0 ;
			for ($i = 0; $i <= 20; $i++) if (strlen($formconter_check[$i]) > 0) $formconter = $formconter + 1;
		} else {
			$formconter_check = explode ("-", $checkform['form_res']);
			$formconter = 0;
			if ($formconter_check[1] > 0) $formconter = $formconter + 1;
		}
	}
	//
	if ($formconter < 1 and number_check('get', 'bet') > 1) {
		$formdone = false;
		$_REQUEST['final'] = 'notok';
		
	} else {


$aser=$_SERVER['HTTP_HOST'];


		tep_db_query("update `forms` set form_bet = " . number_check('get', 'bet') . ", form_done = 1, form_date = '" . jdate("Y-m-d H:i:s") . "',`adress`='$aser' where form_user = " . $_SESSION['user_id'] . " and form_done = 0") ;
		$newuserpoint = $checkuser2['cash'] - number_check('get', 'bet');
		tep_db_query("update `users` set cash = " . $newuserpoint . " where id = " . $_SESSION['user_id']);
		
		
		
			$datae1=date('Y/m/d');
tep_db_query("insert into `settles` (settle_res, settle_ref, settle_amount, settle_user, settle_date, settle_status, settle_done, settle_gateway) values ('***', '" . generateresnum () . "', '" . number_check('get', 'bet') . "', '" . $_SESSION['user_id'] . "', '" . date("Y-m-d H:i:s") . "', 'ثبت فرم', '1', '$datae1')");
		
		
		
		
		
		
		echo '<div class="success">فرم با موفقیت ثبت شد. برای مشاهده فرم های خود لطفا روی گزینه "نمایش فرم ها" کلیک کنید.</div>';
	}
}

//show formlines
$showform_query = tep_db_query("select form_id, form_res, form_rat, form_bet from `forms` where form_done = 0 and form_user = " . $_SESSION['user_id']);
	
if (tep_db_num_rows($showform_query)) {
	$showform = tep_db_fetch_array($showform_query);


	if(preg_match('/=/i',$showform['form_res'])) {

/*
echo'<table border="0" width="98%">
		<tr>
<td width="100%" style="height:25px;background-color:#FFF7D9;color:#000000;"><center><b>میـکـس</center></b></td>
		</tr>
	</table>';	
*/
		$allgame = explode ("=", $showform['form_res']);
		for ($i = 0; $i <= 10; $i++) {
			$game_info = explode ("-", $allgame[$i]);
			if ( $game_info[1] > 0 ) {
				$showgame = tep_db_fetch_array(tep_db_query("select game_id, live, gamecounty, game_host, game_guest, game_time, game_status from `games` where game_id = '" . $game_info[1] . "'"));
				
				$inmoment = jdate("YmdHis");
				$ourtime = str_replace(" ", "", $showgame['game_time']);
				$ourtime = str_replace("-", "", $ourtime);
				$ourtime = str_replace(":", "", $ourtime);

 if ($showgame['live']=='1' and $showgame['game_status'] == 1){ 
?>


<ul id="<?php echo "formline" . $showgame['game_id']; ?>" style="border-bottom:1px solid #454545;padding:3px 0 3px 0;">
<li style="padding:2px; padding-bottom:0; cursor:pointer;">
<img src="images/button_delete.png" width="15" onClick="showhomebox('<?php echo $allgame[$i]; ?>', '<?php echo $game_type; ?>' ,'<?php echo $showgame['gamecounty']; ?>', '<?php echo $_SESSION['user_id']; ?>', '<?php echo "formline" . $showgame['game_id']; ?>');">
</li>
<li style=color:#248433><?php echo $showgame['game_host'] . ' - ' . $showgame['game_guest'] ; ?></li>
<li><?php echo " <b style=color:#ff4200>($game_info[2])</b> "; 
if ($game_info[0]=='win'){ echo "برد"; echo $showgame['game_host'];}
if ($game_info[0]=='even'){ echo'تساوي';}
if ($game_info[0]=='lose'){ echo "برد"; echo $showgame['game_guest'];}

if ($game_info[0]=='over05'){ echo"آور 0.5";}
if ($game_info[0]=='under05'){ echo"آندر 0.5";}

if ($game_info[0]=='over15'){ echo"آور 1.5";}
if ($game_info[0]=='under15'){ echo"آندر 1.5";}

if ($game_info[0]=='over'){ echo"آور 2.5";}
if ($game_info[0]=='under'){ echo"آندر 2.5";}

if ($game_info[0]=='over35'){ echo"آور 3.5";}
if ($game_info[0]=='under35'){ echo"آندر 3.5";}

if ($game_info[0]=='over45'){ echo"آور 4.5";}
if ($game_info[0]=='under45'){ echo"آندر 4.5";}

if ($game_info[0]=='pair'){ echo"گلها زوج";}
if ($game_info[0]=='odd'){ echo"گلها فرد";}

if ($game_info[0]=='duble1x'){ echo"برد $showgame[game_host] یا تساوی";}
if ($game_info[0]=='duble2x'){ echo"برد $showgame[game_guest] یا تساوی";}
if ($game_info[0]=='duble12'){ echo"برد میزبان یا میهمان";}

if ($game_info[0]=='2timgoly'){ echo"هردوتيم به گل میرسند";}
if ($game_info[0]=='2timgoln'){ echo"هردوتيم به گل نمیرسند";}
if ($game_info[0]=='2timgolyn'){ echo"یک یا دوتیم به گل میرسند";}

if ($game_info[0]=='score10'){ echo"نتیجه دقیق 0-1";}
if ($game_info[0]=='score20'){ echo"نتیجه دقیق 0-2";}
if ($game_info[0]=='score21'){ echo"نتیجه دقیق 1-2";}
if ($game_info[0]=='score30'){ echo"نتیجه دقیق 0-3";}
if ($game_info[0]=='score31'){ echo"نتیجه دقیق 1-3";}
if ($game_info[0]=='score32'){ echo"نتیجه دقیق 2-3";}
if ($game_info[0]=='score00'){ echo"نتیجه دقیق 0-0";}
if ($game_info[0]=='score11'){ echo"نتیجه دقیق 1-1";}
if ($game_info[0]=='score22'){ echo"نتیجه دقیق 2-2";}
if ($game_info[0]=='score33'){ echo"نتیجه دقیق 3-3";}
if ($game_info[0]=='score01'){ echo"نتیجه دقیق 1-0";}
if ($game_info[0]=='score02'){ echo"نتیجه دقیق 2-0";}
if ($game_info[0]=='score12'){ echo"نتیجه دقیق 2-1";}
if ($game_info[0]=='score03'){ echo"نتیجه دقیق 3-0";}
if ($game_info[0]=='score13'){ echo"نتیجه دقیق 3-1";}
if ($game_info[0]=='score23'){ echo"نتیجه دقیق 3-2";}


if ($game_info[0]=='total1over15'){ echo"گلهای میزبان آور 1.5";}
if ($game_info[0]=='total1under15'){ echo"گلهای میزبان آندر 1.5";}
if ($game_info[0]=='total1over25'){ echo"گلهای میزبان آور 2.5";}
if ($game_info[0]=='total1under25'){ echo"گلهای میزبان آندر 2.5";}
if ($game_info[0]=='total1over35'){ echo"گلهای میزبان آور 3.5";}
if ($game_info[0]=='total1under35'){ echo"گلهای میزبان آندر 3.5";}

if ($game_info[0]=='total2over15'){ echo"گلهای میهمان آور 1.5";}
if ($game_info[0]=='total2under15'){ echo"گلهای میهمان آندر 1.5";}
if ($game_info[0]=='total2over25'){ echo"گلهای میهمان آور 2.5";}
if ($game_info[0]=='total2under25'){ echo"گلهای میهمان آندر 2.5";}
if ($game_info[0]=='total2over35'){ echo"گلهای میهمان آور 3.5";}
if ($game_info[0]=='total2under35'){ echo"گلهای میهمان آندر 3.5";}


if ($game_info[0]=='hfhh1'){ echo"$showgame[game_host]/$showgame[game_host]";}
if ($game_info[0]=='hfxh2'){ echo"تساوي نیمه اول/$showgame[game_host]";}
if ($game_info[0]=='hfhg3'){ echo"$showgame[game_host]/$showgame[game_guest]";}
if ($game_info[0]=='hfhx4'){ echo"$showgame[game_host]/تساوي كل بازي";}
if ($game_info[0]=='hfxx5'){ echo"تساوي نيمه اول/تساوي كل بازي";}
if ($game_info[0]=='hfgx6'){ echo"$showgame[game_guest]/تساوي كل بازي";}
if ($game_info[0]=='hfgh7'){ echo"$showgame[game_guest]/$showgame[game_host]";}
if ($game_info[0]=='hfxg8'){ echo"تساوي نیمه اول/$showgame[game_guest]";}
if ($game_info[0]=='hfgg9'){ echo"$showgame[game_guest]/$showgame[game_guest]";}


if ($game_info[0]=='moregolh1'){ echo"بیشترین گلها نیمه اول";}
if ($game_info[0]=='moregolh2'){ echo"بیشترین گلها نیمه دوم";}
if ($game_info[0]=='moregoleqal'){ echo"گلهای نیمه اول و دوم برابر";}

if ($game_info[0]=='handimosbat15'){ echo"هندیکپ -1.5 $showgame[game_host]";}
if ($game_info[0]=='handimosbat25'){ echo"هندیکپ -2.5 $showgame[game_host]";}
if ($game_info[0]=='handimosbat35'){ echo"هندیکپ -3.5 $showgame[game_host]";}
if ($game_info[0]=='handimanfi15'){ echo"هندیکپ +1.5 $showgame[game_guest]";}
if ($game_info[0]=='handimanfi25'){ echo"هندیکپ +2.5 $showgame[game_guest]";}
if ($game_info[0]=='handimanfi35'){ echo"هندیکپ +3.5 $showgame[game_guest]";}








if ($game_info[0]=='hwin'){ echo"برد نیمه اول $showgame[game_host]";}
if ($game_info[0]=='heven'){ echo"تساوي نیمه اول";}
if ($game_info[0]=='hlose'){ echo"برد نیمه اول $showgame[game_guest]";}

 
if ($game_info[0]=='tg1'){ echo"کلا 1 گل";}
if ($game_info[0]=='tg2'){ echo"کلا 2 گل";}
if ($game_info[0]=='tg3'){ echo"کلا 3 گل";}
if ($game_info[0]=='tg4'){ echo"کلا 4 گل";}
  

if ($game_info[0]=='hfulh'){ echo"$showgame[game_host] برنده هردونیمه";}
if ($game_info[0]=='hfulg'){ echo"$showgame[game_guest] برنده هردونیمه";}
if ($game_info[0]=='hfule'){ echo"هردونیمه بدون برنده";}

if ($game_info[0]=='winohost'){ echo"$showgame[game_host] برنده و آور2.5";}
if ($game_info[0]=='winoguest'){ echo"$showgame[game_guest] برنده و آور2.5";}
if ($game_info[0]=='winuhost'){ echo"$showgame[game_host] برنده و آندر2.5";}
if ($game_info[0]=='winuguest'){ echo"$showgame[game_guest] برنده و آندر2.5";}

if ($game_info[0]=='hh1'){ echo"درنیمه اول $showgame[game_host] گل بیشتر";}
if ($game_info[0]=='hh2'){ echo"درنیمه دوم $showgame[game_host] گل بیشتر";}
if ($game_info[0]=='gh1'){ echo"در نیمه اول $showgame[game_guest] گل بیشتر";}
if ($game_info[0]=='gh2'){ echo"درنیمه دوم $showgame[game_guest] گل بیشتر";}


if ($game_info[0]=='hnoth'){ echo"$showgame[game_host] گل نميزند";}
if ($game_info[0]=='hone'){ echo"$showgame[game_host] یک گل ميزند";}
if ($game_info[0]=='htwo'){ echo"$showgame[game_host] دو گل ميزند";}
if ($game_info[0]=='hthree'){ echo"$showgame[game_host] سه گل وبیشترميزند";}
if ($game_info[0]=='gnoth'){ echo"$showgame[game_guest] گل نميزند";}
if ($game_info[0]=='gone'){ echo"$showgame[game_guest] یک گل ميزند";}
if ($game_info[0]=='gtwo'){ echo"$showgame[game_guest] دو گل ميزند";}
if ($game_info[0]=='gthree'){ echo"$showgame[game_guest] سه گل وبیشترميزند";}

if ($game_info[0]=='h2win'){ echo"$showgame[game_host] برد نیمه دوم";}
if ($game_info[0]=='h2even'){ echo"تساوی نیمه دوم";}
if ($game_info[0]=='h2lose'){ echo"$showgame[game_guest] برد نیمه دوم";}

if ($game_info[0]=='h2pair'){ echo"زوج نیمه دوم";}
if ($game_info[0]=='h2odd'){ echo"فرد نیمه دوم";}

?></li>
</ul>




<?
}else if ($ourtime > $inmoment and $showgame['game_status'] == 1) {

?>


<ul id="<?php echo "formline" . $showgame['game_id']; ?>" style="border-bottom:1px solid #454545;padding:3px 0 3px 0;">
<li style="padding:2px; padding-bottom:0; cursor:pointer;">
<img src="images/button_delete.png" width="15" onClick="showhomebox('<?php echo $allgame[$i]; ?>', '<?php echo $game_type; ?>' ,'<?php echo $showgame['gamecounty']; ?>', '<?php echo $_SESSION['user_id']; ?>', '<?php echo "formline" . $showgame['game_id']; ?>');">
</li>
<li style=color:#248433><?php echo $showgame['game_host'] . ' - ' . $showgame['game_guest'] ; ?></li>
<li><?php echo " <b style=color:#ff4200>($game_info[2])</b> "; 
if ($game_info[0]=='win'){ echo "برد"; echo $showgame['game_host'];}
if ($game_info[0]=='even'){ echo'تساوي';}
if ($game_info[0]=='lose'){ echo "برد"; echo $showgame['game_guest'];}

if ($game_info[0]=='over05'){ echo"آور 0.5";}
if ($game_info[0]=='under05'){ echo"آندر 0.5";}

if ($game_info[0]=='over15'){ echo"آور 1.5";}
if ($game_info[0]=='under15'){ echo"آندر 1.5";}

if ($game_info[0]=='over'){ echo"آور 2.5";}
if ($game_info[0]=='under'){ echo"آندر 2.5";}

if ($game_info[0]=='over35'){ echo"آور 3.5";}
if ($game_info[0]=='under35'){ echo"آندر 3.5";}

if ($game_info[0]=='over45'){ echo"آور 4.5";}
if ($game_info[0]=='under45'){ echo"آندر 4.5";}

if ($game_info[0]=='pair'){ echo"گلها زوج";}
if ($game_info[0]=='odd'){ echo"گلها فرد";}

if ($game_info[0]=='duble1x'){ echo"برد $showgame[game_host] یا تساوی";}
if ($game_info[0]=='duble2x'){ echo"برد $showgame[game_guest] یا تساوی";}
if ($game_info[0]=='duble12'){ echo"برد میزبان یا میهمان";}

if ($game_info[0]=='2timgoly'){ echo"هردوتيم به گل میرسند";}
if ($game_info[0]=='2timgoln'){ echo"هردوتيم به گل نمیرسند";}
if ($game_info[0]=='2timgolyn'){ echo"یک یا دوتیم به گل میرسند";}

if ($game_info[0]=='score10'){ echo"نتیجه دقیق 0-1";}
if ($game_info[0]=='score20'){ echo"نتیجه دقیق 0-2";}
if ($game_info[0]=='score21'){ echo"نتیجه دقیق 1-2";}
if ($game_info[0]=='score30'){ echo"نتیجه دقیق 0-3";}
if ($game_info[0]=='score31'){ echo"نتیجه دقیق 1-3";}
if ($game_info[0]=='score32'){ echo"نتیجه دقیق 2-3";}
if ($game_info[0]=='score00'){ echo"نتیجه دقیق 0-0";}
if ($game_info[0]=='score11'){ echo"نتیجه دقیق 1-1";}
if ($game_info[0]=='score22'){ echo"نتیجه دقیق 2-2";}
if ($game_info[0]=='score33'){ echo"نتیجه دقیق 3-3";}
if ($game_info[0]=='score01'){ echo"نتیجه دقیق 1-0";}
if ($game_info[0]=='score02'){ echo"نتیجه دقیق 2-0";}
if ($game_info[0]=='score12'){ echo"نتیجه دقیق 2-1";}
if ($game_info[0]=='score03'){ echo"نتیجه دقیق 3-0";}
if ($game_info[0]=='score13'){ echo"نتیجه دقیق 3-1";}
if ($game_info[0]=='score23'){ echo"نتیجه دقیق 3-2";}


if ($game_info[0]=='total1over15'){ echo"گلهای میزبان آور 1.5";}
if ($game_info[0]=='total1under15'){ echo"گلهای میزبان آندر 1.5";}
if ($game_info[0]=='total1over25'){ echo"گلهای میزبان آور 2.5";}
if ($game_info[0]=='total1under25'){ echo"گلهای میزبان آندر 2.5";}
if ($game_info[0]=='total1over35'){ echo"گلهای میزبان آور 3.5";}
if ($game_info[0]=='total1under35'){ echo"گلهای میزبان آندر 3.5";}

if ($game_info[0]=='total2over15'){ echo"گلهای میهمان آور 1.5";}
if ($game_info[0]=='total2under15'){ echo"گلهای میهمان آندر 1.5";}
if ($game_info[0]=='total2over25'){ echo"گلهای میهمان آور 2.5";}
if ($game_info[0]=='total2under25'){ echo"گلهای میهمان آندر 2.5";}
if ($game_info[0]=='total2over35'){ echo"گلهای میهمان آور 3.5";}
if ($game_info[0]=='total2under35'){ echo"گلهای میهمان آندر 3.5";}


if ($game_info[0]=='hfhh1'){ echo"$showgame[game_host]/$showgame[game_host]";}
if ($game_info[0]=='hfxh2'){ echo"تساوي نیمه اول/$showgame[game_host]";}
if ($game_info[0]=='hfhg3'){ echo"$showgame[game_host]/$showgame[game_guest]";}
if ($game_info[0]=='hfhx4'){ echo"$showgame[game_host]/تساوي كل بازي";}
if ($game_info[0]=='hfxx5'){ echo"تساوي نيمه اول/تساوي كل بازي";}
if ($game_info[0]=='hfgx6'){ echo"$showgame[game_guest]/تساوي كل بازي";}
if ($game_info[0]=='hfgh7'){ echo"$showgame[game_guest]/$showgame[game_host]";}
if ($game_info[0]=='hfxg8'){ echo"تساوي نیمه اول/$showgame[game_guest]";}
if ($game_info[0]=='hfgg9'){ echo"$showgame[game_guest]/$showgame[game_guest]";}


if ($game_info[0]=='moregolh1'){ echo"بیشترین گلها نیمه اول";}
if ($game_info[0]=='moregolh2'){ echo"بیشترین گلها نیمه دوم";}
if ($game_info[0]=='moregoleqal'){ echo"گلهای نیمه اول و دوم برابر";}

if ($game_info[0]=='handimosbat15'){ echo"هندیکپ -1.5 $showgame[game_host]";}
if ($game_info[0]=='handimosbat25'){ echo"هندیکپ -2.5 $showgame[game_host]";}
if ($game_info[0]=='handimosbat35'){ echo"هندیکپ -3.5 $showgame[game_host]";}
if ($game_info[0]=='handimanfi15'){ echo"هندیکپ +1.5 $showgame[game_guest]";}
if ($game_info[0]=='handimanfi25'){ echo"هندیکپ +2.5 $showgame[game_guest]";}
if ($game_info[0]=='handimanfi35'){ echo"هندیکپ +3.5 $showgame[game_guest]";}








if ($game_info[0]=='hwin'){ echo"برد نیمه اول $showgame[game_host]";}
if ($game_info[0]=='heven'){ echo"تساوي نیمه اول";}
if ($game_info[0]=='hlose'){ echo"برد نیمه اول $showgame[game_guest]";}
 

if ($game_info[0]=='tg1'){ echo"کلا 1 گل";}
if ($game_info[0]=='tg2'){ echo"کلا 2 گل";}
if ($game_info[0]=='tg3'){ echo"کلا 3 گل";}
if ($game_info[0]=='tg4'){ echo"کلا 4 گل";}
 

if ($game_info[0]=='hfulh'){ echo"$showgame[game_host] برنده هردونیمه";}
if ($game_info[0]=='hfulg'){ echo"$showgame[game_guest] برنده هردونیمه";}
if ($game_info[0]=='hfule'){ echo"هردونیمه بدون برنده";}

if ($game_info[0]=='winohost'){ echo"$showgame[game_host] برنده و آور2.5";}
if ($game_info[0]=='winoguest'){ echo"$showgame[game_guest] برنده و آور2.5";}
if ($game_info[0]=='winuhost'){ echo"$showgame[game_host] برنده و آندر2.5";}
if ($game_info[0]=='winuguest'){ echo"$showgame[game_guest] برنده و آندر2.5";}

if ($game_info[0]=='hh1'){ echo"درنیمه اول $showgame[game_host] گل بیشتر";}
if ($game_info[0]=='hh2'){ echo"درنیمه دوم $showgame[game_host] گل بیشتر";}
if ($game_info[0]=='gh1'){ echo"در نیمه اول $showgame[game_guest] گل بیشتر";}
if ($game_info[0]=='gh2'){ echo"درنیمه دوم $showgame[game_guest] گل بیشتر";}


if ($game_info[0]=='hnoth'){ echo"$showgame[game_host] گل نميزند";}
if ($game_info[0]=='hone'){ echo"$showgame[game_host] یک گل ميزند";}
if ($game_info[0]=='htwo'){ echo"$showgame[game_host] دو گل ميزند";}
if ($game_info[0]=='hthree'){ echo"$showgame[game_host] سه گل وبیشترميزند";}
if ($game_info[0]=='gnoth'){ echo"$showgame[game_guest] گل نميزند";}
if ($game_info[0]=='gone'){ echo"$showgame[game_guest] یک گل ميزند";}
if ($game_info[0]=='gtwo'){ echo"$showgame[game_guest] دو گل ميزند";}
if ($game_info[0]=='gthree'){ echo"$showgame[game_guest] سه گل وبیشترميزند";}

if ($game_info[0]=='h2win'){ echo"$showgame[game_host] برد نیمه دوم";}
if ($game_info[0]=='h2even'){ echo"تساوی نیمه دوم";}
if ($game_info[0]=='h2lose'){ echo"$showgame[game_guest] برد نیمه دوم";}

if ($game_info[0]=='h2pair'){ echo"زوج نیمه دوم";}
if ($game_info[0]=='h2odd'){ echo"فرد نیمه دوم";}


?></li>
</ul>

<?php 

				} else {
					if(preg_match('/=/i',$delete['form_res'])) {
						unset($delete_res);
						$delete_res_explode = explode ("=", $showform['form_res']);
						for ($i = 0; $i <= 20; $i++) {
							if (($delete_res_explode[$i] != $allgame[$i]) and (strlen($delete_res_explode[$i])) > 0)
							$delete_res .= $delete_res_explode[$i] . "=";
						}
						
						$delete_rat_explode = explode ("-", $allgame[$i]);
						$delete_rat = $delete['form_rat'] / $delete_rat_explode[2];
						
						tep_db_query("update `forms` set form_res = '" . $delete_res . "', form_rat = " . $delete_rat . " where form_user = '" . $_SESSION['user_id'] . "' and form_done = 0");
						
					} else {
						tep_db_query("update `forms` set form_res = '', form_rat = 0 where form_user = '" . $_SESSION['user_id'] . "' and form_done = 0");
					}

				}
			}
		}
	
	} else { 
	    	  //  echo $showform['form_res'];
	 
	    
		$game_info = explode ("-", $showform['form_res']);
 
		if ( $game_info[1] > 0 ) {
			$showgame = tep_db_fetch_array(tep_db_query("select game_id, live, gamecounty, game_host, game_guest, game_time, game_status from `games` where game_id = '" . $game_info[1] . "'"));
			
			$inmoment = jdate("YmdHis");
			$ourtime = str_replace(" ", "", $showgame['game_time']);
			$ourtime = str_replace("-", "", $ourtime);
			$ourtime = str_replace(":", "", $ourtime);
				
 if ($showgame['live']=='1' and $showgame['game_status'] == 1){ 
     
     ?>
  <!--   <table border="0" width="98%">
		<tr>
<td width="100%" style="height:25px;background-color:#FFF7D9;color:#000000;"><center><b>تــکی</center></b></td>
		</tr>
	</table>-->

<ul id="<?php echo 'formline' . $showgame['game_id']; ?>" style="border-bottom:1px solid #454545;padding:3px 0 3px 0;">
<li style="padding:2px; padding-bottom:0; cursor:pointer;">
<img src="images/button_delete.png" width="15" onClick="showhomebox('<?php echo $showform['form_res']; ?>', '<?php echo $game_type; ?>', '<?php echo $showgame['gamecounty']; ?>', '<?php echo $_SESSION['user_id']; ?>', '<?php echo 'formline' . $showgame['game_id']; ?>');">
</li>
<li style=color:#248433><?php echo $showgame['game_host'] . ' - ' . $showgame['game_guest'] ; ?></li>
<li><?php echo " <b style=color:#ff4200>($game_info[2])</b> "; 

if ($game_info[0]=='win'){ echo "برد"; echo $showgame[game_host];}
if ($game_info[0]=='even'){ echo'تساوي';}
if ($game_info[0]=='lose'){ echo "برد"; echo $showgame[game_guest];}

if ($game_info[0]=='over05'){ echo"آور 0.5";}
if ($game_info[0]=='under05'){ echo"آندر 0.5";}

if ($game_info[0]=='over15'){ echo"آور 1.5";}
if ($game_info[0]=='under15'){ echo"آندر 1.5";}

if ($game_info[0]=='over'){ echo"آور 2.5";}
if ($game_info[0]=='under'){ echo"آندر 2.5";}

if ($game_info[0]=='over35'){ echo"آور 3.5";}
if ($game_info[0]=='under35'){ echo"آندر 3.5";}

if ($game_info[0]=='over45'){ echo"آور 4.5";}
if ($game_info[0]=='under45'){ echo"آندر 4.5";}

if ($game_info[0]=='pair'){ echo"گلها زوج";}
if ($game_info[0]=='odd'){ echo"گلها فرد";}

if ($game_info[0]=='duble1x'){ echo"برد $showgame[game_host] یا تساوی";}
if ($game_info[0]=='duble2x'){ echo"برد $showgame[game_guest] یا تساوی";}
if ($game_info[0]=='duble12'){ echo"برد میزبان یا میهمان";}

if ($game_info[0]=='2timgoly'){ echo"هردوتيم به گل میرسند";}
if ($game_info[0]=='2timgoln'){ echo"هردوتيم به گل نمیرسند";}
if ($game_info[0]=='2timgolyn'){ echo"یک یا دوتیم به گل میرسند";}

if ($game_info[0]=='score10'){ echo"نتیجه دقیق 0-1";}
if ($game_info[0]=='score20'){ echo"نتیجه دقیق 0-2";}
if ($game_info[0]=='score21'){ echo"نتیجه دقیق 1-2";}
if ($game_info[0]=='score30'){ echo"نتیجه دقیق 0-3";}
if ($game_info[0]=='score31'){ echo"نتیجه دقیق 1-3";}
if ($game_info[0]=='score32'){ echo"نتیجه دقیق 2-3";}
if ($game_info[0]=='score00'){ echo"نتیجه دقیق 0-0";}
if ($game_info[0]=='score11'){ echo"نتیجه دقیق 1-1";}
if ($game_info[0]=='score22'){ echo"نتیجه دقیق 2-2";}
if ($game_info[0]=='score33'){ echo"نتیجه دقیق 3-3";}
if ($game_info[0]=='score01'){ echo"نتیجه دقیق 1-0";}
if ($game_info[0]=='score02'){ echo"نتیجه دقیق 2-0";}
if ($game_info[0]=='score12'){ echo"نتیجه دقیق 2-1";}
if ($game_info[0]=='score03'){ echo"نتیجه دقیق 3-0";}
if ($game_info[0]=='score13'){ echo"نتیجه دقیق 3-1";}
if ($game_info[0]=='score23'){ echo"نتیجه دقیق 3-2";}


if ($game_info[0]=='total1over15'){ echo"گلهای میزبان آور 1.5";}
if ($game_info[0]=='total1under15'){ echo"گلهای میزبان آندر 1.5";}
if ($game_info[0]=='total1over25'){ echo"گلهای میزبان آور 2.5";}
if ($game_info[0]=='total1under25'){ echo"گلهای میزبان آندر 2.5";}
if ($game_info[0]=='total1over35'){ echo"گلهای میزبان آور 3.5";}
if ($game_info[0]=='total1under35'){ echo"گلهای میزبان آندر 3.5";}

if ($game_info[0]=='total2over15'){ echo"گلهای میهمان آور 1.5";}
if ($game_info[0]=='total2under15'){ echo"گلهای میهمان آندر 1.5";}
if ($game_info[0]=='total2over25'){ echo"گلهای میهمان آور 2.5";}
if ($game_info[0]=='total2under25'){ echo"گلهای میهمان آندر 2.5";}
if ($game_info[0]=='total2over35'){ echo"گلهای میهمان آور 3.5";}
if ($game_info[0]=='total2under35'){ echo"گلهای میهمان آندر 3.5";}


if ($game_info[0]=='hfhh1'){ echo"$showgame[game_host]/$showgame[game_host]";}
if ($game_info[0]=='hfxh2'){ echo"تساوي نیمه اول/$showgame[game_host]";}
if ($game_info[0]=='hfhg3'){ echo"$showgame[game_host]/$showgame[game_guest]";}
if ($game_info[0]=='hfhx4'){ echo"$showgame[game_host]/تساوي كل بازي";}
if ($game_info[0]=='hfxx5'){ echo"تساوي نيمه اول/تساوي كل بازي";}
if ($game_info[0]=='hfgx6'){ echo"$showgame[game_guest]/تساوي كل بازي";}
if ($game_info[0]=='hfgh7'){ echo"$showgame[game_guest]/$showgame[game_host]";}
if ($game_info[0]=='hfxg8'){ echo"تساوي نیمه اول/$showgame[game_guest]";}
if ($game_info[0]=='hfgg9'){ echo"$showgame[game_guest]/$showgame[game_guest]";}


if ($game_info[0]=='moregolh1'){ echo"بیشترین گلها نیمه اول";}
if ($game_info[0]=='moregolh2'){ echo"بیشترین گلها نیمه دوم";}
if ($game_info[0]=='moregoleqal'){ echo"گلهای نیمه اول و دوم برابر";}

if ($game_info[0]=='handimosbat15'){ echo"هندیکپ -1.5 $showgame[game_host]";}
if ($game_info[0]=='handimosbat25'){ echo"هندیکپ -2.5 $showgame[game_host]";}
if ($game_info[0]=='handimosbat35'){ echo"هندیکپ -3.5 $showgame[game_host]";}
if ($game_info[0]=='handimanfi15'){ echo"هندیکپ +1.5 $showgame[game_guest]";}
if ($game_info[0]=='handimanfi25'){ echo"هندیکپ +2.5 $showgame[game_guest]";}
if ($game_info[0]=='handimanfi35'){ echo"هندیکپ +3.5 $showgame[game_guest]";}








if ($game_info[0]=='hwin'){ echo"برد نیمه اول $showgame[game_host]";}
if ($game_info[0]=='heven'){ echo"تساوي نیمه اول";}
if ($game_info[0]=='hlose'){ echo"برد نیمه اول $showgame[game_guest]";}

 

if ($game_info[0]=='tg1'){ echo"کلا 1 گل";}
if ($game_info[0]=='tg2'){ echo"کلا 2 گل";}
if ($game_info[0]=='tg3'){ echo"کلا 3 گل";}
if ($game_info[0]=='tg4'){ echo"کلا 4 گل";}
  

if ($game_info[0]=='hfulh'){ echo"$showgame[game_host] برنده هردونیمه";}
if ($game_info[0]=='hfulg'){ echo"$showgame[game_guest] برنده هردونیمه";}
if ($game_info[0]=='hfule'){ echo"هردونیمه بدون برنده";}

if ($game_info[0]=='winohost'){ echo"$showgame[game_host] برنده و آور2.5";}
if ($game_info[0]=='winoguest'){ echo"$showgame[game_guest] برنده و آور2.5";}
if ($game_info[0]=='winuhost'){ echo"$showgame[game_host] برنده و آندر2.5";}
if ($game_info[0]=='winuguest'){ echo"$showgame[game_guest] برنده و آندر2.5";}

if ($game_info[0]=='hh1'){ echo"درنیمه اول $showgame[game_host] گل بیشتر";}
if ($game_info[0]=='hh2'){ echo"درنیمه دوم $showgame[game_host] گل بیشتر";}
if ($game_info[0]=='gh1'){ echo"در نیمه اول $showgame[game_guest] گل بیشتر";}
if ($game_info[0]=='gh2'){ echo"درنیمه دوم $showgame[game_guest] گل بیشتر";}


if ($game_info[0]=='hnoth'){ echo"$showgame[game_host] گل نميزند";}
if ($game_info[0]=='hone'){ echo"$showgame[game_host] یک گل ميزند";}
if ($game_info[0]=='htwo'){ echo"$showgame[game_host] دو گل ميزند";}
if ($game_info[0]=='hthree'){ echo"$showgame[game_host] سه گل وبیشترميزند";}
if ($game_info[0]=='gnoth'){ echo"$showgame[game_guest] گل نميزند";}
if ($game_info[0]=='gone'){ echo"$showgame[game_guest] یک گل ميزند";}
if ($game_info[0]=='gtwo'){ echo"$showgame[game_guest] دو گل ميزند";}
if ($game_info[0]=='gthree'){ echo"$showgame[game_guest] سه گل وبیشترميزند";}

if ($game_info[0]=='h2win'){ echo"$showgame[game_host] برد نیمه دوم";}
if ($game_info[0]=='h2even'){ echo"تساوی نیمه دوم";}
if ($game_info[0]=='h2lose'){ echo"$showgame[game_guest] برد نیمه دوم";}

if ($game_info[0]=='h2pair'){ echo"زوج نیمه دوم";}
if ($game_info[0]=='h2odd'){ echo"فرد نیمه دوم";}


?></li>
</ul>
     
<? }else if ($ourtime > $inmoment and $showgame['game_status'] == 1) {
				
?>

<!--	<table border="0" width="98%">
		<tr>
<td width="100%" style="height:25px;background-color:#FFF7D9;color:#000000;"><center><b>تــکی</center></b></td>
		</tr>
	</table>
-->
<ul id="<?php echo 'formline' . $showgame['game_id']; ?>" style="border-bottom:1px solid #454545;padding:3px 0 3px 0;">
<li style="padding:2px; padding-bottom:0; cursor:pointer;">
<img src="images/button_delete.png" width="15" onClick="showhomebox('<?php echo $showform['form_res']; ?>', '<?php echo $game_type; ?>', '<?php echo $showgame['gamecounty']; ?>', '<?php echo $_SESSION['user_id']; ?>', '<?php echo 'formline' . $showgame['game_id']; ?>');">
</li>
<li style=color:#248433><?php echo $showgame['game_host'] . ' - ' . $showgame['game_guest'] ; ?></li>
<li><?php echo " <b style=color:#ff4200>($game_info[2])</b> "; 

if ($game_info[0]=='win'){ echo "برد"; echo $showgame['game_host'];}
if ($game_info[0]=='even'){ echo'تساوي';}
if ($game_info[0]=='lose'){ echo "برد"; echo $showgame['game_guest'];}

if ($game_info[0]=='over05'){ echo"آور 0.5";}
if ($game_info[0]=='under05'){ echo"آندر 0.5";}

if ($game_info[0]=='over15'){ echo"آور 1.5";}
if ($game_info[0]=='under15'){ echo"آندر 1.5";}

if ($game_info[0]=='over'){ echo"آور 2.5";}
if ($game_info[0]=='under'){ echo"آندر 2.5";}

if ($game_info[0]=='over35'){ echo"آور 3.5";}
if ($game_info[0]=='under35'){ echo"آندر 3.5";}

if ($game_info[0]=='over45'){ echo"آور 4.5";}
if ($game_info[0]=='under45'){ echo"آندر 4.5";}

if ($game_info[0]=='pair'){ echo"گلها زوج";}
if ($game_info[0]=='odd'){ echo"گلها فرد";}

if ($game_info[0]=='duble1x'){ echo"برد $showgame[game_host] یا تساوی";}
if ($game_info[0]=='duble2x'){ echo"برد $showgame[game_guest] یا تساوی";}
if ($game_info[0]=='duble12'){ echo"برد میزبان یا میهمان";}

if ($game_info[0]=='2timgoly'){ echo"هردوتيم به گل میرسند";}
if ($game_info[0]=='2timgoln'){ echo"هردوتيم به گل نمیرسند";}
if ($game_info[0]=='2timgolyn'){ echo"یک یا دوتیم به گل میرسند";}

if ($game_info[0]=='score10'){ echo"نتیجه دقیق 0-1";}
if ($game_info[0]=='score20'){ echo"نتیجه دقیق 0-2";}
if ($game_info[0]=='score21'){ echo"نتیجه دقیق 1-2";}
if ($game_info[0]=='score30'){ echo"نتیجه دقیق 0-3";}
if ($game_info[0]=='score31'){ echo"نتیجه دقیق 1-3";}
if ($game_info[0]=='score32'){ echo"نتیجه دقیق 2-3";}
if ($game_info[0]=='score00'){ echo"نتیجه دقیق 0-0";}
if ($game_info[0]=='score11'){ echo"نتیجه دقیق 1-1";}
if ($game_info[0]=='score22'){ echo"نتیجه دقیق 2-2";}
if ($game_info[0]=='score33'){ echo"نتیجه دقیق 3-3";}
if ($game_info[0]=='score01'){ echo"نتیجه دقیق 1-0";}
if ($game_info[0]=='score02'){ echo"نتیجه دقیق 2-0";}
if ($game_info[0]=='score12'){ echo"نتیجه دقیق 2-1";}
if ($game_info[0]=='score03'){ echo"نتیجه دقیق 3-0";}
if ($game_info[0]=='score13'){ echo"نتیجه دقیق 3-1";}
if ($game_info[0]=='score23'){ echo"نتیجه دقیق 3-2";}


if ($game_info[0]=='total1over15'){ echo"گلهای میزبان آور 1.5";}
if ($game_info[0]=='total1under15'){ echo"گلهای میزبان آندر 1.5";}
if ($game_info[0]=='total1over25'){ echo"گلهای میزبان آور 2.5";}
if ($game_info[0]=='total1under25'){ echo"گلهای میزبان آندر 2.5";}
if ($game_info[0]=='total1over35'){ echo"گلهای میزبان آور 3.5";}
if ($game_info[0]=='total1under35'){ echo"گلهای میزبان آندر 3.5";}

if ($game_info[0]=='total2over15'){ echo"گلهای میهمان آور 1.5";}
if ($game_info[0]=='total2under15'){ echo"گلهای میهمان آندر 1.5";}
if ($game_info[0]=='total2over25'){ echo"گلهای میهمان آور 2.5";}
if ($game_info[0]=='total2under25'){ echo"گلهای میهمان آندر 2.5";}
if ($game_info[0]=='total2over35'){ echo"گلهای میهمان آور 3.5";}
if ($game_info[0]=='total2under35'){ echo"گلهای میهمان آندر 3.5";}


if ($game_info[0]=='hfhh1'){ echo"$showgame[game_host]/$showgame[game_host]";}
if ($game_info[0]=='hfxh2'){ echo"تساوي نیمه اول/$showgame[game_host]";}
if ($game_info[0]=='hfhg3'){ echo"$showgame[game_host]/$showgame[game_guest]";}
if ($game_info[0]=='hfhx4'){ echo"$showgame[game_host]/تساوي كل بازي";}
if ($game_info[0]=='hfxx5'){ echo"تساوي نيمه اول/تساوي كل بازي";}
if ($game_info[0]=='hfgx6'){ echo"$showgame[game_guest]/تساوي كل بازي";}
if ($game_info[0]=='hfgh7'){ echo"$showgame[game_guest]/$showgame[game_host]";}
if ($game_info[0]=='hfxg8'){ echo"تساوي نیمه اول/$showgame[game_guest]";}
if ($game_info[0]=='hfgg9'){ echo"$showgame[game_guest]/$showgame[game_guest]";}


if ($game_info[0]=='moregolh1'){ echo"بیشترین گلها نیمه اول";}
if ($game_info[0]=='moregolh2'){ echo"بیشترین گلها نیمه دوم";}
if ($game_info[0]=='moregoleqal'){ echo"گلهای نیمه اول و دوم برابر";}

if ($game_info[0]=='handimosbat15'){ echo"هندیکپ -1.5 $showgame[game_host]";}
if ($game_info[0]=='handimosbat25'){ echo"هندیکپ -2.5 $showgame[game_host]";}
if ($game_info[0]=='handimosbat35'){ echo"هندیکپ -3.5 $showgame[game_host]";}
if ($game_info[0]=='handimanfi15'){ echo"هندیکپ +1.5 $showgame[game_guest]";}
if ($game_info[0]=='handimanfi25'){ echo"هندیکپ +2.5 $showgame[game_guest]";}
if ($game_info[0]=='handimanfi35'){ echo"هندیکپ +3.5 $showgame[game_guest]";}








if ($game_info[0]=='hwin'){ echo"برد نیمه اول $showgame[game_host]";}
if ($game_info[0]=='heven'){ echo"تساوي نیمه اول";}
if ($game_info[0]=='hlose'){ echo"برد نیمه اول $showgame[game_guest]";}

 

if ($game_info[0]=='tg1'){ echo"کلا 1 گل";}
if ($game_info[0]=='tg2'){ echo"کلا 2 گل";}
if ($game_info[0]=='tg3'){ echo"کلا 3 گل";}
if ($game_info[0]=='tg4'){ echo"کلا 4 گل";}
 

if ($game_info[0]=='hfulh'){ echo"$showgame[game_host] برنده هردونیمه";}
if ($game_info[0]=='hfulg'){ echo"$showgame[game_guest] برنده هردونیمه";}
if ($game_info[0]=='hfule'){ echo"هردونیمه بدون برنده";}

if ($game_info[0]=='winohost'){ echo"$showgame[game_host] برنده و آور2.5";}
if ($game_info[0]=='winoguest'){ echo"$showgame[game_guest] برنده و آور2.5";}
if ($game_info[0]=='winuhost'){ echo"$showgame[game_host] برنده و آندر2.5";}
if ($game_info[0]=='winuguest'){ echo"$showgame[game_guest] برنده و آندر2.5";}

if ($game_info[0]=='hh1'){ echo"درنیمه اول $showgame[game_host] گل بیشتر";}
if ($game_info[0]=='hh2'){ echo"درنیمه دوم $showgame[game_host] گل بیشتر";}
if ($game_info[0]=='gh1'){ echo"در نیمه اول $showgame[game_guest] گل بیشتر";}
if ($game_info[0]=='gh2'){ echo"درنیمه دوم $showgame[game_guest] گل بیشتر";}


if ($game_info[0]=='hnoth'){ echo"$showgame[game_host] گل نميزند";}
if ($game_info[0]=='hone'){ echo"$showgame[game_host] یک گل ميزند";}
if ($game_info[0]=='htwo'){ echo"$showgame[game_host] دو گل ميزند";}
if ($game_info[0]=='hthree'){ echo"$showgame[game_host] سه گل وبیشترميزند";}
if ($game_info[0]=='gnoth'){ echo"$showgame[game_guest] گل نميزند";}
if ($game_info[0]=='gone'){ echo"$showgame[game_guest] یک گل ميزند";}
if ($game_info[0]=='gtwo'){ echo"$showgame[game_guest] دو گل ميزند";}
if ($game_info[0]=='gthree'){ echo"$showgame[game_guest] سه گل وبیشترميزند";}

if ($game_info[0]=='h2win'){ echo"$showgame[game_host] برد نیمه دوم";}
if ($game_info[0]=='h2even'){ echo"تساوی نیمه دوم";}
if ($game_info[0]=='h2lose'){ echo"$showgame[game_guest] برد نیمه دوم";}

if ($game_info[0]=='h2pair'){ echo"زوج نیمه دوم";}
if ($game_info[0]=='h2odd'){ echo"فرد نیمه دوم";}


?></li>
</ul>

<?php

			} else {
tep_db_query("update `forms` set form_res = '', form_rat = 0 where form_user = '" . $_SESSION['user_id'] . "' and form_done = 0");
			}
		}
	}
}

if (text_check('get', 'final') != 'ok') {
	if ($formdone == true) {

?>



<div align="center">
	<table border="0" width="95%" cellpadding="0">
		<tr>
			<td height="40">جایزه</td>
			<td height="40"><?php echo round(number_check('get', 'bet')*$showform['form_rat'], -1); ?></td>
		</tr>
		<tr>
			<td height="40">ضریب کل</td>
			<td height="40"><?php echo round($showform['form_rat'], 2); ?></td>
		</tr>
	</table>
</div>




<form>
<input type="hidden" value="<?php echo number_check('get', 'bet'); ?>" name="bet">

<input type="button" value="تغییر مبلغ" class="button4" onClick="showformbox('','<?php echo $game_type; ?>', '0', '<?php echo $_SESSION['user_id']; ?>', '', '0');">
<input type="button"  value="تایید نهایی" class="button3" onClick="showformbox('','<?php echo $game_type; ?>', '0', '<?php echo $_SESSION['user_id']; ?>', '', bet.value, '', 'ok');">

</form>

<?php } else { ?>

<form>
<br />



<div align="center">
	<table border="0" width="95%" cellpadding="0">
		<tr>
			<td height="40">مبلغ (تومان)</td>
			<td height="40"><input type="text" name="bet" class="field" style="width:100px;text-align:center;" width"100px" onkeyup="domath(bet.value, '<?php echo round($showform['form_rat'], 2); ?>');" /></td>
		</tr>
		<tr>
			<td height="40">ضریب</td>
			<td height="40"><input readonly type="text" width="100px" style="width:100px;text-align:center;" maxlength="30" value="<?php echo round($showform['form_rat'], 2); ?>" /></td>
		</tr>
		<tr>
			<td height="40">جایزه</td>
			<td height="40"><input type="text" value="0" id="reward" class="field" style="width:100px;text-align:center;" width"100px" readonly /></td>
		</tr>
	</table>
</div>


<input type="button" class="button3" value="تایید اولیه"   onClick="showformbox('','<?php echo $game_type; ?>', '0', '<?php echo $_SESSION['user_id']; ?>', '', bet.value);">
<br />




<a href="?delform=e" >
<button type="button" class="button4" onclick="alert('  موارد انتخابی فرم ثبت نشده شما حذف شدند.')"> حذف همه</button>
</a>
</form>
<br />

<div class="clear"></div>

<?php } } ?>

</div>

</body></html>

<?php tep_session_close(); tep_db_close(); ?>