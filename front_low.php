<?php

$cars = new FrontPanel;
$result = $cars->getFrontPanelCars();

echo '
<div class="front-panel">
   <div class="front-panel-header">
      OSTATNIO DODANE
   </div>
   <div class="front-cars">';
foreach($result as $car) {    
    $km = round($car['power']*1.36);
    echo '
      <div class="front-single-car">
         <div class="front-single-car-photo">
               <a href="index.php?action=show_car&car_id='.$car['id'].'"><img class="u_foto_mid" src="includes/thumb_mid.php?car_id='.$car['id'].'&foto='.$car['foto_1'].'"></a>
         </div>
         <div class="front-single-car-text">
               <a href="index.php?action=show_car&car_id='.$car['id'].'"><b>'.$car['make'].' '.$car['model'].'</b></a><br>
               '.$car['ccm'].' cm<sup>3</sup>, '.$km.' KM<br>
               Przebieg: '.$car['mileage'].' km<br>Rok prod.: '.$car['year'].'<br>
               Cena: '.$car['price'].' zł.
         </div>
      </div>';
}
echo '
   </div>
</div>';
?>