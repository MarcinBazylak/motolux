<?php
if (AdminLogin::isAdminLoggedIn()) {
   echo '
    <div class="admin-menu" style="margin-bottom: 10px;">
    <input type="checkbox" class="nav-toggle" id="input-toggle">
        <ul>
        <label for="input-toggle">
        <li id="toggle">
        <span></span>
        <span></span>
        <span></span>
        </li>
        </label>
        <li><a href="index.php?action=admin">PANEL</A></li>
        <li><a href="index.php?action=admin&view=show_cars">SAMOCHODY</A></li>
        <li><a href="index.php?action=admin&view=add_new">DODAJ SAMOCHÓD</A></li>
        <li><a href="index.php?action=admin&view=set_mainpage">STRONA TYTUŁOWA</A></li>
        <li><a href="index.php?action=admin&view=stats">STATYSTYKI</a></li>
        <li><a href="index.php?action=admin&view=subscriptions">SUBSKRYPCJA</a></li>
        <li><a href=index.php?action=admin&view=show_cars&sort=4>ARCHIWUM</A></li>
        <li><a href="logoff.php">WYLOGUJ</A></li>
        </ul>
    </div>';
}
?>