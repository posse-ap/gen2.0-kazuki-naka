<?php

define('DSN','mysql:host=mysql;dbname=webapp;charset=utf8');
define('USER', 'kazuki');
define('PASSWORD', 'password');

try{
  $dbh = new PDO(DSN,USER,PASSWORD);
  $dbh->query('SET NAMES utf8');
}catch(PDOException $e){
  print('Error:'.$e->getMessage());
  die();
}

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>