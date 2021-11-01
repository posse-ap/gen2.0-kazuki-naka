'use strict';

const modal = document.getElementById('modal');
const modalSubmit = document.getElementById('modal-submit');
const modalContent = document.getElementById('modal-content');
const spinner = document.getElementById('spinner');
const closeButton = document.getElementById('close-button');
const backButton = document.getElementById('back-button');
const calender = document.getElementById('calender-wrapper');
const decision = document.getElementById('desicion');

//トップページの記録・投稿ボタンを押したときの処理
document.getElementById('top-submit').addEventListener('click', () => {
  modalContent.style.display = 'block';
  modal.style.display = 'block';
})

//閉じるボタンを押したらトップページに戻る
closeButton.addEventListener('click', () => {
  modal.style.display = 'none';
  spinner.style.display = 'none';
})

//モーダルページの記録・投稿ボタンを押したらローディング画面表示
modalSubmit.addEventListener('click', () => {
  modalContent.style.display = 'none';
  spinner.style.display = 'block';
})

//カレンダーアイコンを押したらカレンダー表示
document.getElementById('calender-icon').addEventListener('click', () => {
  modalSubmit.style.display = 'none';
  modalContent.style.display = 'none';
  closeButton.style.display = 'none';
  backButton.style.display = 'block';
  calender.style.display = 'block';
})

backButton.addEventListener('click', () => {
  modalSubmit.style.display = 'block';
  modalContent.style.display = 'block';
  backButton.style.display = 'none';
  closeButton.style.display = 'block';
})

//決定ボタンを押した後の実装

const contents = ["N予備校","ドットインストール","POSSE課題"];
const content = document.getElementById('content');
for(let i = 0;i < contents.length;i++){
  const div = document.createElement('div');
  div.classList.add('content');
  div.textContent = contents[i];
  content.appendChild(div);
}

const languages = ["HTML","CSS","JavaScript","PHP","Laravel","SQL","SHELL","情報システム基礎知識(その他)"];
const language = document.getElementById('language');
for(let j = 0;j < languages.length;j++){
  const div = document.createElement('div');
  div.classList.add('content');
  div.textContent = languages[j];
  language.appendChild(div);
}

// 棒グラフの表示
let ctx = document.getElementById("myBarChart");
let myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
   //凡例のラベル
    labels: [,'2', ,'4', ,'6', ,'8', ,'10', , '12', , '14', ,'16', ,'18', ,'20', , '22', , '24', ,'26', ,'28', ,'30'],
    datasets: [
      {
        label: '学習時間', //データ項目のラベル
        data: [3,5,1,3,3,4,6,7,1,4,2,5,7,8,7,3,4,1,1,1,4,2,5,1,6,8,8,2,1,4,1], //グラフのデータ
        backgroundColor: "rgb(15,114,188)"
       }
    ]
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
        },
        gridLines: {
          drawBorder: false
        }
      }]
    },
  }
});

//円グラフの表示
var chart1 = document.getElementById("myDoughnutChart1");
var myDoughnutChart1= new Chart(chart1, {
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
            + " %"; //ここで単位を付けます
        }
      }
    }
  }
});

var chart2 = document.getElementById("myDoughnutChart2");
var myDoughnutChart2= new Chart(chart2, {
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
            + " %"; //ここで単位を付けます
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
                if(year == today.getFullYear()
                  && month == (today.getMonth())
                  && count == today.getDate()){
                    calendar += "<td class='today'>" + count + "</td>";
                } else {
                    calendar += "<td>" + count + "</td>";
                }
            }
        }
        calendar += "</tr>";
    }
    return calendar;
}