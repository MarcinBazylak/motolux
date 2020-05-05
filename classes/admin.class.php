<?php

class Admin {

   private $subject;
   private $content;
   private $subList;
   private $domain;

   public static function sendEmailToSubscribers($data) {

      global $mysqli;

      if(AdminLogin::isAdminLoggedIn()) {
         $subject = strip_tags($data['temat']);
         $content = strip_tags($data['tresc']);

         if (!empty($subject) && !empty($content)) {
            $date = date("d.m.Y G:i:s");
            $mtime = time();
            $domain = GetSettings::getData();
            $domain = $domain['strona'];
            $mysqli->query("INSERT INTO subscriptions VALUES ('', '$subject', '$content', '$mtime', '$date')");
            
            $subscribers = self::getSubscribersList();
            foreach($subscribers as $subscriber) {
               $content = $content . "\r\n\r\n\r\n Jeśli nie chcesz otrzymywać dalszych powiadomień z http://".$domain.", kliknij w poniższy link aby się wyrejestrować.\r\n\r\nhttp://".$domain."index.php?q=unsubscribe&email=" . $subscriber;
               mail($subscriber, $subject, $content, "From: MOTO-LUX <" . $domain . ">\r\nContent-Type: text/plain; charset=UTF-8\r\n");
            }

            $alert = 'Email został poprawnie wysłany.';
            displayAlert(1, $alert);

         } else {

            $alert =  'Pole temat oraz treść nie może być puste.';
            displayAlert(0, $alert);

         }
      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   private function getSubscribersList() {

      global $mysqli;
      $result = $mysqli->query("SELECT email FROM email");
      while($row = $result->fetch_array()) {
         $subList[] = $row['email'];
      }
      return $subList;
   }

   public function setMainPage($data) {

      global $mysqli;

      if(AdminLogin::isAdminLoggedIn()) {

         $mysqli->query("UPDATE mainpage SET subskrypcja='$data[subskrypcja]', opis='$data[opis]' WHERE id=1");
         
         $alert = 'Opis na stronie głównej został zaktualizowany.';
         displayAlert(1, $alert);

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function getCarsStats() {

      global $mysqli;

      if(AdminLogin::isAdminLoggedIn()) {

         $result = $mysqli->query("SELECT id FROM cars");
         $all_cars   = $result->num_rows;
         
         $result = $mysqli->query("SELECT id FROM cars WHERE active='1'");
         $active_cars = $result->num_rows;
         
         $result = $mysqli->query("SELECT id FROM cars WHERE active='0'");
         $inactive_cars = $result->num_rows;
         
         $result = $mysqli->query("SELECT id FROM cars WHERE archive='1'");
         $archived_cars = $result->num_rows;
         
         $result = $mysqli->query("SELECT * FROM cars ORDER BY id DESC LIMIT 0,1");
         $row = $result->fetch_array(MYSQLI_ASSOC);
         $last_added = $row['id'];
         
         $result = $mysqli->query("SELECT id FROM cars WHERE sold='1'");
         $sold_cars  = $result->num_rows;

         $result = [
            'all_cars' => $all_cars,
            'active_cars' => $active_cars,
            'inactive_cars' => $inactive_cars,
            'archived_cars' => $archived_cars,
            'last_added' => $row,
            'sold_cars' => $sold_cars
         ];

         return $result;

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function getSettings() {

      global $mysqli;

      if(AdminLogin::isAdminLoggedIn()) {

         $result = $mysqli->query("SELECT * FROM settings WHERE id='1'");
         $row = $result->fetch_array(MYSQLI_ASSOC);
         return $row;

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function setAutomatics($data) {

      global $mysqli;

      if(AdminLogin::isAdminLoggedIn()) {

         if ($data['deactivation'] > 0) {
            $deact = $data['deactivation'];
         }
         
         if ($data['archive'] > 0) {
            $arch = $data['archive'];
         }
         
         $mysqli->query("UPDATE settings SET deactivate='$deact', archive='$arch' WHERE id='1'");
         
         $alert = 'Zmiany zostały pomyślnie zapisane.';
         displayAlert(1, $alert);

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function changeLogo($data) {

      if(AdminLogin::isAdminLoggedIn()) {

         if ($data['top']['name'] != "") {
            $tmp_name = $data['top']['tmp_name'];
            
            $img    = imagecreatefromjpeg("$tmp_name");
            $width  = imagesx($img);
            $height = imagesy($img);
            
            if ($width == "1000" && $height == "150") {
               if (file_exists("images/a/top.jpg")) {
                  chmod("images/a/top.jpg", 0775);
                  unlink("images/a/top.jpg");
               }
               move_uploaded_file($tmp_name, "images/a/top.jpg");
               chmod("images/a/top.jpg", 0600);
               
               $alert = 'Plik został poprawnie wczytany.';
               displayAlert(1, $alert);
               
            } else {

               $alert = 'Wymiary obrazka powinny wynosić 1000 x 150 pikseli. Obrazek nie został wczytany';
               displayAlert(0, $alert);

            }
         }

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }
   }

   public function changePassword($data) {

      global $mysqli;

      if(AdminLogin::isAdminLoggedIn()) {

         $result = $mysqli->query("SELECT * FROM login");
         $row = $result->fetch_array(MYSQLI_ASSOC);
         
         if ($row['pass'] == md5($data['old_pass'])) {

            if ($data['new_pass'] == $data['new_pass_2']) {

               $new_pass = md5($data['new_pass']);
               $mysqli->query("UPDATE login SET pass='$new_pass' WHERE id='1'");
               
               $alert = 'Hasło zostało pomyślnie zmienone.';
               displayAlert(1, $alert);

               } else {

                  $alert = 'Nowe hasła, które podałeś nie są jednakowe.';
                  displayAlert(0, $alert);

               }

         } else {

               $alert = 'Stare hasło, które podałeś jest nieprawidłowe.';
               displayAlert(0, $alert);

         }

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function updateSettings($data) {

      global $mysqli;

      if(AdminLogin::isAdminLoggedIn()) {

         $mysqli->query("UPDATE settings SET firma='$data[firma]', strona='$data[strona]', email='$data[email]', adres='$data[adres]', kod='$data[kod]', miasto='$data[miasto]', telefon='$data[telefon]', godziny='$data[godziny]', mapa='$data[mapa]' WHERE id='1'");
        
         $alert = 'Ustawienia zostały pomyślnie zmienone.';
         displayAlert(1, $alert);

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

}
?>