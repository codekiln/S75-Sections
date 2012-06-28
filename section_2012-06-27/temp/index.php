<?php
session_start();
?>
<html>
  <head>
  <title>temporary page</title>
  </head>
  <body>
  <h1>temporary page is working</h1><br />
  <form action="index02.php" method="post">
  First Name<br/>
    <input name="first_name"/>
    <br/>
  Last Name<br/>
    <input name="password" />
    <input type="submit"/>
  </form>


  <?php 
  print_r($_POST);
    $_SESSION['first_name']= @$_POST['first_name'];
    $_SESSION['last_name']= @$_POST['last_name'];
    ?>
  </body>
  </html>
<?php 
session_destroy();
?>
