<?php

$dsn = 'mysql:host=mysql;dbname=webapp;charset=utf8';
$user = 'kazuki';
$password = 'pass';

try{
  $dbh = new PDO($dsn,$user,$password);

  $dbh->query('SET NAMES utf8');
}catch(PDOException $e){
  print('Error:'.$e->getMessage());
  die();
}

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>