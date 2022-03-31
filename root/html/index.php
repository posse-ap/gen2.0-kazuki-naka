<?php

require_once(__DIR__ . '/dbconnect.php');

$today = date("Y-m-d");
$stmt = $dbh->prepare('SELECT SUM(learning_time) AS today_learning_time FROM learning_schedule WHERE learning_date=:today');
$stmt->bindParam(':today',$today);
$stmt->execute();
$today_time = $stmt->fetchAll();

$year = date("Y"); //今年
$month = date("m"); //今月
$stmt = $dbh->prepare('SELECT SUM(learning_time) AS month_learning_time FROM learning_schedule WHERE YEAR(learning_date)=:year AND MONTH(learning_date)=:month');
$stmt->bindParam(':year',$year);
$stmt->bindParam(':month',$month);
$stmt->execute();
$month_time = $stmt->fetchAll();

$stmt = $dbh->query('SELECT SUM(learning_time) AS total_learning_time FROM learning_schedule');
$total_time = $stmt->fetchAll();

$stmt = $dbh->prepare('SELECT DAY(learning_date) AS date, learning_time FROM learning_schedule WHERE YEAR(learning_date)=:year AND MONTH(learning_date)=:month');
$stmt->bindParam(':year',$year);
$stmt->bindParam(':month',$month);
$stmt->execute();
$bar_data = $stmt->fetchAll();

$stmt = $dbh->prepare('SELECT learning_language, lang_color, SUM(learning_time) AS lang_total_time FROM learning_schedule WHERE YEAR(learning_date)=:year AND MONTH(learning_date)=:month GROUP BY learning_language, lang_color ORDER BY lang_total_time desc');
$stmt->bindParam(':year',$year);
$stmt->bindParam(':month',$month);
$stmt->execute();
$lang_chart_data = $stmt->fetchAll();

