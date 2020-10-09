<?php

class Settings {

   public static function getData() {

      global $mysqli;

      $result = $mysqli->query("SELECT * FROM settings");
      $row = $result->fetch_array(MYSQLI_ASSOC);
      return $row;

   }

}

?>