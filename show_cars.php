<?php

$cars = new Cars();
$carsData = $cars->getAllCars($_POST['sort']);

echo '
    <div class="show-car-full">
      <div class="show-car-header">
        AKTUALNIE W NASZEJ OFERCIE
      </div>
      <form enctype="multipart/form-data" action="index.php?action=show_cars" method="post">
        <div style="padding: 10px;">
          Sortuj według: 
          <select length="20" name="sort" class="input-panel" onChange="this.form.submit()">
	          <option value="1"';
if ($_POST['sort'] == 1) {
echo ' selected';
}

echo '>daty dodania</option>
            <option value="2"';
if ($_POST['sort'] == 2) {
echo ' selected';
}
echo '>marki</option>
	          <option value="3"';
if ($_POST['sort'] == 3) {
echo ' selected';
}
echo '>ceny</option>
          </select>
        </div>
      </form>';

foreach($carsData as $car) {
	
	$km = $car['power']*1.36;
	$km = round($km);

	$carProperty = $cars->convertData($car);

  echo '
  <a class="car-line" href="index.php?action=show_car&car_id='.$car['id'].'">
	  <div class="car-list">
	    <div class="car-list-text">';
	if ($car['new'] == 1) {
    echo '
        <img src="images/nowosc.gif">&nbsp;&nbsp;';
		}
    echo '
        <b>'.$car['make'].' '.$car['model'].', rok produkcji '.$car['year'].'.
		<br>Cena: '.$car['price'].' zł.</b></br>
		'.$car['ccm'].' cm<sup>3</sup>, '.$carProperty['fuel'].', '.$car['power'].' KW <b>('.$km.' KM)</b>. Skrzynia biegów '.$carProperty['gearbox'].'.<br>
		Nadwozie '.$carProperty['body'].'. kolor '.$car['color'].'.<br>Przebieg '.$car['mileage'].' km.';
		
		if($car['sold'] == 1) {
      echo'
          <span style="font-weight: 800; color: red;"><BR>SPRZEDANY</SPAN>';
		}
	echo'
	    </div>
	    <div class="car-list-photo">';
	
	if (file_exists('photos/' . $car['id'] . '/1.jpg')) {
    echo '
        <img class="u_foto" src="includes/thumb_mid.php?car_id='.$car['id'].'&foto='.$car['foto_1'].'">';
		} else {
    echo '
        <img class="u_foto" src="images/no_foto.png">';
		}

echo '
      </div>
    </div></a>';
}
echo '
  </div>';
?>