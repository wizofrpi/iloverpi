<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Login For Site with Private Messaging</TITLE>
<meta name="description" content="Login For Site with Private Messaging">
<meta name="keywords" content="Login For Site with Private Messaging,Login Script,login,php,javascript, dhtml, DHTML">
<style type="text/css">
BODY {margin-left:0; margin-right:0; margin-top:0;text-align:left}
p, li {font:13px Verdana; color:black;text-align:left}
h1 {font:bold 28px Verdana; color:black;text-align:center}
h2 {font:bold 24px Verdana;text-align:center}
h3 {font:bold 15px Verdana;}
</style>
<script language="javascript">

function validatepassword(){

var ck_password = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
if (document.formpw.upassword.value.search(ck_password)==-1)
{alert("Please only enter letters, numbers and these for the password: !@#$%^&*()_");
document.formpw.upassword.focus();return false}

var ck_username = /^[A-Za-z0-9_]{6,20}$/;
if (document.formpw.username.value.search(ck_username)==-1)
{alert("Please only enter 6 to 20 letters, numbers and underline for the user name.");document.formpw.username.focus();
return false}

var ck_email = /^[A-Za-z0-9-_]+(\.[A-Za-z0-9-_]+)*@([A-Za-z0-9-_]+\.)?([A-Za-z0-9-_]+(\.[A-Za-z]{2,6})(\.[A-Za-z]{2})?)$/;
if (document.formpw.email.value.search(ck_email)==-1)
{alert("That email address is not valid. Try again.");document.formpw.email.focus();return false;}

return true;}

function validatepasswordlogin(){

var ck_password = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
if (document.formlogin.upasswordlogin.value.search(ck_password)==-1)
{alert("Please only enter letters, numbers and these for the password: !@#$%^&*()_");
document.formlogin.upasswordlogin.focus();return false}

var ck_username = /^[A-Za-z0-9_]{6,20}$/;
if (document.formlogin.uname.value.search(ck_username)==-1)
{alert("Please only enter 6 to 20 letters, numbers and underline for the user name.");document.formlogin.uname.focus();
return false}

return true;}

</script>

</head>
<body>

<?php
include_once"config.php";

function mix(){
global $upassword, $c;
$p = str_split($upassword);
foreach ($p as $h){$m .= md5($h);}
$c = hash('sha512',$m);
$c = substr($c, 0, 65);}

$sql = "CREATE TABLE IF NOT EXISTS messagemembers (
id int(4) NOT NULL auto_increment,
username varchar(20) NOT NULL,
upassword varchar(65) NOT NULL,
email varchar(65) NOT NULL,
ip varchar(65) NOT NULL,
date varchar(65) NOT NULL,
PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=1";

mysql_query($sql);

if(isset($_POST['register'])){
$U = $_POST['username'];
$L = $_POST['captcha'];if ($L<>"of"){
echo '<script language="javascript">alert("Please answer question."); window.location = "message-login.php"; </script>';

}else{$L="crapola";}

$U = strip_tags($U);
if (!preg_match("/[A-Za-z0-9_]{6,20}$/",$U)) {
echo '<script language="javascript">alert("Please enter 6 to 20 letters, numbers and underline for username."); window.location = "message-login.php"; </script>';}

$upassword = $_POST['upassword'];

if (strlen($upassword)<6 || strlen($upassword)>20) {
echo '<script language="javascript">alert("Please enter 6 to 20 characters for password."); window.location = "message-login.php"; </script>';}

$email = $_POST['email'];

$email = strip_tags($email);
$email = htmlspecialchars($email, ENT_QUOTES);
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
echo '<script language="javascript">alert("That email address is not valid."); window.location = "message-login.php"; </script>';}

