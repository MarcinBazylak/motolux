<?
session_start();
if (!AdminLogin::isAdminLoggedIn()) {
   echo '
   <div class="login-box">
      Proszę się zalogować.<br>
      <form action="get_access.php" method="post">
         <input type="hidden" name="ok" value="1"><br>
         <input type="text" name="name" class="input-panel" placeholder="Login" required><br>
         <input type="password" name="password" class="input-panel" placeholder="Hasło" required><br>
         <button type="submit" class="email_b" name="submit" value="submit">Zaloguj</button>
      </form>
   </div>';

} elseif ($_GET['view'] == "" && $_GET['q'] == "") {
   include 'admin/panel.php';
} else {
   include 'admin/'.$_GET['view'].'.php';
}
?>