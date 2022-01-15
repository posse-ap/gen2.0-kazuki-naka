<?php

$dsn = 'mysql:host=mysql;dbname=quizy;charset=utf8';
$user = 'kazuki';
$password = 'pass';

try{
    $dbh = new PDO($dsn, $user, $password);

    $dbh->query('SET NAMES utf8');

    $id = filter_input(INPUT_GET,'id');
    $stmt = $dbh -> query("SELECT * FROM big_questions WHERE id = '".$id."'");

    $area = $stmt -> fetchAll();
    print_r($area) . PHP_EOL;
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ガチで東京の人しか解けない！＃東京の難読地名クイズ</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="quizy.css">
</head>
<body>
    <div class="quizy-container" id="quizy-container">
        <h1>ガチで東京の人しか解けない！ #東京の難読地名クイズ</h1>
    </div>
    <script src="quizy.js"></script>
</body>
</html>