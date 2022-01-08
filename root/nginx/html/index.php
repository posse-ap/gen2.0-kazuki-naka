<?php
echo phpinfo();

$dsn = 'mysql:host=mysql;dbname=quizy;charset=utf8mb4';
$user = 'kazuki';
$password = 'pass';

try{
    $dbh = new PDO($dsn, $user, $password);

    print('接続に成功しました。<br>');

    $dbh->query('SET NAMES sjis');

    $sql = 'select * from big_questions';
    foreach ($dbh->query($sql) as $row) {
        print($row['id']);
        print($row['name'].'<br>');
    }
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

?>