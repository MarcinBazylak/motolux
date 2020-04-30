<?php
if (AdminLogin::isAdminLoggedIn()) {
      echo '<div class="admin-menu">';
   if ($carData['active'] == 1) {
      echo '<a href="index.php?action=show_car&q=deactivate&car_id='.$carData['id'].'">DEAKTYWUJ</A> | ';
   } elseif ($carData['archive'] == 0) {
      echo '<a href="index.php?action=show_car&q=activate&car_id='.$carData['id'].'">AKTYWUJ</A> | ';
   }
   if ($carData['sold'] != 1 && $carData['archive'] == 0) {
      echo '<a href="index.php?action=show_car&q=sell&car_id='.$carData['id'].'">SPRZEDAJ</A> | ';
   }
      echo '<a href="index.php?action=admin&view=edit&car_id='.$carData['id'].'">EDYTUJ</A> | ';
      echo '<a href="index.php?action=admin&view=edit_photos&car_id='.$carData['id'].'">ZMIEŃ/DODAJ ZDJĘCIA</A> | ';
   if ($carData['archive'] == 0) {
      echo '<a href="index.php?action=show_car&q=archive&car_id='.$carData['id'].'">DO ARCHIWUM</A> | ';
   }
      echo '<a href="index.php?action=show_car&q=delete&car_id='.$carData['id'].'">USUŃ</A>
   </div>
   ';
}
?>