<?php
if(AdminLogin::isAdminLoggedIn()) {
   echo '
   <br>
   <div class="front-panel-header" style="margin-bottom: 20px;"><strong>Wiadomości wysłane</strong></div>
   <div class="admin-menu">
      <a href="index.php?action=admin&view=subscriptions">WYŚLIJ</a> | 
      <a href="index.php?action=admin&view=sent">WYSŁANE</a> | 
      <a href="index.php?action=admin&view=addresses">BAZA ADRESÓW</a>
   </div>';

   $result = $mysqli->query("SELECT * FROM subscriptions ORDER BY id DESC");
   

   while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

      if (strlen($row['temat']) > 50) {
         $temat = substr($row['temat'],0,50)."...";
      } else {
         $temat = $row['temat'];
      }

      echo '
   <div class="car-list" style="display: block;">
      <b>ID:</b> '.$row['id'].'<br>
      <b>Data:</b> '.$row['date'].'<br>
      <b>Temat:</b> '.$temat.'<br>
      <b>Treść wiadomości:</b><br>
      '.$row['tresc'].'
   </div>';
   }
}
?>