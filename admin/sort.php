<?php
if (AdminLogin::isAdminLoggedIn()) {
    echo '
        <div>
            <a href="index.php?action=admin&view=show_cars">WSZYSTKIE</a> | 
            <a href="index.php?action=admin&view=show_cars&sort=1">NOWE</a> | 
            <a href="index.php?action=admin&view=show_cars&sort=2">AKTYWNE</a> | 
            <a href="index.php?action=admin&view=show_cars&sort=5">NIEAKTYWNE</a> | 
            <a href="index.php?action=admin&view=show_cars&sort=3">SPRZEDANE</a>
        </div>
    ';
}
?>