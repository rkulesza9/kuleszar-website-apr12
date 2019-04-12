<?php
  include '../user_auth.php';

  if(sessionExistsForService("apr12")){
    header("location: index.php");
  } else loginToService("apr12",false);
?>

<html>
  <head>
    <title>Fiance Services</title>
  </head>
  <body>
    <form method='post' action='login.php'>
      <table>
        <tr><th>Username:</th><td><input type='text' placeholder='username' name='username'></td></tr>
        <tr><th>Password:</th><td><input type='password' name='password'></td></tr>
        <tr><td><input type='submit' value='Log In' name='submit'/></td></tr>
      </table>
    </form>
    <a href='reset_password.php'>reset your password</a>
  </body>
  <footer>
  </footer>
</html>
