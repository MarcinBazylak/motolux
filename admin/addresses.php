<?php
if(AdminLogin::isAdminLoggedIn()) {

   if ($_GET['q'] == "del") {
      FrontPanel::unsubscribe(htmlspecialchars($_GET['id']));
   }

   echo '
      <br>
      <div class="front-panel-header" style="margin-bottom: 20px;"><strong>Baza adresów email</strong></div>
      <div class="admin-menu">
         <a href="index.php?action=admin&view=subscriptions">WYŚLIJ</a> | 
         <a href="index.php?action=admin&view=sent">WYSŁANE</a> | 
         <a href="index.php?action=admin&view=addresses">BAZA ADRESÓW</a>
      </div>';

   $result = $mysqli->query("SELECT * FROM email ORDER BY id ASC");

   while ($row = mysqli_fetch_array($result)) {
      echo '
      <div class="car-list" style="display: block;">
      <b>ID:</b> '.$row['id'].'<br>
      <b>Adres email:</b> '.$row['email'].'<br>
      <b>Data:</b> '.$row['data'].'<br>
      <a href="index.php?action=admin&view=addresses&q=del&id='.$row['email'].'">USUŃ</a>
      </div>';
   }
}
?>