$memip = $_SERVER['REMOTE_ADDR'];
$date = date("d-m-Y");
$checkformembers = mysql_query("SELECT * FROM messagemembers WHERE username = '$U'");
if(mysql_num_rows($checkformembers) != 0){echo '<script language="javascript">alert("Username already in use. Please try again.")</script>;';

}else{

mix();

if($L=="crapola"){
$create_member = mysql_query("INSERT INTO messagemembers (id, username, upassword, email, ip, date)
VALUES('','$U','$c','$email','$memip','$date')") or die(mysql_error());

$to = $email;
$subject = "Welcome to this Website!";
$message = "You've successfully registered as this Website member.\n\nYour user name is ".$U.".\n\nYou may now go to this Website.\n\nDon't give your password to anyone, but do save it somewhere safe.\n\nEnjoy this Website!\n\nRegards,\n\nthis Website management";
$headers = "From: ".$psbhostemailaddress."\r\nReply-To: ".$email;
$mail_sent = mail($to, $subject, $message, $headers);

$_SESSION['sessionid'] = session_id();
$_SESSION['username'] = $U;

mysql_close();

echo '<BR><BR><script language="javascript">alert("Thank you for registering.");window.location = "send-message-form.php";</script>';}}}

if(isset($_POST['login'])&&isset($_POST['uname'])&&isset($_POST['upasswordlogin'])){
$U = $_POST['uname'];
$P = $_POST['upasswordlogin'];$upassword=$P;mix();

$check_user_data = mysql_query("SELECT * FROM messagemembers WHERE username = '$U'") or die(mysql_error());
if(mysql_num_rows($check_user_data) == 0)
{echo '<script language="javascript">alert("This user name does not exist. Please try again.")</script>;';unset($U);unset($P);

}else{

$get_user_data = mysql_fetch_array($check_user_data);
$Z=$get_user_data['upassword'];

if($Z != $c || !isset($_POST['login']))
{echo '<script language="javascript">alert("Username/password pair is invalid. Please try again.")</script>;';unset($U);unset($P);

}else{

$_SESSION['sessionid'] = session_id();
$_SESSION['username'] = $U;

mysql_close();

echo '<script language="javascript">window.location = "send-message-form.php";</script>';}}}

?>

<h1>Login or Sign-up</h1>


<div id='pw' style='position:absolute;top:110px;left:600px;width:350px;border:4px solid blue;background-color:#8aa;'><table border='0' cellspacing=0 cellpadding=6><tr><th style='font-size:24;text-align:center'>Sign Up</th></tr>
<form id='formpw' name="formpw" method="post" action="message-login.php" onsubmit="return validatepassword()">
<tr><td><label for="User Name"><b>User Name: </b><input type="text" name="username" size="20" maxlength="20" value=""></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td><label for="Password"><b>Password: &nbsp;&nbsp;&nbsp;</b><input type="password" name="upassword" size="20" maxlength="20" value=""></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td><label for="Email"><b>Email: &nbsp;&nbsp;&nbsp;</b><input type="text" name="email" size="25" maxlength="65" value=""></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td><label for="Please answer question"><b>Please answer question: </b><input type="text" name="captcha" size="16" maxlength="16" value=""></label></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="login-question.png" WIDTH=295 HEIGHT=36 BORDER=0></td></tr>
<tr><td><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit" name="register">
<input type="reset" value="Reset"></form></td></tr></table>
</div>

<div id='login' style='position:absolute;top:110px;left:100px;width:350px;border:4px solid blue;background-color:#8aa;'><table border='0' cellspacing=0 cellpadding=6><tr><th style='font-size:24;text-align:center'>Login</th></tr>
<form id='formlogin' name="formlogin" method="post" action="message-login.php" onsubmit="return validatepasswordlogin()">
<tr><td><label for="User Name"><b>User Name: </b><input type="text" name="uname" size="20" maxlength="20" value=""></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td><label for="Password"><b>Password: &nbsp;&nbsp;&nbsp;</b><input type="password" name="upasswordlogin" size="20" maxlength="20" value=""></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit" name="login">
<input type="reset" value="Reset"></form></td></tr></table>
</div>

</body>
</html> 
