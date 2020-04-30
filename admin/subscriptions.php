<?php
if (AdminLogin::isAdminLoggedIn()) {

   if (htmlspecialchars($_POST['send']) == 1) {

      Admin::sendEmailToSubscribers($_POST);

   }

   echo '
   <br>
   <div class="front-panel-header" style="margin-bottom: 20px;"><strong>Wyślij subskrypcje</strong></div>
   <div class="admin-menu"><a href="index.php?action=admin&view=subscriptions">WYŚLIJ</a> | <a href="index.php?action=admin&view=sent">WYSŁANE</a> | <a href="index.php?action=admin&view=addresses">BAZA ADRESÓW</a></div>
   <div class="box-inside">
      Tutaj możesz wpisać temat oraz treść wiadomości i wysłać ją do wszystkich osób, które wyraziły chęć otrzymywania powiadomień poprzez zapisanie swojego adresu email w bazie danych serwisu.<br><br>
      <form action="index.php?action=admin&view=subscriptions" method="post">
            <input type="hidden" name="send" value="1">
            <input placeholder="Temat wiadomości" type="text" name="temat" class="input-panel" maxlength="200" autocomplete="off">
            <textarea placeholder="Wiadomość subskrypcji" class="opis_mainpage2" name="tresc"></textarea>
            <button type="reset" class="email_b" />Wyczyść</button> <button type="submit" class="email_b">Wyślij wiadomość</button>
      </form>
   </div>';
}
?>