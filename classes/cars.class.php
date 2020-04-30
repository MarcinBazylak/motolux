<?php

class Cars {

   public function getAllCars($sort) {

      global $mysqli;
      
      if ($sort == 2) {
         $query = "SELECT * FROM cars WHERE active= 1 && archive = 0 ORDER BY make ASC";
      } elseif ($sort == 3) {
         $query = "SELECT * FROM cars WHERE active= 1 && archive = 0 ORDER BY price ASC";
      } else {
         $query = "SELECT * FROM cars WHERE active= 1 && archive = 0 ORDER BY id DESC";
      }

      $result = $mysqli->query($query);
      return $result;

   }

   public function convertData($car) {

      if($car['body'] == 1) {
         $result['body'] = 'sedan';
      }
      if($car['body'] == 2) {
         $result['body'] = 'hatchback';
      }
      if($car['body'] == 3) {
         $result['body'] = 'kombi';
      }
      if($car['body'] == 4) {
         $result['body'] = 'cabrio';
      }
      if($car['body'] == 5) {
         $result['body'] = 'coupe';
      }
      if($car['body'] == 6) {
         $result['body'] = 'pick-up';
      }
      if($car['body'] == 7) {
         $result['body'] = 'van';
      }
      if($car['fuel'] == 3) {
         $result['fuel'] = 'diesel';
      }
      if($car['fuel'] == 2) {
         $result['fuel'] = 'benzyna + LPG';
      }
      if($car['fuel'] == 1) {
         $result['fuel'] = 'benzyna';
      }
   
      if($car['gearbox'] == 2) {
         $result['gearbox'] = 'automat';
      }
      if($car['gearbox'] == 1) {
         $result['gearbox'] = 'manual';
      }
      return $result;
   }

   public function getCarData($carId) {

      global $mysqli;

      $result = $mysqli->query("SELECT * FROM cars WHERE id=$carId");
      $row = $result->fetch_array(MYSQLI_ASSOC);

      $this->updateViews($carId, $row['views']);

      return $row;
            
   }

   private function updateViews($carId, $views) {

      global $mysqli;
      $views++;
      $mysqli->query("UPDATE cars SET views='$views' WHERE id=$carId");

   }

