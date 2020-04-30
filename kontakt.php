<?php
echo '
  <div class="show-car-header">
    JAK NAS ZNALEŻĆ ?
  </div>';
echo '
  <div>
    '.$settings_table['firma'].'<br>'.$settings_table['adres'].'<br>'.$settings_table['kod'].' '.$settings_table['miasto'].'<br>
    Telefon: '.$settings_table['telefon'].'<br>
    email: '.$settings_table['email'].'<br>
    Godziny otwarcia:<br>'.$settings_table['godziny'].'<br><br>
    <center>'.$settings_table['mapa'].'</center>
  </div>';
?>