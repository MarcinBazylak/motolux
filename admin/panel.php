<?php
if (AdminLogin::isAdminLoggedIn()) {

   $admin = new Admin;

   $stat = $admin->getCarsStats();

   $all_cars = $stat['all_cars'];
   $active_cars = $stat['active_cars'];
   $inactive_cars = $stat['inactive_cars'];
   $archived_cars = $stat['archived_cars'];
   $last_added = $stat['last_added'];
   $sold_cars  = $stat['sold_cars'];   
    
   if ($_POST['automatics'] == 1) {

      $admin->setAutomatics($_POST);
        
   }
    
    if ($_POST['logo'] == 1) {
        
      $admin->changeLogo($_FILES);

    }    
    
    if ($_POST['pass_chng'] == 1) {

      $admin->changePassword($_POST);

    }
    
   if ($_POST['ok'] == 1) {

      $admin->updateSettings($_POST);

   }

   $settings = $admin->getSettings();
    
echo '
    <br>
    <div class="front-panel-header"style="margin-bottom: 20px;"><strong>PANEL ADMINISTRACYJNY</strong></div>

    <div class="panel-wrapper">    
    <div class="box panel-stats">
        <div class="show-car-header">Statystyka</div>
        <div class="box-inside">
            Samochodów : '.$all_cars.'<br>
            Aktywnych: '.$active_cars.'<br>
            Nieaktywnych: '.$inactive_cars.'<br>
            Sprzedanych: '.$sold_cars.'<br>
            W archiwum: '.$archived_cars.'<br><br>
            Ostatnio dodany :<br>
            <a href="index.php?action=admin&view=show_car&car_id='.$last_added['id'].'">'.$last_added['make'].' '.$last_added['model'].' '.$last_added['year'].'</a><br>
        </div>
    </div>

    <div class="box panel-password">
        <div class="show-car-header">Zmiana hasła</div>
        <div class="box-inside">
            <form action="index.php?action=admin&view=panel" method="post">
            <input type="hidden" name="pass_chng" value="1">
            <input type="password" name="old_pass" class="input-panel" autocomplete="off" required placeholder="Obecne hasło"><br>
            <input type="password" name="new_pass" class="input-panel" autocomplete="off" required placeholder="Nowe hasło"><br>
            <input type="password" name="new_pass_2" class="input-panel" autocomplete="off" required placeholder="Powtórz nowe hasło"><br>
            <button type="submit" class="email_b">Zapisz</button><br>
            </form>
        </div>
    </div>

    <div class="box panel-logo">
        <div class="show-car-header">Zmiana loga</div>
        <div class="box-inside">
            <form enctype="multipart/form-data" action="index.php?action=admin&view=panel" method="post">
                <input type="hidden" name="logo" value="1">
                Wybierz pik z dysku:<br><input type="file" name="top" class="input-panel" required><br>
                <span style="font-size: 8pt; color: #999999">Obraz w formacie JPG o wymiarach 1000 x 150 pixeli</span><br>
                <button type="submit" class="email_b">Zapisz</button>
            </form>
        </div>
    </div>

    <div class="box panel-automatics">
    <div class="show-car-header">Automatyka</div>
        <div class="box-inside">
            <form action="index.php?action=admin&view=panel" method="post">
                <input type="hidden" name="automatics" value="1">
                Deaktywuj sprzedane po: <input type="number" min="1" value="'.$settings['deactivate'].'" name="deactivation" class="input-panel" style="width: 60px;" maxlength="3" required> dniach<br>
                <span style="font-size: 8pt; color: #999999">Wskaż, po ilu dniach, maj± zostać zdeaktywowane samochody, które zostały sprzedane.</span><br>
                Archiwizuj nieaktywne po: <input type="number" min="1" value="'.$settings['archive']. '" name="archive" class="input-panel" style="width: 60px;" maxlength="3" required> dniach<br>
                <span style="font-size: 8pt; color: #999999">Wskaż, po ilu dniach, maj± zostać przeniesione do archiwum samochody, które s± nieaktywne.</span><br>
                <button type="submit" class="email_b">Zapisz</button><br>
            </form>
        </div>
    </div>

    <div class="box panel-address">
        <div class="show-car-header">Dane kontaktowe</div>
        <div class="box-inside">
            <form action="index.php?action=admin&view=panel" method="post">
                <input type="hidden" name="ok" value="1">
                <input placeholder="Nagłówek strony" type="text" value="' . $settings['header'] . '" name="header" class="input-panel" autocomplete="off"><br>
                <input placeholder="Podtytuł" type="text" value="' . $settings['subtitle'] . '" name="subtitle" class="input-panel" autocomplete="off"><br>

                <input placeholder="Adres strony bez http://" type="text" value="' . $settings['strona'] . '" name="strona" class="input-panel" autocomplete="off"><br>
                <input placeholder="Nazwa firmy" type="text" value="'.$settings['firma'].'" name="firma" class="input-panel" autocomplete="off"><br>
                <input type="text" value="'.$settings['adres'].'" name="adres" class="input-panel" autocomplete="off" placeholder="Ulica i numer"><br>
                <input type="text" value="'.$settings['kod'].'" name="kod" class="input-panel" autocomplete="off" placeholder="Kod pocztowy"><br>
                <input type="text" value="'.$settings['miasto'].'" name="miasto" class="input-panel" autocomplete="off" placeholder="Miejscowość"><br>
                <input type="text" value="'.$settings['telefon'].'" name="telefon" class="input-panel" autocomplete="off" placeholder="Numery telefonów"><br>
                <input type="text" value="'.$settings['email'].'" name="email" class="input-panel" autocomplete="off" placeholder="Adres email"><br>
                Godziny otwarcia:<br><input type="text" value="'.$settings['godziny'].'" name="godziny" class="input-panel" autocomplete="off"><br>
                Link do mapy:<br><textarea class="opis_mainpage2" name="mapa">'.$settings['mapa'].'</textarea><br>
                <button type="submit" class="email_b">Zapisz zmiany</button> <br>
            </form>
        </div>
    </div>

</div>';
}
?>