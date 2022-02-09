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

//東京か広島か
$stmt = $dbh->prepare('SELECT * FROM big_questions WHERE id=:id');
$id = $_GET['id'];
$stmt->bindParam(':id',$id);
$stmt->execute();
$big_questions = $stmt->fetchAll();

//東京だったら高輪と亀戸、広島だったら向洋を取得
if($id == 1){
    $stmt = $dbh->query('SELECT * FROM questions WHERE big_question_id = 1');
    $questions = $stmt->fetchAll();
    $stmt = $dbh->query('SELECT * FROM choices WHERE question_id = 1 OR question_id = 2');
    $choices = $stmt->fetchAll();
}else{
    $stmt = $dbh->query('SELECT * FROM questions WHERE big_question_id = 2');
    $questions = $stmt->fetchAll();
    $stmt = $dbh->query('SELECT * FROM choices WHERE question_id = 3');
    $choices = $stmt->fetchAll();
}

$choice_array = [];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ガチで<?=$big_questions[0]['name']?>の人しか解けない！＃<?=$big_questions[0]['name']?></title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="./quizy.css">
</head>
<body>
    <div class="quizy-container" id="quizy-container">
        <h1>ガチで<?=$big_questions[0]['name'];?>の人しか解けない！ #<?=$big_questions[0]['name'];?>の難読地名クイズ</h1>
        <?php for($i = 0;$i < count($questions);$i++){?>
            <h2 class="question"><?=$i + 1?>.この地名は何て読む？</h2>
            <img src="./image/<?= $questions[$i]['image'];?>" alt="難読地名" class="image">
            <ul class="quizy-selection">
                <?php for($j = $i*3;$j < $i*3 + 3;$j++){?>
                <li class="choice"><?= $choices[$j]['name'];?></li>
                <?php };?>
            </ul>
        <?php };?>
    </div>
    <!-- <script src="quizy.js"></script> -->
</body>
</html>