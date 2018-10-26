<?php

include_once"checkid.php";

include('config.php');

// message-inbox.php

$touser = $_SESSION['username'];

$clickedid = $_POST['clickedid'];
if (isset($clickedid)){$sql = mysql_query("UPDATE privatemessages SET readit=(IF(readit='0','1','0')) WHERE id='$clickedid'");unset($clickedid);} //uses MySQL "IF()" function

$sql = mysql_query("SELECT * FROM privatemessages WHERE touser = '$touser' AND deleted = '0' ORDER BY datesent DESC");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Private Message Inbox</TITLE>
<meta name="description" content="Private Message Inbox">
<meta name="keywords" content="Private Message Inbox,Private Messaging,Private Message,php,javascript, dhtml, DHTML">
<script language="javascript">
mactest=(navigator.userAgent.indexOf("Mac")!=-1) //My browser sniffers
Netscape=(navigator.appName.indexOf("Netscape") != -1)
msafari=(navigator.userAgent.indexOf("Safari")!= -1)
wsafari=0; if(!mactest&&msafari){wsafari=1;msafari=0}
is_opera = 0; if(window.opera){is_opera=1}
is_ie_mac = 0; is_ie=0;if(document.all){is_ie=1}

function fixwidth(){if(Netscape||is_opera){e=document.getElementById('box');e.style.width='826px';e=document.getElementById('menu');e.style.width='116px';}}

function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit){field.value = field.value.substring(0, maxlimit);}
else{countfield.value = maxlimit - field.value.length;}}

var clicked=0;

function readit(){
document.MyForm.clickedid.value=clicked;
document.MyForm.submit();}
</script>
<STYLE TYPE="text/css">
BODY {margin-left:0; margin-right:0; margin-top:0;text-align:left;background-color:#ccc}
p, li {font:13px Verdana; color:black;text-align:left}
h1 {font:bold 28px Verdana; color:black;text-align:center}
h2 {font:bold 24px Verdana;text-align:center}
h3 {font:bold 15px Verdana;}
#box {background-color:#eee;position:absolute;top:50px;left:150px;
width:850px;padding:10px;border:2px solid blue}
#table1 {width:100%;border:1px solid blue;text-align:center}
#menu {background-color:#eee;position:absolute;top:50px;left:0px;
width:130px;padding:5px;border:2px solid blue}
</STYLE>
</head>
<body onload="fixwidth()">
<h1>Private Message Inbox</h1>
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

<table id='table1' border='1'>
<caption><b>Messages to: <?php echo $touser; ?></b> — (Click "NOT READ/READ" button to toggle indicator.)</caption>

<tr><th>From</th><th>Subject</th><th>Date</th>
<th>Status</th><th>Message</th></tr>

<?php

while($rows=mysql_fetch_array($sql)){

if($rows['readit']=="0"){$read="notread.gif";}else{$read="read.gif";}

$sent=stripslashes($rows['datesent']);

$id=$rows['id'];
echo "<tr><td>".htmlentities(stripslashes($rows['fromuser']), ENT_QUOTES)."</td>";
echo "<td>".htmlentities(stripslashes($rows['subject']), ENT_QUOTES)."</td>";
echo "<td>".date('Y/m/d',$sent)."</td>";
echo "<td><a href='#' onclick='clicked=".$id.",readit()'><img src='".$read."'></a></td>";
echo "<td>".htmlentities(stripslashes($rows['message']), ENT_QUOTES)."</td></tr>";
}

mysql_close();

?>

</table>

<form name="MyForm" method="POST" action="message-inbox.php">
<input type="hidden" name="clickedid" value=" ">
</form>

</body>
</html>
