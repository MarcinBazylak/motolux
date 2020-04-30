<?php
if (AdminLogin::isAdminLoggedIn()) {

   $car = new Cars;

    if (($_POST['ok'])) {
        if ($_POST['marka'] != "" && $_POST['model'] != "" && $_POST['rok'] != "" && $_POST['przebieg'] != "" && $_POST['nadwozie'] != "" && $_POST['kolor'] != "" && $_POST['pojemnosc'] != "" && $_POST['moc'] != "" && $_POST['paliwo'] != "" && $_POST['cena'] != "") {
         
         $car_id = $car->addNew($_POST, $_FILES);        
         $carData = $car->getCarData($car_id);
         $carProperty = $car->convertData($carData);

         $km = $carData['power']*1.36;
         $km = round($km);
         $car_id = $carData['id'];
         $opis = nl2br($carData['descr']);         
         
         include 'show_car_info.php';     

        } else {
            $alert = 'Proszę wypełnić wszystkie pola.';
            displayAlert(0, $alert);
            include "admin/add_new_form.php";
        }
    } else {
        include "admin/add_new_form.php";
    }
}
?>