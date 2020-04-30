<?php

class Cron {

   public function deactivateSold() {

      global $mysqli;
      global $settings_table;

      $result = $mysqli->query("SELECT * FROM cars WHERE sold='1'"); 
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

         $t_sold = $row['t_sold'];
         $deactivate_time = $settings_table['deactivate']*86400;
         $t_check = $t_sold + $deactivate_time;
         if ($now > $t_check && $row['active'] == 1) {

            $mysqli->query("UPDATE cars SET active='0', t_deactivated='$mtime' WHERE id='$row[id]'");
            
         }

      }

   }

   public function archiveSold() {

      global $mysqli;
      global $settings_table;

      $result = $mysqli->query("SELECT * FROM cars WHERE sold='1' && ACTIVE='0' && t_deactivated > '0'");
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

         $archive_time = $settings_table['archive']*86400;
         $t_check = $row['t_deactivated'] + $archive_time;
         if ($now > $t_check) {

            $mysqli->query("UPDATE cars SET archive='1', t_archive='$now' WHERE id='$linia[id]'");
            
         }

      }

   }

   public function unsetNew() {

      global $mysqli;

      $result = $mysqli->query("SELECT * FROM cars WHERE new='1' && active='1'");
      $all_new = $result->num_rows;
      if ($all_new > 0) {

         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

            $po_siedmiu_dniach = $row['t_added'] + 432000;

            if ($po_siedmiu_dniach < $now) {

               $mysqli->query("UPDATE cars SET new='0' WHERE id='$linia[id]'");
      
            }

         }
         
      }

   }

   public function sendEmails() {

      global $mysqli;
      global $settings_table;

      $week_day = date('w');
      if ($week_day == 4 || $week_day == 1) {

         $result = $mysqli->query("SELECT * FROM cars WHERE new='1' && active='1' ORDER BY id DESC LIMIT 0,1");
         $row = $result->fetch_array(MYSQLI_ASSOC);
         $all_new = $result->num_rows;

         if ($all_new > 0) {

            $result = $mysqli->query("SELECT * FROM mailing_sent WHERE id='1'");
            $mailing = $result->fetch_array(MYSQLI_ASSOC);

            $last_sent = $mailing['sent'];
            $next_sent = $mailing['next'];
            $day_sent = $mailing['day'];

            if ($row['t_added'] > $last_sent && $day_sent != $week_day) {

               $mysqli->query("UPDATE mailing_sent SET sent='$now', day='$week_day' WHERE id='1'");
               
               $result = $mysqli->query("SELECT email FROM email");
               $subject = "Powiadomienie o nowych samochodach w ofercie " . $settings_table['firma'];

               while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                  $subscriber = $row['email'];
                  $content = "Dostajesz ten email ponieważ wyraziłeś/aś chęć otrzymywania powiadomień o nowych samochodach pojawiających się w ofercie naszego komisu." . "\r\n" . "Aby obejrzeć pełną ofertę naszego komisu, kliknij w poniższy link lub skopij go i wklej do paska adresu swojej przegl±darki.\r\n\r\nhttp://" . $settings_table['strona'] . "?action=show_cars";                 
                  $content = $content . "\r\n\r\n\r\n Jeśli nie chcesz otrzymywać dalszych powiadomień z http://" . $settings_table['strona'] . ", kliknij w poniższy link aby się wyrejestrować.\r\n\r\nhttp://" . $settings_table['strona'] . "index.php?q=unsubscribe&email=" . $subscriber;
                  
                  mail($subscriber, $subject, $content, "From: MOTO-LUX <" . $settings_table['strona'] . ">\r\nContent-Type: text/plain; charset=UTF-8\r\n");

               }

            }

         }

      }
      
   }

}
?>