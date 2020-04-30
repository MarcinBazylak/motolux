<?php

if ($_POST['q'] == "add_email") {

   $email = htmlspecialchars($_POST['email']);
   subscribe($email);

}

$mainPageMessage = FrontPanel::getWelcomeMessage();

$subskrypcja = nl2br($mainPageMessage['subskrypcja']);
$opis = nl2br($mainPageMessage['opis']);

if($_GET['q'] == 'unsubscribe') {
   FrontPanel::unsubscribe(htmlspecialchars($_GET['email']));
}

echo '
  <div class="subscription">
    <p>'.$subskrypcja.'</p>
    <form enctype="multipart/form-data" action="index.php" method="post">
      <input type="hidden" name="ok" value="1">
      <input type="hidden" name="q" value="add_email">
      <input type="email" name="email" class="email_main" required>&nbsp;&nbsp;&nbsp;</td><td> <button type="submit" class="email_b"> WYŚLIJ >> </button>
    </form>
  </div>
    <p>'.$opis.'</p>';
include "front_low.php";
?>