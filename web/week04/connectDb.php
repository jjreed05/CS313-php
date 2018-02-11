<?php

try
{
  $user = 'qqabikskgthgpos';
  $password = '2f276e59f82527e2b73e3fe471815954c4364fbbe39e054c54aee16923eef91c';
  $db = new PDO('postgres://qqabikskgthgpo:2f276e59f82527e2b73e3fe471815954c4364fbbe39e054c54aee16923eef91c@ec2-54-225-103-255.compute-1.amazonaws.com:5432/d4hr7otnaq0hmo', $user, $password);
    
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

?>