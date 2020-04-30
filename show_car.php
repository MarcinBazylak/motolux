<?php

$car = new Cars;
$carData = $car->getCarData(htmlspecialchars($_GET['car_id']));

if (htmlspecialchars($_GET['q']) == 'delete') {
   $alert = '
        <center>
            Czy na pewno chcesz trwale usunąć <b>'.$carData['make'].' '.$carData['model'].'</b> z bazy danych ?
            <br>
            <a href="index.php?action=show_car&car_id='.$carData['id'].'">
                <button class="button-green" type="button">NIE</button>
            </a>
            <a href="index.php?action=admin&view=show_cars&q=delete&car_id='.$carData['id'].'">
                <button class="button-red" type="button">TAK</button>
            </a>
        </center>';
   displayAlert(1, $alert);    
}

if (htmlspecialchars($_GET['q']) == 'edit') {

   $car->edit($_POST);

}

if (htmlspecialchars($_GET['q']) == 'activate') {

   $car->activate(htmlspecialchars($_GET['car_id']));

}

if (htmlspecialchars($_GET['q']) == "deactivate") {

   $car->deactivate(htmlspecialchars($_GET['car_id']));

}

if (htmlspecialchars($_GET['q']) == "sell") {
   
   $car->sell(htmlspecialchars($_GET['car_id']));

}


$carData = $car->getCarData(htmlspecialchars($_GET['car_id']));

$km = $carData['power']*1.36;
$km = round($km);
$car_id = $carData['id'];
$opis = nl2br($carData['descr']);

$carProperty = $car->convertData($carData);

include 'show_car_info.php';

?>