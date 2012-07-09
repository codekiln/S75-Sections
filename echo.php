<?php 
//if( count($_GET) > 0 && isset( $_GET['page'] ) ) {
  // example: 
  // echo.php?page=7-02_MVC/app04/controller/controller.php
//  $page = $_GET['page'];
  $page = 'permissions.php';
  $file = $_SERVER['PHP_SELF'];
  $parentFolderName = dirname($file);
  echo $parentFolderName . "<br/>";
  $fname = $parentFolderName . "/" . $page;
  echo "opening ...". $fname . "<br/>";
  echo htmlspecialchars(file_get_contents($fname));
//}
