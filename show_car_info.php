<?php

echo'
    <div class="show-car-full">
        <div class="show-car-header">
            <b>'.$carData['make'].' '.$carData['model'].' '.$carData['year'].' r.
            <br>Cena ' . $carData['price'].  ' zł.';
            if ($carData['sold'] == 1) {
                echo '<br><span style="color:red;"> SPRZEDANY</span>';
            }
            echo '</b>
        </div>
        ';
        if(AdminLogin::isAdminLoggedIn()) {
           include 'admin/car_menu.php';
        }
         echo '
        <div class="show-car-body">
           <div class="box show-car-photos">
                <div class="show-car-header">
                    GALERIA
                </div>
                <div class="show-car-photos-body">';

for ($i=1; $i<=8; $i++) {
    if (file_exists('photos/'.$car_id.'/'.$i.'.jpg')) {
        echo '<a href="includes/thumb_big.php?car_id='.$car_id.'&foto='.$i.'.jpg"  data-lightbox="'.$car_id.'"><img class="u_foto" src="includes/thumb.php?car_id='.$car_id.'&foto='.$i.'.jpg"></a>';
    }
}

echo '
                </div>
            </div>

            <div class="box tech-data">
                <div class="show-car-header">
                    DANE TECHNICZNE
                </div>
                <div class="box-inside">

                  Dodano '.$carData['added'].'.<br>

                  '.$carData['make'].' '.$carData['model'].', '.$carData['year'].' r.<br>
                  '.$carData['type'].'<br>

                  <b>Przebieg:</b><br>
                  '.$carData['mileage'].' km.<br>

                  <b>Silnik:</b><br>
                     '.$carData['ccm'].' cm<sup>3</sup>, '.$carData['power'].' KW <b>('.$km.') KM</b><br>

                  <b>Rodzaj paliwa:</b><br>
                  '.$carProperty['fuel'].'<br>

                  <b>Skrzynia biegów:</b><br>
                  '.$carProperty['gearbox'].'<br>

                  <b>Nadwozie:</b><br>
                  '.$carProperty['body'].', kolor '.$carData['color'].'

                </div>
            </div>

            <div class="box comfort">
                <div class="show-car-header">
                    WYPOSAŻENIE
                </div>
            <div class="box-inside">
                <table width="100%" align="left" cellpadding="0" cellspacing="0">
                    <tr><td colspan="2" class="space"></td></tr>
                    <tr>
                      <td class="dane_'.$carData['abs'].'">
                        <img src="images/'.$carData['abs'].'.png"> ABS
                      </td>
                      <td class="dane_'.$carData['awd'].'">
                        <img src="images/'.$carData['awd'].'.png"> Napęd na 4 koła
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['aloys'].'">
                        <img src="images/'.$carData['aloys'].'.png"> Aluminiowe felgi
                      </td>
                      <td class="dane_'.$carData['navi'].'">
                        <img src="images/'.$carData['navi'].'.png"> Nawigacja GPS
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['alarm'].'">
                        <img src="images/'.$carData['alarm'].'.png"> Autoalarm
                      </td>
                      <td class="dane_'.$carData['park'].'">
                        <img src="images/'.$carData['park'].'.png"> Parktronik
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['block'].'">
                        <img src="images/'.$carData['block'].'.png"> Blokada skrzyni biegów
                      </td>
                      <td class="dane_'.$carData['heat_mirr'].'">
                        <img src="images/'.$carData['heat_mirr'].'.png"> Podgrzewane lusterka
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['central'].'">
                        <img src="images/'.$carData['central'].'.png"> Centralny zamek
                      </td>
                      <td class="dane_'.$carData['airbag'].'">
                        <img src="images/'.$carData['airbag'].'.png"> Poduszki powietrzne
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['el_mirr'].'">
                        <img src="images/'.$carData['el_mirr'].'.png"> Elektryczne lusterka
                      </td>
                      <td class="dane_'.$carData['radio'].'">
                        <img src="images/'.$carData['radio'].'.png"> Radio / CD
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['el_windows'].'">
                        <img src="images/'.$carData['el_windows'].'.png"> Elektryczne szyby
                      </td>
                      <td class="dane_'.$carData['leather'].'">
                        <img src="images/'.$carData['leather'].'.png"> Skórzana tapicerka
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['hook'].'">
                        <img src="images/'.$carData['hook'].'.png"> Hak holowniczy
                      </td>
                      <td class="dane_'.$carData['sunroof'].'">
                        <img src="images/'.$carData['sunroof'].'.png"> Szyberdach
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['immo'].'">
                        <img src="images/'.$carData['immo'].'.png"> Immobiliser
                      </td>
                      <td class="dane_'.$carData['tempo'].'">
                        <img src="images/'.$carData['tempo'].'.png"> Tempomat
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['ac'].'">
                        <img src="images/'.$carData['ac'].'.png"> Klimatyzacja
                      </td>
                      <td class="dane_'.$carData['webasto'].'">
                        <img src="images/'.$carData['webasto'].'.png"> Webasto
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['computer'].'">
                        <img src="images/'.$carData['computer'].'.png"> Komputer pokładowy
                      </td>
                      <td class="dane_'.$carData['power_steering'].'">
                        <img src="images/'.$carData['power_steering'].'.png"> Wspomagainie kierownicy
                      </td>
                    </tr>
                    <tr>
                      <td class="dane_'.$carData['tc'].'">
                        <img src="images/'.$carData['tc'].'.png"> Kontrola trakcji
                      </td>
                      <td class="dane_'.$carData['xenon'].'">
                        <img src="images/'.$carData['xenon'].'.png"> Xenonowe reflektory
                      </td>
                    </tr>
                    <tr><td class="space"></td></tr>
                </table>
            </div>
        </div>

        <div class="box description">
            <div class="show-car-header">
                DODATKOWY OPIS
            </div>
            <div class="box-inside">
                '.$opis.'
            </div>
        </div>
    </div>';

?>