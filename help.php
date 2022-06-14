<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>پرداخت آنلاين</title>
<style>body{
direction:rtl;
font:14px yekan, tahoma, arial;
color:#000000;
    margin:0px;    background-image:url(images/bg111.jpg);

}
input[type="text"],input[type="password"],input[type="email"]{height:20px;padding:2px 5px;-webkit-transition:all 0.5s ease-out;-moz-transition:all 0.5s ease-out;-ms-transition:all 0.5s ease-out;transition:all 0.5s ease-out;border:1px solid #545454;border-radius:3px;background:#FFFFFF;color:#000000;}
.button { border:0px;
	margin:0px;
	background-color:#89C127;
	background-position:center top;
	color:#FFFFFF;
	cursor:pointer; 
	padding:0px;
	border-radius: 3px;
height:34px;
width:180px;
}

.button:hover {  border:0px;
	margin:0px;
	background-color:#619800;
	background-position:center top;
	color:#FFFFFF;
	cursor:pointer; 
	padding:0px;
	border-radius: 3px;
height:34px;
width:180px;
}


.button6 {  border:1px dotted #ccc;
font-size:13px;
	margin:0px;
	background-color:#E83700;
	background-position:center top;
	color:#FFFFFF;
	cursor:pointer; 
	padding:0px;
	border-radius: 3px;
height:34px;
width:180px;
}
.button6:hover {  border:0px;
	margin:0px;
	background-color:#B22A01;
	background-position:center top;
	color:#FFFFFF;
	cursor:pointer; 
	padding:0px;
	border-radius: 3px;
height:34px;
width:180px;
}

a {
	text-decoration:none;
	transition:0s;
	cursor:pointer;
	color:#FFFFFF;
}

a:hover {
	color:green;

}
</style></head>
<body>
    <? include'db.php';
    include'jdf.php';
    
        $shoma=$_POST['shoma'];
    $email=$_POST['email']; 
    $mobile=$_POST['mobile']; 
    $desc=$_POST['desc'];
    $amount=$_POST['amount2'];  
    $user=$_POST['user'];  


      ?>
     
       <div style="height:50px;width:100%;top:0px;background-color:#000000;color:#FFC000;"><br /><b>    راهنماي شارژ آفلاين  </b>  </div>
 


 	<hr style="margin-bottom: 25px;">
	<div style="font-size:14px;" align="center">
		پس از وارد کردن وجه در رسید، مبلغ را به شماره کارت ما از طریق دستگاه 
		عابر بانک و یا اینترنت بانک خود کارت به کارت کنید سپس ۴ رقم آخر کارت و 
		شماره پیگیری یا ارجاع را در صفحه پرداخت وارد کرده و سپس بر روی پرداخت 
		کرده ام کلیک کنید، و حساب کاربری شما بصورت اتوماتیک شارژ می شود .
		<p style="color: red;">توجه داشته باشید</p>
		<p style="color: red;">در صورت پرداخت از طریق دستگاه عابر بانک دقت کنید 
		شماره ای که در فرم وارد می کنید را در این عکس نمایش داده ایم</p>
		<p>
		<img src="images/help.jpg" style="max-width: 80%;"></p>
		<p>و شماره پیگیری یا ارجاع در فیش واریز با دستگاه عابر بانک در سیستم 
		خوانده نمی شود.</div>

</body>
</html>
 