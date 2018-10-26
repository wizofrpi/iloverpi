<?php
include_once"checkid.php";

$U=$_SESSION['username'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Form for Sending a Private Message</TITLE>
<meta name="description" content="Form for Sending a Private Message">
<meta name="keywords" content="Form for Sending a Private Message,Form for Submitting a Private Message,Send Message Form,Submit Message Form,Private Messaging,Private Message,php,javascript, dhtml, DHTML">
<script language="javascript">
mactest=(navigator.userAgent.indexOf("Mac")!=-1) //My browser sniffers
Netscape=(navigator.appName.indexOf("Netscape") != -1)
msafari=(navigator.userAgent.indexOf("Safari")!= -1)
wsafari=0; if(!mactest&&msafari){wsafari=1;msafari=0}
is_opera = 0; if(window.opera){is_opera=1}
is_ie_mac = 0; is_ie=0;if(document.all){is_ie=1}

function fixwidth(){if(Netscape||is_opera){e=document.getElementById('box');e.style.width='476px';e=document.getElementById('menu');e.style.width='116px';}}

function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit){field.value = field.value.substring(0, maxlimit);}
else{countfield.value = maxlimit - field.value.length;}}
</script>
<STYLE TYPE="text/css">
BODY {margin-left:0; margin-right:0; margin-top:0;text-align:left;background-color:#ccc}
p, li {font:13px Verdana; color:black;text-align:left}
h1 {font:bold 28px Verdana; color:black;text-align:center}
h2 {font:bold 24px Verdana;text-align:center}
h3 {font:bold 15px Verdana;}
#box {background-color:#eee;position:absolute;top:50px;left:250px;
width:500px;padding:10px;border:2px solid blue}
#menu {background-color:#eee;position:absolute;top:50px;left:0px;
width:130px;padding:5px;border:2px solid blue}
</STYLE>
</head>
<body onload="fixwidth()">
<h1>Form for Sending a Private Message (from <?php echo $U; ?>)</h1>
<div id='menu'>
<a HREF="send-message-form.php">Send Message</a><BR><BR>
<a HREF="message-inbox.php">Message Inbox</a><BR><BR>
<a HREF="message-outbox.php">Message Outbox</a><BR><BR>
<a HREF="message-delete-received.php">Delete Inbox<BR>Message</a><BR><BR>
<a HREF="message-delete-sent.php">Delete Outbox<BR>Message</a><BR><BR>
<a HREF="message-login.php">Login</a><BR><BR>
<a HREF="message-logout.php">Logout</a>
</div>
<div id='box'>
<form action="send-message.php" method="post" name="sendpm">
<table width='476'>
<tr>
<td width='120' align='right'>To Username</td>
<td width='356' align='left'>
<input type="text" name="touser" id="touser" size="35" maxlength="40">
</td>
</tr>
<tr>
<td width='120' align='right'>Subject</td>
<td width='356' align='left'>
<input type="text" name="subject" id="subject" size="35" maxlength="150">
</td>
</tr>
<tr>
<td width='120' align='right'>Message</td>
<td width='356' align='left'>
<textarea name="message" cols="35" rows="20" id="message" onKeyDown="textCounter(this.form.message,this.form.remLen,700)" onKeyUp="textCounter(this.form.message,this.form.remLen,700)"></textarea>
<input readonly type='text' name='remLen' size='3' maxlength='3' value="700"><br></td>
</tr>
<tr>
<td colspan="2">
<center><input type="submit" value="Send PM"></center>
</td>
</tr>
</table>
</form>
</div>
</body>
</html>
