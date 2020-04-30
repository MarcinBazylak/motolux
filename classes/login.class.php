<?php
Class AdminLogin {

   private static $login;
   private static $password;

   public static function getAccess($data) {

      global $link;
      self::$login = htmlspecialchars($data['name']);
      self::$password = htmlspecialchars($data['password']);
      
      $query="SELECT * FROM login";
      $result=mysqli_query($link, $query);
      $row=mysqli_fetch_array($result);

      if (self::$login == $row['login'] && md5(self::$password) == $row['pass']) {
         $_SESSION['logged_in'] = true;
         mysqli_close($link);
         header("Location: index.php?action=admin");
      } else {
         mysqli_close($link);
         header("Location: index.php?ev=invalid_login_details");
      }
   }

   public static function logOff() {

      unset($_SESSION['logged_in']);
      header("Location: index.php");

   }

   public static function isAdminLoggedIn() {

      if($_SESSION['logged_in']) {
         return true;
      } else {
         return false;
      }

   }

}
?>