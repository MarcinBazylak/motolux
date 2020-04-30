<?php
if (AdminLogin::isAdminLoggedIn()) {

   $car = new Cars;

   if (htmlspecialchars($_GET['q']) == 'deactivate') {

      $car->deactivate(htmlspecialchars($_GET['car_id']));

   }
   
   if (htmlspecialchars($_GET['q']) == 'activate') {

      $car->activate(htmlspecialchars($_GET['car_id']));

   }

   if (htmlspecialchars($_GET['q']) == 'sell') {
      
      $car->sell(htmlspecialchars($_GET['car_id']));

   }

   if (htmlspecialchars($_GET['q']) == 'delete') {

      $car->delete(htmlspecialchars($_GET['car_id']));

   }

   if ($_GET['sort'] == "") {
      $query = "SELECT * FROM cars WHERE archive='0' ORDER BY id DESC";
   }

   if ($_GET['sort'] == 1) {
      $query = "SELECT * FROM cars WHERE new='1' && archive='0' ORDER BY id DESC";
   }

   if ($_GET['sort'] == 2) {
      $query = "SELECT * FROM cars WHERE active='1' && archive='0' ORDER BY id DESC";
   }

   if ($_GET['sort'] == 3) {
      $query = "SELECT * FROM cars WHERE sold=1 && archive='0' ORDER BY id DESC";
   }

   if ($_GET['sort'] == 4) {
      $query = "SELECT * FROM cars WHERE archive='1' ORDER BY id DESC";
   }

   if ($_GET['sort'] == 5) {
      $query = "SELECT * FROM cars WHERE active='0' && archive='0' ORDER BY id DESC";
   }

   $result = $mysqli->query($query);

   echo '
      <br>
      <div class="front-panel-header"><strong>';
   if ($_GET['sort'] == 4) {
      echo 'ARCHIWUM SAMOCHODÓW';
   } else {
      echo 'LISTA SAMOCHODÓW';
   }
   echo'</strong></div>';

   if ($_GET['sort'] != 4) {
      include "admin/sort.php";
   }
      echo'
      <div class="show-car-full">';


   foreach($result as $row) {

      $carProperty = $car->convertData($row);

      echo '
         <div class="car-list">
               <div class="car-lis-text">
                  <a href="index.php?action=show_car&car_id='.$row['id'].'"><b>'.$row['make'].' '.$row['model'].',</b></a> Rok produkcji '.$row['year'].'. Nadwozie '.$carProperty['body'].'.<br>
                  <b>Silnik:</b> '.$row['ccm'].' '.$carProperty['fuel'].' '.$row['power'].' KW, <b>Skrzynia biegów</b> '.$carProperty['gearbox'].'.<br>
                  <b>Cena:</b> '.$row['price'].'.<br>
                  <img src="images/'.$row['new'].'.png"> <span class="f_'.$row['new'].'">Nowy</span> | <img src="images/'.$row['active'].'.png"> <span class="f_'.$row['active'].'">Aktywny</span> | <img src="images/'.$row['sold'].'.png"> <span class="f_'.$row['sold'].'">Sprzedany</span> | Oglądany '.$row['views'].' razy</td>
               </div>
               <div class="car-list-photo">';
      if (file_exists('photos/' . $row['id'] . '/1.jpg')) {
         echo '
                  <a href="index.php?action=show_car&car_id='.$row['id'].'"><img class="u_foto" src="includes/thumb_mid.php?car_id='.$row['id'].'&foto='.$row['foto_1'].'"></a>';
      } else {
         echo '
                  <img src="images/no_foto.jpg">';
      }
      echo '
               </div>
               <div style="padding: 10px;">
               <a href="index.php?action=admin&view=edit&car_id='.$row['id'].'">edytuj</a><br>';

      if ($row['active'] == 1) {
         echo '
                  <a href="index.php?action=admin&view=show_cars&q=deactivate&car_id='.$row['id'].'">deaktywuj</a><br>';
      } elseif ($row['archive'] == 0) {
         echo '
                  <a href="index.php?action=admin&view=show_cars&q=activate&car_id='.$row['id'].'">aktywuj</a><br>';
      }
      if ($row['sold'] == 0 && $row['archive'] == 0) {
         echo '
                  <a href="index.php?action=admin&view=show_cars&q=sell&car_id='.$row['id'].'">sprzedaj</a><br>';
      }
      echo '
                  <a href="index.php?action=show_car&q=delete&car_id='.$row['id'].'">usuń</a><br>';
      echo '
               </div>
         </div>';
   }
   echo '
      </div>';
}
?>