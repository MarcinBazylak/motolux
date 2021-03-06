<?php
session_start();
$mtime = time();
include 'includes/db.php';
include 'includes/functions.php';

include 'includes/autoloader.php';

$settings_table = Settings::getData();
FrontPanel::enterStats();

include 'head/header.php';
include 'includes/cron.php';

echo '
<body>
  <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
  <div id="container">
  <header><div class="titles"><span style="font-weight: 800; color: white; font-size:3.2em; line-height: 1; text-shadow: 0 0 10px black">'
   . $settings_table['header'] .
'</span><span style="font-weight: 800; color: white; font-size:1.5em; line-height: 1; text-shadow: 0 0 10px black; letter-spacing: 2px">'
 . $settings_table['subtitle'] . 
 '</span></div>';
include "includes/menu.php";
echo '
    </header>
    <main>';

if(htmlspecialchars($_GET['ev']) == 'invalid_login_details') {
   $alert = 'Wprowadziłeś niepoprawne dane.';
   displayAlert(0, $alert);
}

if ($_SESSION['logged_in']) {
   include "admin/menu.php";
}
if (isset($_GET['action'])) {
   $action = $_GET['action'];
} else {
   $action = "main";
}

include $action . '.php';

echo '
</main>
    <footer>
      <p>
        &copy; Copyright 2011-2012 '.$settings_table['strona'].'. Projekt i wykonanie <a style="color: #999;" href="http://marcinbazylak.com">Marcin Bazylak</a><br>
        Wszelkie prawa zastrzeżone.<br>
        Kopiowanie i rozpowszechnianie bez zezwolenia zabronione.
      </p>
    </footer>
</div>
<script>lightbox.option({\'showImageNumberLabel\': false,})</script>

<script>
$("#image").on("change", function() {
 if ($("#image")[0].files.length > 8) {
     alert("Maksymalnie 8 zdjęć");
 }
});
</script>

</body>
</html>
';

mysqli_close($link);
ob_end_flush();
?>