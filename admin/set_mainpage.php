<?php
if (AdminLogin::isAdminLoggedIn()) {

   $admin = new Admin;

   if ($_POST['ok'] == 1) {

      $admin->setMainPage($_POST);

   } 

   $mainPageMessage = FrontPanel::getWelcomeMessage();

   $subskrypcja = $mainPageMessage['subskrypcja'];
   $opis = $mainPageMessage['opis'];

   echo'
      <div class="show-car-full" style="margin-top: 20px;">
         <div class="show-car-header">
            <b>Edycja strony głównej</b>
         </div>
         <form action="index.php?action=admin&view=set_mainpage" method="post">
            <input type="hidden" name="ok" value="1">
            <br>
            <b>Tutaj wstaw opis pojawiający się na pierwszej stronie w opisie okienka subskrypcji.</b><br>
            <textarea class="opis_mainpage2" name="subskrypcja">'.$subskrypcja.'</textarea><br><br>
            <b>Tutaj wstaw opis pojawiający się na pierwszej stronie w głównym oknie.</b><br>
            <textarea class="opis_mainpage2" name="opis">'.$opis.'</textarea><br>
            <button type="submit" class="email_b">Zapisz zmiany</button>
         </form>
      </div>';
}
?>