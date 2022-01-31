<?php

$dsn = 'mysql:host=mysql;dbname=quizy;charset=utf8';
$user = 'kazuki';
$password = 'pass';

try{
    $dbh = new PDO($dsn, $user, $password);

    $dbh->query('SET NAMES utf8');

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$stmt = $dbh->prepare('SELECT * FROM big_questions WHERE id=:id');
$stmt->bindParam(':id',$_GET['id']);
$stmt->execute();
$big_questions = $stmt->fetchAll();
// print_r($big_questions) . PHP_EOL;


$stmt = $dbh->query('SELECT * FROM questions');
$stmt->execute();
$questions = $stmt->fetchAll();

$stmt = $dbh->query('SELECT * FROM choices');
$choices = $stmt->fetchAll();
// print_r($choices) . PHP_EOL;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ガチで<?=$big_questions[0]['name']?>の人しか解けない！＃<?=$big_questions[0]['name']?></title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="../quizy.css">
</head>
<body>
    <div class="quizy-container" id="quizy-container">
        <h1>ガチで<?=$big_questions[0]['name'];?>の人しか解けない！ #<?=$big_questions[0]['name'];?>の難読地名クイズ</h1>    
        <h2><?=$questions[0]['big_question_id'];?>.この地名は何て読む？</h2>
        <img src="./image/<?= $questions[0]['image'];?>" alt="難読地名">
    </div>
    <script src="quizy.js"></script>
</body>
</html>