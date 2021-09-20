'use strict';

const choices = [
    ["たかなわ","たかわ","こうわ"],
    ["かめいど","かめと","かめど"],
    ["こうじまち","かゆまち","おかとまち"],
    ["おなりもん","おかどもん","ごせいもん"],
    ["とどろき","たたら","たたりき"],
    ["しゃくじい","せきこうい","いじい"],
    ["ぞうしき","ざっしょく","ざっしき"],
    ["おかちまち","ごしろちょう","みとちょう"],
    ["ししぼね","ろっこつ","しこね"],
    ["こぐれ","こしゃく","こばく"],
];

const pictures = [
    ["img/picture1.png","高輪"],
    ["img/picture2.png","亀戸"],
    ["img/picture3.png","麹町"],
    ["img/picture4.png","御成門"],
    ["img/picture5.png","等々力"],
    ["img/picture6.png","石神井"],
    ["img/picture7.png","雑色"],
    ["img/picture8.png","御徒町"],
    ["img/picture9.png","鹿骨"],
    ["img/picture10.png","小榑"],
];

//シャッフル関数
function shuffle(arr){
    for (let i = arr.length - 1;i > 0;i--){
        const j = Math.floor(Math.random() * (i + 1));
        [arr[j],arr[i]] = [arr[i],arr[j]];
    }
    return arr;
}

for (let i = 0 ; i < choices.length ; i++ ){
    const shuffleChoices = shuffle([...choices[i]]); //シャッフルした選択肢を要素とする新たな配列
    let quizySet =  `<h2 class="question">${i+1}.この地名はなんて読む？</h2>`
                    + `<img src = ${pictures[i][0]} alt = ${pictures[i][1]} class="image">`
                    + `<ul class="quizy-selection" id="selection${i+1}">`
                    + '</ul>'
                    + `<div class="result-box" id="result-box${i+1}">`
                    + `<p class="answer" id="result${i+1}"></p>`
                    + `<p class="answer-description" id="description${i+1}"></p>`
                    + '</div>'
             
    document.getElementById('quizy-container').insertAdjacentHTML('beforeend', quizySet);

    //ulに子要素であるliを追加して中身をシャッフルした選択肢にする&各選択肢に適切なclassとidをつける
    shuffleChoices.forEach(shuffleChoice => {
        const selection = document.getElementById(`selection${i+1}`);
        const li = document.createElement('li');
        li.className = 'choice';
        li.textContent = shuffleChoice;
        switch(shuffleChoice){
            case `${choices[i][0]}`:
                li.id = `true${i+1}`;
                break;
            case `${choices[i][1]}`:
                li.id = `false${i+1}-1`;
                break;
            default:
                li.id = `false${i+1}-2`;
        }
        selection.appendChild(li);
    })

    const truth = document.getElementById(`true${i+1}`);
    const false1 = document.getElementById(`false${i+1}-1`);
    const false2 = document.getElementById(`false${i+1}-2`);
    const resultbox = document.getElementById(`result-box${i+1}`); //正解の際に表示されるボックス
    const result = document.getElementById(`result${i+1}`); //「正解!」を表示する部分
    const description = document.getElementById(`description${i+1}`); //正解の場合に表示される説明文

    //鹿骨だけは正解表示が異なるため条件分岐する
    if (i == 8){
        truth.addEventListener('click',() => {
            truth.classList.add('succeed'); //正解の選択肢の背景を青、文字を白にする
            resultbox.style.display = 'block'; //正解表示
            result.textContent = '正解！';
            description.textContent = '江戸川区にあります。';
            description.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            false1.classList.add('notclick');
            false2.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    
        false1.addEventListener('click',() => {
            false1.classList.add('failed'); //背景が赤、文字が白に変化
            resultbox.style.display = 'block'; //正解表示
            result.textContent = '不正解！';
            result.classList.add('incorrect-answer'); //不正解の時はアンダーラインが赤になるように上書き
            description.textContent = '江戸川区にあります。';
            description.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
            false2.classList.add('notclick'); 
            truth.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    
        false2.addEventListener('click',() => {
            false2.classList.add('failed'); //背景が赤、文字が白に変化
            resultbox.style.display = 'block'; //正解表示
            result.textContent = '不正解！';
            result.classList.add('incorrect-answer'); //不正解の時はアンダーラインが赤になるように上書き
            description.textContent = '江戸川区にあります。';
            description.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
            false1.classList.add('notclick'); 
            truth.classList.add('notclick'); //他の選択肢のクリック無効化
        });

    }else{
        truth.addEventListener('click',() => {
            truth.classList.add('succeed'); //正解の選択肢の背景を青、文字を白にする
            resultbox.style.display = 'block'; //正解表示
            result.textContent = '正解！';
            description.textContent = `正解は「${choices[i][0]}」です！`;
            description.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            false1.classList.add('notclick');
            false2.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    
        false1.addEventListener('click',() => {
            false1.classList.add('failed'); //背景が赤、文字が白に変化
            resultbox.style.display = 'block'; //正解表示
            result.textContent = '不正解！';
            result.classList.add('incorrect-answer'); //不正解の時はアンダーラインが赤になるように上書き
            description.textContent = `正解は「${choices[i][0]}」です！`;
            description.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
            false2.classList.add('notclick'); 
            truth.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    
        false2.addEventListener('click',() => {
            false2.classList.add('failed'); //背景が赤、文字が白に変化
            resultbox.style.display = 'block'; //正解表示
            result.textContent = '不正解！';
            result.classList.add('incorrect-answer'); //不正解の時はアンダーラインが赤になるように上書き
            description.textContent = `正解は「${choices[i][0]}」です！`;
            description.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
            false1.classList.add('notclick'); 
            truth.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    };
}