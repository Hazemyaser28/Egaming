<?php
  $serverName = "localhost";
  $userName = "root";
  $password = "";
  $dbName = "egaming";
  $con = new mysqli ($serverName, $userName, $password, $dbName);

  if (!$con) {
    die ("Connection failed: " . $con -> connect_error);
  }
  ?>