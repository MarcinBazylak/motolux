<?php

function displayAlert($type, $alert) {

   if($type == 0) {
      echo '<div class="red">' . $alert . '</div>';
   } else {
      echo '<div class="green">' . $alert . '</div>';
   }

}

function subscribe ($email) {

   global $mysqli;

   $result = $mysqli->query("SELECT email FROM email WHERE email='$email'");
   $email_exist = $result->num_rows;
   $data = date("d.m.Y G:i:s");

   if ($email_exist > 0) {

      $alert = 'Adres <b>' . $email . '</b> już istnieje w naszej bazie danych.';
      displayAlert(0, $alert);

   } else {

      $mysqli->query("INSERT INTO email VALUES ('', '$email', '$data')");

      $alert = 'Adres <b>"' . $email .'"</b> zostal dodany do naszej bazy danych. Od tej chwili będziesz regularnie powiadamiany o nowych samochodach dodawanych do naszej oferty.';
      displayAlert(1, $alert);
      
   }

}

function removeAddress($id) {

   global $mysqli;
   
   $mysqli->query("DELETE FROM email WHERE email='$id'");
   
   $alert = 'Adres <b>'.$id.'</b> Został usunięty.';
   displayAlert(1, $alert);

}
?>