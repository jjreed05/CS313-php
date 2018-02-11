<?php

try
{
  $user = 'postgres';
  $password = '4857';
  $db = new PDO('pgsql:host=127.0.0.1;dbname=peacedollar', $user, $password);
    
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

?>