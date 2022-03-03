<?php

require('./dbconnect.php');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no"/>
    <title>自主制作アプリ</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>
<body>
    <header>
        <img src="./image/logo.jpg" alt="POSSE" class="logo">
        <p class="subtitle">4th week</p>
        <button id="top-submit" class="top-submit">記録・投稿</button>
    </header>
    <main>
        <div class="left-content">
            <div class="time-display">
                <div class="learning-time"><p><span class="day">Today</span><br><span class="number">3</span><br><span class="hour">hour</span></p></div>
                <div class="learning-time"><p><span class="day">Month</span><br><span class="number">120</span><br><span class="hour">hour</span></p></div>
                <div class="learning-time"><p><span class="day">Total</span><br><span class="number">1348</span><br><span class="hour">hour</span></p></div>
            </div>
            <div class="graph">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
        <div class="right-content">
            <div class="learning-content">
                <p>学習言語</p>
                <canvas id="myDoughnutChart1"></canvas>
            </div>
            <div class="learning-content">
                <p>学習コンテンツ</p>
                <canvas id="myDoughnutChart2"></canvas>
            </div>
        </div>
        <div class="date"><i class="fas fa-chevron-left left-arrow fa-lg"></i>2022年3月<i class="fas fa-chevron-right right-arrow fa-lg"></i></div>
    </main>
    <div id="modal">
        <div class="modal-content">
            <div id="all-modal-content">
                <div class="modal-leftcontent">
                    <div class="learning-date">
                        <p>学習日</p>
                        <div><input type="text" id="calender-input"><i id="calender-icon" class="far fa-calendar-alt calender"></i></div>
                    </div>
                    <div class="modal-learning-content">
                        <p>学習コンテンツ(複数選択可)</p>
                        <div id="content" class="checkboxes">
                            <div class="label"></div><div class="content"><input type="checkbox" id="content1" class="content"><label for="content1">N予備校</label></div>
                            <div class="label"></div><div class="content"><input type="checkbox" id="content2" class="content"><label for="content2">ドットインストール</label></div>
                            <div class="label"></div><div class="content"><input type="checkbox" id="content3" class="content"><label for="content3">POSSE課題</label></div>
                        </div>
                    </div>
                    <div class="modal-language">
                        <p>学習言語</p>
                        <div id="language" class="checkboxes">
                            <div class="label"></div><div class="content"><input type="checkbox" id="language1"><label for="language1">HTML</label></div>
                            <div class="label"></div><div class="content"><input type="checkbox" id="language2"><label for="language2">CSS</label></div>
                            <div class="label"></div><div class="content"><input type="checkbox" id="language3"><label for="language3">JavaScript</label></div>
                            <div class="label"></div><div class="content"><input type="checkbox" id="language4"><label for="language4">PHP</label></div>
                            <div class="label"></div><div class="content"><input type="checkbox" id="language5"><label for="language5">Laravel</label></div>
                            <div class="label"></div><div class="content"><input type="checkbox" id="language6"><label for="language6">SQL</label></div>
                            <div class="label"></div><div class="content"><input type="checkbox" id="language7"><label for="language7">SHELL</label></div>
                            <div class="label"></div><div class="content"><input type="checkbox" id="language8"><label for="language8">情報システム基礎知識(その他)</label></div>
                        </div>
                    </div>
                </div>
                <div class="modal-rightcontent">
                    <div class="modal-time">
                        <p>学習時間</p>
                        <input type="text" class="modal-time-learning">
                    </div>
                    <div class="commentbox">
                        <p>Twitter用コメント</p>
                        <div><input type="text" id="twitter-comment"></div>
                    </div>
                    <div class="share-button">
                        <input id="share" type="checkbox"><label for="share">Twitterにシェアする</label>
                    </div>
                </div>
            </div>
            <button href="" id="modal-submit" class="button">記録・投稿</button>
            <div id="back-button" class="back">←</div>
            <div id="close-button" class="close">×</div>
            <div id="spinner" class="dot-spin"></div>
            <div id="check-mark" class="finished"><i class="fas fa-check fa-fw checked"></i>記録・投稿完了しました！</div>
            <div id="calender-wrapper" class="wrapper">
                <!-- xxxx年xx月を表示 -->
                <h1 id="header"></h1>
                <!-- ボタンクリックで月移動 -->
                <div id="next-prev-button">
                    <button id="prev" onclick="prev()">‹</button>
                    <button id="next" onclick="next()">›</button>
                </div>
                <!-- カレンダー -->
                <div id="calendar"></div>
                <button id="decision" class="button">決定</button>
            </div>
        </div>
    </div>
    <script src="./app.js"></script>
</body>
</html>