<?php
require('includes/applications.php');

$userid1=$_SESSION['user_id'];
if ($_REQUEST['delform']){
 $sql = "DELETE FROM forms WHERE form_user='$userid1' and form_done<'1' "; 
         mysql_query($sql)  or die(mysql_error());
}

//logoff
if ($_REQUEST['where'] == "logoff") {
	tep_session_unregister('user_id');
	tep_session_unregister('user_user');
	tep_session_unregister('username');
echo "<script>document.location.href='http://table.bezjibet1.com/users/logout'</script>\n";
exit;
}
//get user info
if ($_SESSION['user_id'] > 0) {
	$userinfo = tep_db_fetch_array (tep_db_query("SELECT * FROM `users1` WHERE user_id = '" . (int)$_SESSION['user_id'] . "'"));
	$userinfo2 = tep_db_fetch_array (tep_db_query("SELECT * FROM `users` WHERE id = '" . (int)$_SESSION['user_id'] . "'"));
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo SITE_TITLE ; ?></title>
<meta name="keywords" content="پيش بينى فوتبال، شرطبندى، پيش بينى ورزشى، كازينو آنلاين، پوكر، تخته نرد، بلك جك، ٢١، پاسور، رولت، پوكر آنلاين " />
<meta name="description" content="بزرگترین مرکز پیش بینی ورزشی و کازینو آنلاین" />
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no">
<link href="images/favicon.png" rel="shortcut icon" type="image/x-icon" />
<link href="bball/opa.css" rel="stylesheet">
<!--<link href="bball/normalize.css" rel="stylesheet" />-->

<link href="bball/default.style.rtl.css" rel="stylesheet" />
<link href="bball/fix.css" rel="stylesheet" />      

<script type="text/javascript" src="jsoptim/jquery_70fda99a72ffd6f8eb3d287a4162c5f6.js"></script>
<script type="text/javascript" src="jsoptim/jquery.inputmask.bundle_954e8e42ea4042b7972dcdb53649da30.js"></script>

<script type="text/javascript" src="jsoptim/script_5ac4ac4336f4457d60ad19243eae6d84.js"></script>

<meta http-equiv="refresh" content="360; url=live.php?where=<? echo $_REQUEST['where']; ?>">
<script type="text/javascript" src="jsoptim/functions_a11bfa2731194485d2e7a7b8ef5ab819.js"></script>
<!--
<script type="text/javascript" src="js/functions.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
-->
<script src="jsoptim/jquery-1.9.1_22dec043678bbcde824390ffed497f95.js"></script>
<script src="jsoptim/jquery-ui_c2b0c2990b0899f3e3e3d0791bf33206.js"></script>


<script> $(function() { $( document ).tooltip(); }); </script>
<!--
<script src="js/jquery-1.10.2.min.js"></script>
-->
<script src="jsoptim/jquery-1.10.2.min_6734a237fe5686a02a355f396fb9e9e4.js"></script>
</head>

<body>

	<center>
 
		
		
		
		
		
		
			<div class="header container mobile mobile-bar">
			<div class="icon"><a href="javascript:;" class="mobile-menu-action fa fa-bars"></a></div>
			<div class="icon"></div>
			<div class="logo"><a href="index.php"><img alt="Logo" src="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/assets/default/tmp2020/images/main_logo1.png" style="height:40px;width:150px;"></a></div>
			<div class="icon"><a href="javascript:;" class="mobile-menu-filter-action fa fa-book"></a></div>
			<div class="icon"><a href="javascript:;" class="mobile-menu-bet-action"><img alt="Logo" src="images/forrms.png" style="height:30px;width:30px;"></a></div>
			<div class="badge slip-count-badge">0</div>			<div class="clear"></div>
		</div>
		<div class="mobile mobile-bar-holder"></div>
	</center>
	
	
	

	<div class="top-bar desktop">
		<div class="container inline">
		    
<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>" ><img alt="Logo" style="height:60px;width:200px;" src="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/assets/default/tmp2020/images/main_logo1.png" title="<?php echo SITE_TITLE ; ?>" /></a>

<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>"  >کازینو </a>
<a href="index.php?where=soccer"  <? if ($_REQUEST['where'] =="soccer") { ?> class="active" <?}?>>پیش بینی ورزشی</a>
<a href="live.php?where=lives"  <? if ($_REQUEST['where'] =="lives") { ?> class="active" <?}?>>زنده  </a>
<a href="index.php?where=result"  <? if ($_REQUEST['where'] =="result") { ?> class="active" <?}?>>نتایج </a>

<?php if (tep_session_is_registered('user_id')) { ?>
<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/payment/credit" >افزایش موجودی </a>
<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/contacts/tickets/ticket-list"  >پشتیبانی</a>
<a href="index.php?where=forms"  <? if ($_REQUEST['where'] =="forms") { ?> class="active" <?}?>>فرمهای کاربر</a>
 <a href="index.php?where=logoff"  > خروج کاربر</a>
 <?}?>
 
 <?php if (tep_session_is_registered('user_id')) { ?>

 <!--<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/profile" class="link"><?php echo $userinfo2['username']; ?>      
 <img alt="Logo" src="images/userr.png" title="کاربر محترم" /></a>    <img alt="Logo" src="images/moneyy.png" title=" موجودی" /> -->
    <a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/payment/credit" class="link">موجودی <?php echo number_format($userinfo2['cash']); ?> تومان</a>
    <?}else{?>
		
			<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/login" class="link">ورود به حساب</a>
			<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/register" class="link">ثبت نام</a>
 <?}?>	
 
 
</div>
	</div>
	
	
	
	

	<div class="mobile-menu mobile">
		<div class="buttons" style="color:#FFFFFF;">
<?php if (tep_session_is_registered('user_id')) { ?>
    
 <?php echo $userinfo2['username']; ?>      
  <img alt="Logo" src="images/userr.png" title="کاربر محترم" />
  
   <br />
 <br />  
    <?php echo number_format($userinfo2['cash']); ?> ریال


 
    <img alt="Logo" src="images/moneyy.png" title=" موجودی" />
    <?}else{?>
		<style>
		.header .link{
  display: inline-block;
  color: #ffba00;
  padding: 7px 20px 7px 20px;
  font-size: 14px;
  text-decoration: none;
  margin: 8px 4px 0px 4px;
  font-weight: 400;
}
.header .login{
  background: #5093e8;
  color: #fff;
  padding: 5px 20px 5px 20px;
  font-weight: 500;
  border-radius: 4px;
  margin: 8px 2px 0px 2px;
  font-size: 14px;
    height:40px;

}

.header .signup{
  background: #872b6e;
  color: #ffffff;
  font-weight: 500;
  border-radius: 4px;
  padding: 6px 20px 6px 20px;
  font-size: 14px;
  margin: 8px 2px 0px 2px;
    height:40px;

}
</style>
<span class="header">
			<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/login" class="link login">ورود به حساب</a>
			<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/register" class="link signup">ثبت نام</a></span>
 <?}?>	
 				</div>

<?php
$user=$_SESSION['user_id'];
//mysql_query("delete from `forms` where form_user = '$user' and form_done='0' ");

if ($_SESSION['user_id'] == NULL) {
if ($login_error_1 == true) echo '<div class="error"> حساب کاربری شما غیرفعال شده است. </div>';
elseif ($login_error_2 == true) echo '<div class="error"> اطلاعات وارد شده معتبر نمی باشد. </div>';
}?>


 		
	
		<div class="items">
<a href="index.php?where=soccer" >پیش بینی  </a>
<a href="live.php?where=lives" >پیش بینی زنده</a>
 <a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>" >کازینوی آنلاین</a>
 		<?php if (tep_session_is_registered('user_id')) { ?>

<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/payment/credit" > افزایش موجودی</a>
<a href="index.php?where=forms" > فرمهای کاربر</a>

<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/payment/transactions">سابقه تراکنش ها</a>
<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/withdraw">درخواست جایزه</a>
<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/representation">طرح نمایندگی</a>
<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/profile">پروفایل من</a>
<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/contacts/tickets/ticket-list"  >پشتیبانی</a>
<a href="index.php?where=logoff"  > خروج کاربر</a>
    <?}else{?>
		<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/login">ورود به حساب</a>
			<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/register">ثبت نام</a>
 <?}?> 
 		</div>

		</div>

 


 

<script type="text/javascript" src="js/jquery.tzineClock.js"></script>
<? $where1=$_REQUEST['where'];
if ($where1=="livesbasket"){?>
<script type="application/javascript">
$(document).ready(function(){
 setInterval(function() {
            $.ajax({
                type: "POST",
                url: "lives.php?where=livesbasket&v1=4&sid"+ Math.random(),
                
                success: function(html) {
             
               $("#lives").html(html);
                }
            })
        }, 20000);
	/* This code is executed after the DOM has been completely loaded */

	$('#fancyClock').tzineClock();

});
</script>
<?}else if ($where1=="liveshockey"){?>
<script type="application/javascript">
$(document).ready(function(){
 setInterval(function() {
            $.ajax({
                type: "POST",
                url: "lives.php?where=liveshockey&v1=4&sid"+ Math.random(),
                
                success: function(html) {
             
               $("#lives").html(html);
                }
            })
        }, 20000);
	/* This code is executed after the DOM has been completely loaded */

	$('#fancyClock').tzineClock();

});
</script>
<?}else{?>
<script type="application/javascript">
$(document).ready(function(){
 setInterval(function() {
            $.ajax({
                type: "POST",
                url: "lives.php?v1=4&sid"+ Math.random(),
                
                success: function(html) {
             
               $("#lives").html(html);
                }
            })
        }, 20000);
	/* This code is executed after the DOM has been completely loaded */

	$('#fancyClock').tzineClock();

});
</script>
<?}?>



<script type="application/javascript">
$(document).ready(function(){
	$('#fancyClock').tzineClock();

});
</script>
<script type="text/javascript">
    function show() {
        $.ajax({
            url: "0clock.php",
            success: function(data) { $("#clock").html(data) }
        });
        setTimeout('show();', 2000);
    }
    $(document).ready(show());
</script>


<div class="desktop">
<div align="center" style="background-color:#121921;width:100%;height:35px;color:#6e8991;border-top: 1px solid #0f1318;direction:ltr;">
<table border="0" width="100%" cellpadding="0" dir="rtl">
		<tr>
<td height="35" width="15%" style="font-size:80%">&nbsp;<?php echo jdate("l"); ?>، <?php echo jdate("d F"); ?>، <?php echo jdate("Y"); ?></td>
<td height="35" width="10%"  style="direction:ltr;font-size:80%">&nbsp;<body><span id="clock"></span></body></td>
<td height="35" width="75%" > </td>
		</tr>
	</table>
	</div>     	</div>     

 


 

<div class="mobile"><center><br/>
<a href="live.php?where=lives" style="border:1px solid #ccc;border-radius:5px;padding: 0 5px 0 5px;"><img src="images/football.svg" width="20px" height="20px"></a>
<a href="live.php?where=livesbasket" style="border:1px solid #ccc;border-radius:5px;padding: 0 5px 0 5px;"><img src="images/basketball.svg" width="20px" height="20px"></a>
<a href="live.php?where=liveshockey" style="border:1px solid #ccc;border-radius:5px;padding: 0 5px 0 5px;"><img src="images/hockey.svg" width="20px" height="20px"></a>
</center></div>

 


		
		<div class="page-content">
		<div class="w100 page-area inline">
			<div class="left left-bar rear-bar-mobile mobile-left-menu">
				<div class="menu-container box-100000">
					<div class="clear"></div>
				</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				
<a href="javascript:;" class="title box-title-action mt5" data-box="box-100001"><span class="fa fa-caret-right"></span> ورزش ها</a>
<div class="menu-container box-100001">
<a href="live.php?where=lives" class="link">
<div class="left icon"><img src="images/soccerpng.png"></div>
<div class="left ml5">
<div class="left">فوتبال زنده</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</a>


<a href="live.php?where=livesbasket" class="link">
<div class="left icon"><img src="images/basketpng.png"></div>
<div class="left ml5">
<div class="left">بسکتبال زنده</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</a>
 

<a href="live.php?where=liveshockey" class="link">
<div class="left icon"><img src="images/icepng.png"></div>
<div class="left ml5">
<div class="left">هاکی زنده</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</a>

 
				</div>
			
			
			
				
		
  
			
			
			
			
			
			
 			 

				<div class="desktop">
									</div>

			</div>
			
			<div class="event-container left" style="margin-top: -5px;">
				
			
	 
				 

				
				

				
	<div style="direction:ltr;" id="lives">			
				

<?php $where1=$_REQUEST['where'];

if (empty($where1)){
 include("pages/lives.php"); }else{
   include("pages/$where1.php");   
     
 }
 
?>
				
		</div>		

				
				

			
						</div>
			<div class="left right-bar rear-bar-mobile mobile-right-menu">

				<div class="">
					<div class="title">فرم پیش بینی</div>
					<div class="slip-container" data="normal">

 
<?php if (tep_session_is_registered('user_id')) {  include("pages/column.php"); }else{  include("pages/column2.php");} ?>
 
 
						<div class="bets-container hidden">
						
							
							<div class="clear"></div>

							

					

						</div>


					</div>
				</div>

		 

			</div>
						
			<div class="clear"></div>

		</div>

	</div>


<script>$(document).ready(function() { bind_clicks(); });</script>

	<script>
		$("#search-box").keyup(function() {
			var v = $(this).val().toLowerCase();
			if(v.length<3) {
				$(".event-type").show();
				$(".event-row").show();
				return false;
			}
			$(".event-type").each(function() {
				if($(this).html().toLowerCase().indexOf(v)>-1) {
					if($(this).find(".title").html().toLowerCase().indexOf(v)>-1) {
						$(this).find(".event-row").show();
						$(this).show();
					} else {
						$(this).find(".event-row").each(function() {
							if($(this).html().toLowerCase().indexOf(v)>-1) $(this).show();
							else $(this).hide();
						});
					}
				}
				else $(this).hide();
			});
		});
	</script>
	

	
	<div class="footer desktop">
		<div class="inline container pr10">
			

		</div>
	</div>

	<div class="footer-links desktop">
		<div class="inline container pr10">
			<div class="left">
<img src="images/pmoney.png"><img src="images/btc.png">

 			</div>
			<div class="right">
<a href="https://tg.me/betboordir_official/" target="_blank"><img src="images/teleg.png"></a>
<a href="https://www.instagram.com/betboordir_official" target="_blank"><img src="images/inis.png"></a>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	
	
	<div class="mobile mobile-bar-holder"></div>
	<div class="mobile mobile-footer-bar">
<a href="index.php?where=soccer" class="sport active">پیش بینی</a>
<a href="live.php?where=lives" class="live ">پیش بینی زنده</a>
<a href="index.php?where=result" class="sport ">نتایج زنده  </a>
<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/payment/credit" class="scores "> افزایش موجودی</a>
<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>" class="casino ">کازینو </a>
<a href="http://table.<?php echo $_SERVER['SERVER_NAME']; ?>/users/profile" class="account ">حساب کاربری </a>
	</div>

	
	<div class="splash-view">
		<div class="splash-container">
			<div class="splash-header">
				<div class="left splash-title"><!--Title--></div>
				<div class="right"><span class="fa fa-times pointer splash-close-button"></span></div>
				<div class="clear"></div>
			</div>
			<div class="splash-content"><!--Content--></div>
		</div>
	</div>

	
</body>
</html>