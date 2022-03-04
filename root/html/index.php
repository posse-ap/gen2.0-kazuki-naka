<?php

require('./dbconnect.php');

$stmt = $dbh->query('SELECT SUM(learning_time) AS today_learning_time FROM learning_schedule WHERE YEAR(learning_date)=2022 AND MONTH(learning_date)=2 AND DAY(learning_date)=8');
$today = $stmt->fetchAll();

$stmt = $dbh->query('SELECT SUM(learning_time) AS month_learning_time FROM learning_schedule WHERE YEAR(learning_date)=2022 AND MONTH(learning_date)=2');
$month = $stmt->fetchAll();

$stmt = $dbh->query('SELECT SUM(learning_time) AS total_learning_time FROM learning_schedule');
$total = $stmt->fetchAll();

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
                <div class="learning-time"><p><span class="day">Today</span><br><span class="number"><?=$today[0]['today_learning_time']; ?></span><br><span class="hour">hour</span></p></div>
                <div class="learning-time"><p><span class="day">Month</span><br><span class="number"><?=$month[0]['month_learning_time'] ?></span><br><span class="hour">hour</span></p></div>
                <div class="learning-time"><p><span class="day">Total</span><br><span class="number"><?=$total[0]['total_learning_time'] ?></span><br><span class="hour">hour</span></p></div>
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
        <div class="date"><i class="fas fa-chevron-left left-arrow fa-lg"></i>2022年2月<i class="fas fa-chevron-right right-arrow fa-lg"></i></div>
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
                            <div class="label"></div><div class="content"><input type="checkbox" id="language8"><label for="language8">情報システム基礎知識</label></div>
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
    <script>
        const modal = document.getElementById('modal');
        const modalSubmit = document.getElementById('modal-submit');
        const allModalContent = document.getElementById('all-modal-content');
        const spinner = document.getElementById('spinner');
        const closeButton = document.getElementById('close-button');
        const backButton = document.getElementById('back-button');
        const calender = document.getElementById('calender-wrapper');
        const chosenCalender = document.getElementById('calender-input');
        const decision = document.getElementById('decision');
        decision.style.display = 'none';

        //トップページの記録・投稿ボタンを押したときの処理
        document.getElementById('top-submit').addEventListener('click', () => {
            allModalContent.style.display = 'flex';
            modalSubmit.style.display = 'block';
            modal.style.display = 'block';
        })

        //閉じるボタンを押したらトップページに戻る
        closeButton.addEventListener('click', () => {
            modal.style.display = 'none';
            spinner.style.display = 'none';
            document.getElementById('check-mark').style.display = 'none';
        })

        //モーダルページの記録・投稿ボタンを押したらローディング画面表示&Twitter遷移
        let $url = 'https://twitter.com/intent/tweet?';
        modalSubmit.setAttribute('href', $url);
        let shareButton = document.getElementById('share');
        modalSubmit.addEventListener('click', () => {
            allModalContent.style.display = 'none';
            spinner.style.display = 'block';
            setTimeout(getFinished, 3000);
            modalSubmit.style.display = 'none';
            if(shareButton.checked === true){
                $url += `text=${document.getElementById('twitter-comment').value}`;
                window.open($url, '_blank');
            }
        })

        //カレンダーアイコンを押したらカレンダー表示
        document.getElementById('calender-icon').addEventListener('click', () => {
            modalSubmit.style.display = 'none';
            allModalContent.style.display = 'none';
            closeButton.style.display = 'none';
            backButton.style.display = 'block';
            calender.style.display = 'block';
            decision.style.display = 'block';
        })

        backButton.addEventListener('click', () => {
            modalSubmit.style.display = 'block';
            allModalContent.style.display = 'flex';
            backButton.style.display = 'none';
            closeButton.style.display = 'block';
            calender.style.display = 'none';
            decision.style.display = 'none';
            chosenCalender.value = ''; //もしカレンダーの日付をクリックした後に戻るボタンを押したら日付は反映されないようにvalueを空にする
        })

        //決定ボタンを押した後の実装
        decision.addEventListener('click', () => {
            decision.style.display = 'none';
            calender.style.display = 'none';
            backButton.style.display = 'none';
            modalSubmit.style.display = 'block';
            allModalContent.style.display = 'flex';
            closeButton.style.display = 'block';
            chosenCalender.style.display = 'block';
        })

        // 棒グラフの表示
        let ctx = document.getElementById("myBarChart");
        <?php $barData = array(); for($i = 0;$i < 30;$i++){
            $stmt = $dbh->query("SELECT learning_time FROM learning_schedule WHERE YEAR(learning_date)=2022 AND MONTH(learning_date)=2 AND DAY(learning_date)=$i+1");
            if(!$stmt){
                array_push($barData,0);
            }else{
                $learning_time = $stmt->fetchAll();
                array_push($barData,$learning_time['learning_time']);
            }
        };?>
        let myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
            //凡例のラベル
                labels: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'],
                datasets: [
                    {
                        label: '学習時間', //データ項目のラベル
                        data: <?= $barData;?>,//[3,5,1,3,3,4,6,7,1,4,2,5,7,8,7,3,4,1,1,1,4,2,5,1,6,8,8,2,1,4,1],//グラフのデータ
                        backgroundColor: 'rgb(15,114,188)',
                    }
                ],
            },
            options: {
                scales: {
                xAxes: [{
                    display: true,
                    stacked: false,
                    gridLines: {
                    display: false
                    }
                }],
                yAxes: [{
                    ticks: {
                    suggestedMax: 8, //最大値
                    suggestedMin: 0, //最小値
                    stepSize: 2, //縦ラベルの数値単位
                    callback: function(tick){
                        return tick.toString() + 'h';
                    }
                    },
                    gridLines: {
                    display: false
                    }
                }],
                },
            }
        });

        //円グラフの表示
        let dataLabelPlugin = {
            afterDatasetsDraw: function (chart, easing) {
            // To only draw at the end of animation, check for easing === 1
            var ctx = chart.ctx;

            chart.data.datasets.forEach(function (dataset, i) {
                var meta = chart.getDatasetMeta(i);
                if (!meta.hidden) {
                    meta.data.forEach(function (element, index) {
                        // Draw the text in black, with the specified font
                        ctx.fillStyle = 'rgb(0, 0, 0)';

                        let fontSize = 12;
                        let fontStyle = 'normal';
                        let fontFamily = 'Helvetica Neue';
                        ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                        // Just naively convert to string for now
                        var dataString = dataset.data[index].toString() + "%";

                        // Make sure alignment settings are correct
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'top';
                        ctx.fillStyle = 'white';

                        var padding = 5;
                        var position = element.tooltipPosition();
                        ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                    });
                }
            });
        }
        }
        let chart1 = document.getElementById("myDoughnutChart1");
        let myDoughnutChart1= new Chart(chart1, {
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: [
                        "#0042E5",
                        "#0070B9",
                        "#00BDDB",
                        "#08CDFA",
                        "#B29DEF",
                        "#6C43E5",
                        "#4609E8",
                        "#2D00BA"
                    ],
                    data: [5.9, 11.8, 23.5, 14.7,8.8,29.4,5.9,0] //グラフのデータ
                }],
                labels: ["HTML","CSS","JavaScript","PHP","Laravel","SQL","SHELL","情報システム基礎知識(その他)"]
            },
            plugins: [dataLabelPlugin],
            options: {
                cutoutPercentage: 45,
                maintainAspectRatio: false,
                legend:{
                position: "bottom"
                },
                tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                    return data.labels[tooltipItem.index]
                        + ": "
                        + data.datasets[0].data[tooltipItem.index]
                        + " %"; 
                    }
                }
                },
            }
        });

        let chart2 = document.getElementById("myDoughnutChart2");
        let myDoughnutChart2= new Chart(chart2, {
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: [
                        "#0042E5",
                        "#0070B9",
                        "#00BDDB"
                    ],
                    data: [94.1,0,5.9] //グラフのデータ
                }],
                labels: ["ドットインストール","N予備校","POSSE課題"]
            },
            plugins: [dataLabelPlugin],
            options: {
                cutoutPercentage: 45,
                maintainAspectRatio: false,
                legend:{
                position: "bottom",
                },
                tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                    return data.labels[tooltipItem.index]
                        + ": "
                        + data.datasets[0].data[tooltipItem.index]
                        + " %"; 
                    }
                }
                }
            }
        });

        //カレンダーの実装
        const week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        const today = new Date();
        // 月末だとずれる可能性があるため、1日固定で取得
        var showDate = new Date(today.getFullYear(), today.getMonth(), 1);

        // 初期表示
        window.onload = function () {
            showProcess(today, calendar);
        };
        // 前の月表示
        function prev(){
            showDate.setMonth(showDate.getMonth() - 1);
            showProcess(showDate);
        }

        // 次の月表示
        function next(){
            showDate.setMonth(showDate.getMonth() + 1);
            showProcess(showDate);
        }

        // カレンダー表示
        function showProcess(date) {
            var year = date.getFullYear();
            var month = date.getMonth();
            document.querySelector('#header').innerHTML = year + "年 " + (month + 1) + "月";

            var calendar = createProcess(year, month);
            document.querySelector('#calendar').innerHTML = calendar;
        }

        // カレンダー作成
        function createProcess(year, month) {
            // 曜日
            let calendar = "<table><tr class='dayOfWeek'>";
            for (let i = 0; i < week.length; i++) {
                calendar += "<th>" + week[i] + "</th>";
            }
            calendar += "</tr>";

            let count = 0;
            let startDayOfWeek = new Date(year, month, 1).getDay();
            let endDate = new Date(year, month + 1, 0).getDate();
            let lastMonthEndDate = new Date(year, month, 0).getDate();
            let row = Math.ceil((startDayOfWeek + endDate) / week.length);

            // 1行ずつ設定
            for (let i = 0; i < row; i++) {
                calendar += "<tr>";
                // 1colum単位で設定
                for (var j = 0; j < week.length; j++) {
                    if (i == 0 && j < startDayOfWeek) {
                        // 1行目で1日まで先月の日付を設定
                        calendar += "<td class='disabled'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
                    } else if (count >= endDate) {
                        // 最終行で最終日以降、翌月の日付を設定
                        count++;
                        calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
                    } else {
                        // 当月の日付を曜日に照らし合わせて設定
                        count++;
                        if(year == today.getFullYear() && month == (today.getMonth()) && count == today.getDate()){
                            calendar += `<td id="${year}-${month+1}-${count}" aria-selected="true" onclick=setDate(${year},${month+1},${count})>` + count + "</td>";
                        } else {
                            calendar += `<td id="${year}-${month+1}-${count}" aria-selected="false" onclick=setDate(${year},${month+1},${count})>` + count + "</td>";
                        }
                    }
                }
                calendar += "</tr>";
            }
            return calendar;
        }

        //3秒ほど経過したら記録完了を表示
        function getFinished(){
            document.getElementById('check-mark').style.display = 'block';
            spinner.style.display = 'none';
        }

        function setDate(year,month,count){
            let selectedDay = document.getElementById(`${year}-${month}-${count}`);
            let today = document.querySelector('[aria-selected="true"]');
            selectedDay.setAttribute("aria-selected",true);
            today.setAttribute("aria-selected",false);
            chosenCalender.value = `${year}年${month}月${count}日`;
        }
    </script>
</body>
</html>