$stmt = $dbh->prepare('SELECT learning_content, cont_color, SUM(learning_time) AS cont_total_time FROM learning_schedule WHERE YEAR(learning_date)=:year AND MONTH(learning_date)=:month GROUP BY learning_content, cont_color ORDER BY cont_total_time desc');
$stmt->bindParam(':year',$year);
$stmt->bindParam(':month',$month);
$stmt->execute();
$cont_chart_data = $stmt->fetchAll();

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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
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
                <div class="learning-time"><p><span class="day">Today</span><br><span class="number" id="today"><?if($today_time[0]['today_learning_time']){echo $today_time[0]['today_learning_time'];}else{echo 0;}; ?></span><br><span class="hour">hour</span></p></div>
                <div class="learning-time"><p><span class="day">Month</span><br><span class="number" id="month"><?if($month_time[0]['month_learning_time']){echo $month_time[0]['month_learning_time'];}else{echo 0;}; ?></span><br><span class="hour">hour</span></p></div>
                <div class="learning-time"><p><span class="day">Total</span><br><span class="number" id="total"><?if($total_time[0]['total_learning_time']){echo $total_time[0]['total_learning_time'];}else{echo 0;}; ?></span><br><span class="hour">hour</span></p></div>
            </div>
            <div class="bar-graph">
                <p>学習時間</p>
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
        <div class="right-content">
            <div class="learning-content" id="learning-lang">
                <p class="title-of-graph">学習言語</p>
                <canvas id="myDoughnutChart1"></canvas>
                <div id="lang-label"></div>
            </div>
            <div class="learning-content" id="learning-cont">
                <p class="title-of-graph">学習コンテンツ</p>
                <canvas id="myDoughnutChart2"></canvas>
                <div id="cont-label"></div>
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
                            <div><input type="text" id="calender-input" name="date"><i id="calender-icon" class="far fa-calendar-alt calender"></i></div>
                        </div>
                        <div class="modal-learning-content">
                            <p>学習コンテンツ(複数選択可)</p>
                            <div id="content" class="checkboxes">
                                <div class="label"></div><div class="content"><input type="checkbox" id="content1" class="content" name="content" value="N予備校"><label for="content1">N予備校</label></div>
                                <div class="label"></div><div class="content"><input type="checkbox" id="content2" class="content" name="content" value="ドットインストール"><label for="content2">ドットインストール</label></div>
                                <div class="label"></div><div class="content"><input type="checkbox" id="content3" class="content" name="content" value="POSSE課題"><label for="content3">POSSE課題</label></div>
                            </div>
                        </div>
                        <div class="modal-language">
                            <p>学習言語</p>
                            <div id="language" class="checkboxes">
                                <div class="label"></div><div class="content"><input type="checkbox" id="language1" name="language" value="HTML"><label for="language1">HTML</label></div>
                                <div class="label"></div><div class="content"><input type="checkbox" id="language2" name="language" value="CSS"><label for="language2">CSS</label></div>
                                <div class="label"></div><div class="content"><input type="checkbox" id="language3" name="language" value="JavaScript"><label for="language3">JavaScript</label></div>
                                <div class="label"></div><div class="content"><input type="checkbox" id="language4" name="language" value="PHP"><label for="language4">PHP</label></div>
                                <div class="label"></div><div class="content"><input type="checkbox" id="language5" name="language" value="Laravel"><label for="language5">Laravel</label></div>
                                <div class="label"></div><div class="content"><input type="checkbox" id="language6" name="language" value="SQL"><label for="language6">SQL</label></div>
                                <div class="label"></div><div class="content"><input type="checkbox" id="language7" name="language" value="SHELL"><label for="language7">SHELL</label></div>
                                <div class="label"></div><div class="content"><input type="checkbox" id="language8" name="language" value="情報システム基礎知識"><label for="language8">情報システム基礎知識</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-rightcontent">
                        <div class="modal-time">
                            <p>学習時間</p>
                            <input type="text" class="modal-time-learning" id="time" name="study-time">
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
                <input type="submit" id="modal-submit" class="button" value="記録・投稿">
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
        let ctx = document.getElementById("myBarChart").getContext('2d');

        let gradient = ctx.createLinearGradient(0,0,0,600);
        gradient.addColorStop(0, "#00d2ff");
        gradient.addColorStop(1, "#928dab");
        //phpでDBから配列を取り出してjsに渡す
        let selectedBarData = <?= json_encode($bar_data); ?>;
        //学習時間の型をstringからnumberに変換
        for(let i = 0;i < selectedBarData.length;i++){
            selectedBarData[i]['learning_time'] = Number(selectedBarData[i]['learning_time']);
        }
        let barData = Array(30);
        //配列の初期化
        for(let i = 0;i < 30;i++){
            barData[i] = 0;
        }
        selectedBarData.forEach(data => {
            let index = data['date'] - 1; //1日は配列の0番目..という風に番号がずれるため1引く
            barData[index] = data['learning_time'];
        });
        function showBarChart(){
            let myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
            //凡例のラベル
                labels: ['','2','','4','','6','','8','','10','','12','','14','','16','','18','','20','','22','','24','','26','','28','','30'],
                datasets: [
                    {
                        label: "学習時間",
                        data: barData, //グラフのデータ
                        backgroundColor: gradient,
                        borderColor: gradient,
                        borderWidth: 1,
                        barThickness: 30,
                        borderRadius: 5,
                        hoverBackgroundColor: gradient,
                        hoverBorderColor: gradient,
                    }
                ],
            },
            options: {
                legend: {
                    display:false
                },
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
                            suggestedMax: 12, //最大値
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
            },
            });
        }
        showBarChart();

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
        let selectedChartData1 = <?= json_encode($lang_chart_data); ?>;
        let monthLearningTime = <?= json_encode($month_time); ?>;
        let totalLearningTime = <?= json_encode($total_time); ?>;
        monthLearningTime = Number(monthLearningTime[0]['month_learning_time']);
        totalLearningTime = Number(totalLearningTime[0]['total_learning_time']);
        let backgroundColorDataForLang = new Array(); //背景色のデータ
        let langLabel = new Array(); //言語の種類のデータ
        let chartData1 = new Array(); //学習時間のデータ
        for(let i = 0;i < chartData1.length;i++){
            chartData1[i] = 0;
        }

        selectedChartData1.forEach(data => {
            backgroundColorDataForLang.push(data['lang_color']);
            langLabel.push(data['learning_language']);
            chartData1.push(Math.floor(Number(data['lang_total_time']) * 100 * 10 / monthLearningTime) / 10);
            // let label = document.getElementById("lang-label");
            // label.classList.add("label-position");
            // let div = document.createElement("div");
            // div.classList.add("circle");
            // div.backgroundColor = data['lang_color'];
            // label.appendChild(div);
            // let p = document.createElement("p");
            // p.style.fontSize = 5;
            // p.textContent = data['learning_language'];
            // label.appendChild(p);
        })
        function showDoughnutChart1(){
            let myDoughnutChart1= new Chart(chart1, {
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: backgroundColorDataForLang,
                    data: chartData1 //グラフのデータ
                }],
                labels: langLabel
            },
            plugins: [dataLabelPlugin],
            options: {
                cutoutPercentage: 45,
                maintainAspectRatio: false,
                legend:{
                    position: "bottom",
                    // display: false,
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
        }
        showDoughnutChart1();

        let selectedChartData2 = <?= json_encode($cont_chart_data); ?>;
        for(let i = 0;i < selectedChartData2.length;i++){
            selectedChartData2[i]['cont_total_time'] = Number(selectedChartData2[i]['cont_total_time']);
        }
        let backgroundColorDataForCont = new Array(); //背景色のデータ
        let contLabel = new Array(); //コンテンツの種類のデータ
        let chartData2 = new Array(); //学習時間のデータ
        for(let i = 0;i < chartData2.length;i++){
            chartData2[i] = 0;
        }
        selectedChartData2.forEach(data => {
            backgroundColorDataForCont.push(data['cont_color']);
            contLabel.push(data['learning_content']);
            chartData2.push(Math.floor(Number(data['cont_total_time']) * 100 * 10 / monthLearningTime) / 10);
        })
        let chart2 = document.getElementById("myDoughnutChart2");

        function showDoughnutChart2(){
            let myDoughnutChart2= new Chart(chart2, {
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: backgroundColorDataForCont,
                    data: chartData2 //グラフのデータ
                }],
                labels: contLabel
            },
            plugins: [dataLabelPlugin],
            options: {
                cutoutPercentage: 45,
                maintainAspectRatio: false,
                legend:{
                    position: "bottom",
                    // display: false,
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
        }
        showDoughnutChart2();

        //自動リロード
        function doReload(){
            window.location.reload;
        }

        //モーダルページ消える関数
        function disappearModal(){
            modalSubmit.style.display = 'none';
            modal.style.display = 'none';
        }

        //モーダルページの記録・投稿ボタンを押したときの処理
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
            setTimeout(disappearModal,4000);
            setTimeout(doReload, 5000);
            let year = Number(chosenCalender.value.substr(0,4));
            let month = chosenCalender.value.substr(5,2);
            let day = chosenCalender.value.substr(8,2);
            if(month[0] == '0'){
                month = Number(month[1]);
            }else{
                month = Number(month);
            }
            if(day[0] == '0'){
                day = Number(day[1]);
            }else{
                day = Number(day);
            }
            const time = Number(document.getElementById("time").value);
            barData[day - 1] += time;
            monthLearningTime += time;
            totalLearningTime += time;
            setTimeout(showBarChart,5000);
            const language = document.getElementsByName("language");
            const checkedLanguage = [];
            for(let i = 0;i < language.length;i++){
                if(language[i].checked){
                    checkedLanguage.push(language[i].value);
                }
            }
            if(langLabel.indexOf(checkedLanguage[0]) != -1){
                for(let i = 0;i < langLabel.length;i++){
                    if(i == langLabel.indexOf(checkedLanguage[0])){
                        chartData1[i] = Math.floor(((chartData1[i] * (monthLearningTime - time) /100) + time) * 100 * 10 / monthLearningTime) / 10;
                    }else{
                        chartData1[i] = Math.floor((chartData1[i] * (monthLearningTime - time) /100) * 100 * 10 / monthLearningTime) / 10;
                    }
                }
            }else{
                for(let i = 0;i < langLabel.length;i++){
                    chartData1[i] = Math.floor((chartData1[i] * (monthLearningTime - time) /100) * 100 * 10 / monthLearningTime) / 10;
                }
                let color;
                switch(checkedLanguage[0]){
                    case 'HTML':
                        color = '0042E5';
                        break;
                    case 'CSS':
                        color = '#0070B9';
                        break;
                    case 'JavaScript':
                        color = '#00BDDB';
                        break;
                    case 'PHP':
                        color = '#08CDFA';
                        break;
                    case 'Laravel':
                        color = '#B29DEF';
                        break;
                    case 'SQL':
                        color = '#6C43E5';
                        break;
                    case 'SHELL':
                        color = '#4609E8';
                        break;
                    default:
                        color = '#2D00BA';
                        break;
                }
                backgroundColorDataForLang.push(color);
                langLabel.push(checkedLanguage[0]);
                chartData1.push(Math.floor(time * 100 * 10 / monthLearningTime) / 10);
            }
            setTimeout(showDoughnutChart1,5000);
            const content = document.getElementsByName("content");
            const checkedContent = [];
            for(let i = 0;i < content.length;i++){
                if(content[i].checked){
                    checkedContent.push(content[i].value);
                }
            }
            if(contLabel.indexOf(checkedContent[0]) != -1){
                for(let i = 0;i < contLabel.length;i++){
                    if(i == contLabel.indexOf(checkedContent[0])){
                        chartData2[i] = Math.floor(((chartData2[i] * (monthLearningTime - time) /100) + time) * 100 * 10 / monthLearningTime) / 10;
                    }else{
                        chartData2[i] = Math.floor((chartData2[i] * (monthLearningTime - time) /100) * 100 * 10 / monthLearningTime) / 10;
                    }
                }
            }else{
                for(let i = 0;i < contLabel.length;i++){
                    chartData2[i] = Math.floor((chartData2[i] * (monthLearningTime - time) /100) * 100 * 10 / monthLearningTime) / 10;
                }
                let color;
                switch(checkedContent[0]){
                    case 'ドットインストール':
                        color = '#0042E5';
                        break;
                    case 'N予備校':
                        color = '#0070B9';
                        break;
                    default:
                        color = '#00BDDB';
                        break;
                }
                backgroundColorDataForCont.push(color);
                contLabel.push(checkedContent[0]);
                chartData2.push(Math.floor(time * 100 * 10 / monthLearningTime) / 10);
            }
            setTimeout(showDoughnutChart2,5000);

            let date = new Date();
            let thisYear = date.getFullYear();
            console.log(thisYear);
            let thisMonth;
            if(date.getMonth()+1 > 0 && date.getMonth()+1 < 10){
                thisMonth = '0' + `${date.getMonth() + 1}`;
            }else{
                thisMonth = date.getMonth() + 1;
            }
            console.log(thisMonth);
            let thisDay;
            if(date.getDate() > 0 && date.getDate() < 10){
                thisDay = '0' + `${date.getDate()}`;
            }else{
                thisDay = date.getDate();
            }
            console.log(thisDay);
            setTimeout(() => {
                document.getElementById('check-mark').style.display = 'none';
                if(chosenCalender.value == `${thisYear}年${thisMonth}月${thisDay}日`){
                    document.getElementById("today").textContent = Number(document.getElementById("today").textContent) + time;
                }
                document.getElementById("month").textContent = monthLearningTime;
                document.getElementById("total").textContent = totalLearningTime;
                chosenCalender.value = '';
                for(let i = 0;i < language.length;i++){
                    language[i].checked = false;
                }
                for(let i = 0;i < content.length;i++){
                    content[i].checked = false;
                }
                document.getElementById("time").value = '';
            },5000);
        })

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
            if((month > 0 && month < 10) && (count > 0 && count < 10)){
                chosenCalender.value = `${year}年0${month}月0${count}日`;
            }else if(month > 0 && month < 10){
                chosenCalender.value = `${year}年0${month}月${count}日`;
            }else if(count > 0 && count < 10){
                chosenCalender.value = `${year}年${month}月0${count}日`;
            }else{
                chosenCalender.value = `${year}年${month}月${count}日`;
            }
        }
    </script>
</body>
</html>