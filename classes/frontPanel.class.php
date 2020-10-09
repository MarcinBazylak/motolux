<?php

   class FrontPanel {

      public function getFrontPanelCars() {
         
         global $mysqli;
         $result = $mysqli->query("SELECT * FROM cars WHERE foto_1 != '' && active = '1' && archive = '0' ORDER BY id DESC LIMIT 0,6");
         return $result;

      }

      public static function getWelcomeMessage() {

         global $mysqli;
         $result = $mysqli->query("SELECT * FROM mainpage");
         $row = $result->fetch_array(MYSQLI_ASSOC);
         return $row;

      }

      public static function unsubscribe($email) {

         global $mysqli;

         $mysqli->query("DELETE FROM email WHERE email='$email'");

         if($mysqli->affected_rows > 0) {

            $alert = 'Adres '.$email.' został usunięty z naszej bazy danych. Od tej chwili nie będziesz otrzymywać żadnych powiadomień.';
            displayAlert(1, $alert);

         } else {
         
            $alert = 'Adres '.$email.' nie został znaleziony w naszej bazie danych.';
            displayAlert(0, $alert);

         }

      }

      public static function enterStats() {

         global $mysqli;

         $site = $_SERVER['REQUEST_URI'];
         $referer = $_SERVER['HTTP_REFERER'];
         $ip = $_SERVER['REMOTE_ADDR'];
         $host = gethostbyaddr($ip);
         $tme = date("H:i:s");
         $date = date("d.m.Y");
         $mtime = time();

         $mysqli->query("INSERT INTO stats VALUES ('', '$date', '$tme', '$mtime', '$site', '$ip', '$host', '$referer')");

      }

   }
