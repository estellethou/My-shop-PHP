<?php 
setcookie('username',"" , time() - 3600, '/'); 
setcookie('admin', "", time() - 3600, '/'); 
header('Location: signin.php');
?>