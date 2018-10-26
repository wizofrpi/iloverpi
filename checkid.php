session_start();

if(!isset($_SESSION['sessionid'])){

session_unset();
session_destroy();

header('location: message-login.php');

}else{
// session logged
}
