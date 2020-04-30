<?php
if (AdminLogin::isAdminLoggedIn()) {

   $car = new Cars;

    if ($_POST['ok'] == 1) {
        
      $car->editPhotos($_GET['car_id'], $_POST, $_FILES);

      include 'show_car.php';

    } else {

        $carData = $car->getCarData($_GET['car_id']);
        $marka = strtoupper($carData['make']);
        $model = strtoupper($carData['model']);

        echo '
    <form enctype="multipart/form-data" action="index.php?action=admin&view=edit_photos&car_id='.$carData['id'].'" method="post">
    <input type="hidden" name="ok" value="1">
        <br>
        <div class="front-panel-header" style="margin-bottom: 20px;"><strong>EDYCJA ZDJĘĆ SAMOCHODU '.$marka.' '.$model.'</strong></div>';

        for($i=1; $i <= 8; $i++) {

            echo'
        <div class="car-list" style="display: block;">
            <img src="images/'.$i.'_.jpg"> ';
            if ($carData['foto_'.$i] != "" && file_exists('photos/'.$carData['id'].'/'.$carData['foto_'.$i])) {
                echo '
            <a href="includes/thumb_big.php?car_id='.$carData['id'].'&foto='.$carData['foto_'.$i].'"  rel="lightbox['.$carData['id'].']"><img class="u_foto" src="includes/thumb.php?car_id='.$carData['id'].'&foto='.$carData['foto_'.$i].'"></a><br>';
            } else {
                echo '
            <img src="images/no_foto.png"><br>';
            }
            if ($carData['foto_'.$i] != "" && file_exists('photos/'.$carData['id'].'/'.$carData['foto_'.$i])) {
                echo '
            <input type="checkbox" name="del_foto_'.$i.'" value="1" onclick="this.form.elements[\'foto_'.$i.'\'].disabled = this.checked"> <b>usuń lub ';
            }
            echo '<b>wybierz nowe zdjęcie:</b></b><br>
            <input type="file" name="foto_'.$i.'" class="input-panel"><br>
        </div>';

        }
        
         echo'
        <button type="submit" class="email_b">Zapisz zmiany</button>';
    }    
    echo '
    </form>';
}
?>