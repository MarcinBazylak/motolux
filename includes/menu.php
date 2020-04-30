<?php
echo '
      <nav>';
if ($_GET['action'] == '' || $_GET['action'] == 'main') {
echo '
        <img src="images/home2.gif" border="0">&nbsp;&nbsp;';
} else {
echo '
        <a href="index.php">
          <img src="images/home.gif" onMouseOver="this.src=\'images/home1.gif\', overlib(\'<center><B>Przejdź do strony głównej</B></center>\',WRAP, FGCOLOR, \'#ffffff\', ABOVE, BGCOLOR, \'#000000\',TEXTSIZE, 2, TEXTCOLOR, \'#000000\', STATUS, \'\')" onMouseOut="this.src=\'images/home.gif\', nd();" border="0">
        </a>&nbsp;&nbsp;';
 }
 if ($_GET['action'] == 'show_cars') {
echo '
        <img src="images/cars2.gif" border="0">&nbsp;&nbsp;
'; 
 } else {
echo '
        <a href="index.php?action=show_cars">
          <img src="images/cars.gif" onMouseOver="this.src=\'images/cars1.gif\', overlib(\'<center><B>Zapoznaj się z naszą ofertą</B></center>\',WRAP, ABOVE, FGCOLOR, \'#ffffff\', BGCOLOR, \'#000000\',TEXTSIZE, 2, TEXTCOLOR, \'#000000\', STATUS, \'\')" onMouseOut="this.src=\'images/cars.gif\', nd();" border="0">
        </a>&nbsp;&nbsp;';
}
if ($_GET['action'] == 'kontakt') {
echo '
        <img src="images/contact2.gif" border="0"></a>&nbsp;&nbsp;
    ';
} else {
echo '
        <a href="index.php?action=kontakt">
          <img src="images/contact.gif" onMouseOver="this.src=\'images/contact1.gif\', overlib(\'<center><B>Skontaktuj się z nami</B></center>\',WRAP, ABOVE, FGCOLOR, \'#ffffff\', BGCOLOR, \'#000000\',TEXTSIZE, 2, TEXTCOLOR, \'#000000\', STATUS, \'\')" onMouseOut="this.src=\'images/contact.gif\', nd();" border="0">
        </a>&nbsp;&nbsp;';
}
echo '
      </nav>';
?>