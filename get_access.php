<?php
session_start();
include 'includes/db.php';
include 'classes/login.class.php';

if ($_POST['submit']) {

   AdminLogin::getAccess($_POST);

} else {

   mysqli_close($link);
   header("Location: index.php?action=admin");

}

?>