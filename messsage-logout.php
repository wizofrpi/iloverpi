<?php

include_once"checkid.php";

// message-logout.php

session_unset();
session_destroy();

echo '<script language="javascript">alert("See you soon!"); window.location = "message-login.php"; </script>';

?>