   public function edit($data) {

      global $mysqli;

      $data = array_map("htmlspecialchars", $data);
      $id = $data['car_id'];

      if(AdminLogin::isAdminLoggedIn()) {

         if ($data['ok'] == 1) {

            if ($data['marka'] != "" && $data['model'] != "" && $data['rok'] != "" && $data['przebieg'] != "" && $data['nadwozie'] != "" && $data['kolor'] != "" && $data['pojemnosc'] != "" && $data['moc'] != "" && $data['paliwo'] != "" && $data['cena'] != "") {
               $mysqli->query("UPDATE cars SET make='$data[marka]', model='$data[model]', type='$data[typ]', year='$data[rok]', mileage='$data[przebieg]', body='$data[nadwozie]', color='$data[kolor]',  ccm='$data[pojemnosc]', power='$data[moc]', fuel='$data[paliwo]', gearbox='$data[skrzynia]', awd='$data[awd]', alarm='$data[autoalarm]', el_mirr='$data[lusterka]', heat_mirr='$data[podgrzewane]',  immo='$data[immobiliser]', tc='$data[kontrola]', park='$data[parktronic]', xenon='$data[reflektory]', tempo='$data[tempomat]', abs='$data[abs]', block='$data[blokada]',  webasto='$data[webasto]', el_windows='$data[szyby]', ac='$data[klimatyzacja]', airbag='$data[poduszki]', leather='$data[skorzana]', power_steering='$data[wspomaganie]', aloys='$data[aluminiowe]',  central='$data[centralny]', hook='$data[hak]', computer='$data[komputer]', navi='$data[navigacja]', radio='$data[radio]', sunroof='$data[szyberdach]', price='$data[cena]', descr='$data[opis]' WHERE id=$id");
                  
               $result = $mysqli->query("SELECT * FROM cars WHERE id='$id'");
               $row = $result->fetch_array(MYSQLI_ASSOC);
      
               $alert = 'Dane samochodu <b>'.$row['make'].' '.$row['model'].'</b> Zostały zmienione.';
               displayAlert(1, $alert);
            } else {
               $alert = 'PROSZĘ WYPEŁNIĆ WSZYSTKIE POLA !';
               displayAlert(0, $alert);
            }
         }

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function editPhotos($id, $data, $photos) {

      global $mysqli;

      if(AdminLogin::isAdminLoggedIn()) {

         $result = $mysqli->query("SELECT * FROM cars WHERE id='$id'");
         $carExist = $result->num_rows;

         if($carExist > 0) {
            for($j=1; $j <= 8; $j++) {
               $file = 'photos/' . $id . '/' . $j . '.jpg';
               if ($data['del_foto_' . $j] == 1) {
                  $mysqli->query("UPDATE cars SET foto_" . $j . "='' WHERE id='" . $id . "'");
                  if (file_exists($file)) {
                     unlink($file);
                  }
               } else {
                  if ($photos['foto_'.$j]['name'] != "") {
                     if (file_exists($file)) {
                        unlink($file);
                     }
                     $mysqli->query("UPDATE cars SET foto_".$j."='".$j.".jpg' WHERE id='$id'");
                     $tmp_name = $photos['foto_'.$j]['tmp_name'];
                     $name = $j.'.jpg';
                     move_uploaded_file($tmp_name, 'photos/'.$id.'/'.$name);
                     chmod('photos/'.$id.'/'.$name, 0600);
                  }
               }
            }

            $alert = 'Zdjęcia samochodu <b>'.$linia['make'].' '.$linia['model'].'</b> Zostały zmienione.';
            displayAlert(1, $alert);

         } else {

            $alert = 'Błędny identyfikator.';
            displayAlert(0, $alert);

         }

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function activate($id) {

      global $mysqli;
      $mtime = time();

      if (AdminLogin::isAdminLoggedIn()) {
         
         $mysqli->query("UPDATE cars SET active = '1', t_deactivated = '0', t_sold = '$mtime' WHERE id='$id'");

         $alert = 'Samochód został aktywowany.';
         displayAlert(1, $alert);

     } else {

      $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
      displayAlert(0, $alert);

      }

   }

   public function deactivate($id) {

      global $mysqli;
      $mtime = time();

      if (AdminLogin::isAdminLoggedIn()) {

         $mysqli->query("UPDATE cars SET active = '0', t_deactivated='$mtime' WHERE id='$id'");
         
         $alert = 'Samochód został dezaktywowany.';
         displayAlert(1, $alert);

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);
   
     }

   }

   public function sell($id) {

      global $mysqli;

      if (AdminLogin::isAdminLoggedIn()) {

      $mysqli->query("UPDATE cars SET sold = '1', t_sold='$mtime' WHERE id='$id'");

      $alert = 'Samochód został oznaczony jako sprzedany.';
      displayAlert(1, $alert);

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function archive($id) {

      global $mysqli;

      if (AdminLogin::isAdminLoggedIn()) {
                  
         $mysqli->query("UPDATE cars SET archive='1', t_archive='$mtime', active='0', t_deactivated='$mtime' WHERE id='$_GET[car_id]'");
                    
         $alert = 'Samochód został przeniesiony do archiwum.';
         displayAlert(0, $alert);

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function addNew($data, $photos) {

      global $mysqli;

      if (AdminLogin::isAdminLoggedIn()) {

         $data = array_map("htmlspecialchars", $data);

         $date = date("d.m.Y");
         $mtime = time();
         $opis = $data['opis'];
         $mysqli->query("INSERT INTO cars VALUES ('', '0', '', '0', '', '0', '', '1', '$date', '$mtime', '0',  '$data[marka]', '$data[model]', '$data[typ]', '$data[rok]', '$data[przebieg]', '$data[nadwozie]', '$data[kolor]',  '$data[pojemnosc]', '$data[moc]', '$data[paliwo]', '$data[skrzynia]', '$data[awd]', '$data[autoalarm]', '$data[lusterka]', '$data[podgrzewane]',  '$data[immobiliser]', '$data[kontrola]', '$data[parktronic]', '$data[reflektory]', '$data[tempomat]', '$data[abs]', '$data[blokada]',  '$data[webasto]', '$data[szyby]', '$data[klimatyzacja]', '$data[poduszki]', '$data[skorzana]', '$data[wspomaganie]', '$data[aluminiowe]',  '$data[centralny]', '$data[hak]', '$data[komputer]', '$data[navigacja]', '$data[radio]', '$data[szyberdach]', '1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '$data[cena]', '$opis')");

         $result = $mysqli->query("SELECT id FROM cars ORDER BY id DESC LIMIT 0,1");
         $row = $result->fetch_array(MYSQLI_ASSOC);
         $car_id = $row['id'];

         $uploads_dir = 'photos/' . $car_id;
         mkdir($uploads_dir, 0777);

         for ($i = 1; $i <= 8; $i++){

            if ($photos['foto_'.$i]['name'] != "") {
               $tmp_name = $photos['foto_'.$i]['tmp_name'];
               $name = $i.'.jpg';
               move_uploaded_file($tmp_name, $uploads_dir.'/'.$name);
               chmod($uploads_dir.'/'.$name, 0600);
            }

         }

         $alert = 'Samochód '.$data['marka'].' '.$data['model'].' został dodany do bazy danych.';
         displayAlert(1, $alert);
         return $car_id;

      } else {

         $alert = 'Nie posiadasz uprawnień do wykonania tej operacji.';
         displayAlert(0, $alert);

      }

   }

   public function delete($id) {

      global $mysqli;

      if (AdminLogin::isAdminLoggedIn()) {

         $mysqli->query("DELETE FROM cars WHERE id='$id'");
            
         for($i=1; $i <= 8; $i++){
            $file = 'photos/'.$id.'/'.$i.'.jpg';
            if (file_exists($file)) {
               unlink($file);
            }
         }   
         rmdir('photos/'.$id);
      
         $alert = 'Samochód został usunięty.';
         displayAlert(1, $alert);

      }

   }

}

?>