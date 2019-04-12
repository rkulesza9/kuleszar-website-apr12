<?php
  include '../user_auth.php';

  resetPassword();

?>

<html>
  <head>
    <title>Reset Your Password</title>
  </head>
  <body>
    <form action='reset_password.php' method='post'>
      <table>
        <tr><th>Username:</th><td><input type='text' placeholder='username' name='username'></td></tr>
        <tr><th>Old Password:</th><td><input type='password' name='password'></td></tr>
        <tr><th>New Password:</th><td><input type='password' name='new_password'></td></tr>
        <tr><td><input type='submit' value='Reset Password' name='reset_password'></td></tr>
      </table>
    </form>
    <a href='login.php'>Click here to login!</a>
  </body>
  <footer>
  </footer>
</html>
