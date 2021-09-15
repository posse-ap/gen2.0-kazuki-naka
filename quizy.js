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
    ["https://d1khcm40x1j0f.cloudfront.net/quiz/34d20397a2a506fe2c1ee636dc011a07.png","高輪"],
    ["https://d1khcm40x1j0f.cloudfront.net/quiz/512b8146e7661821c45dbb8fefedf731.png","亀戸"],
    ["https://d1khcm40x1j0f.cloudfront.net/quiz/ad4f8badd896f1a9b527c530ebf8ac7f.png","麹町"],
    ["https://d1khcm40x1j0f.cloudfront.net/quiz/ee645c9f43be1ab3992d121ee9e780fb.png","御成門"],
    ["https://d1khcm40x1j0f.cloudfront.net/quiz/6a235aaa10f0bd3ca57871f76907797b.png","等々力"],
    ["https://d1khcm40x1j0f.cloudfront.net/quiz/0b6789cf496fb75191edf1e3a6e05039.png","石神井"],
    ["https://d1khcm40x1j0f.cloudfront.net/quiz/23e698eec548ff20a4f7969ca8823c53.png","雑色"],
    ["https://d1khcm40x1j0f.cloudfront.net/quiz/50a753d151d35f8602d2c3e2790ea6e4.png","御徒町"],
    ["https://d1khcm40x1j0f.cloudfront.net/words/8cad76c39c43e2b651041c6d812ea26e.png","鹿骨"],
    ["https://d1khcm40x1j0f.cloudfront.net/words/34508ddb0789ee73471b9f17977e7c9c.png","小榑"],
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
                    + `<div class="result-box" id="correctbox${i+1}">`
                    + `<p class="correct-answer" id="result${i+1}-1"></p>`
                    + `<p class="answer-description" id="description${i+1}-1"></p>`
                    + '</div>'
                    + `<div class="result-box" id="incorrectbox${i+1}">`
                    + `<p class="incorrect-answer" id="result${i+1}-2"></p>`
                    + `<p class="answer-description" id="description${i+1}-2"></p>`
                    + '</div>';
             
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
    const correctbox = document.getElementById(`correctbox${i+1}`); //正解の際に表示されるボックス
    const incorrectbox = document.getElementById(`incorrectbox${i+1}`); //不正解の際に表示されるボックス
    const resultbox1 = document.getElementById(`result${i+1}-1`); //「正解!」を表示する部分
    const resultbox2 = document.getElementById(`result${i+1}-2`); //「不正解！」を表示する部分
    const description1 = document.getElementById(`description${i+1}-1`); //正解の場合に表示される説明文
    const description2 = document.getElementById(`description${i+1}-2`); //不正解の場合に表示される説明文

    //鹿骨だけは正解表示が異なるため条件分岐する
    if (i == 8){
        truth.addEventListener('click',() => {
            truth.classList.add('succeed'); //正解の選択肢の背景を青、文字を白にする
            correctbox.style.display = 'block'; //正解表示
            resultbox1.textContent = '正解！';
            description1.textContent = '江戸川区にあります。';
            description1.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            false1.classList.add('notclick');
            false2.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    
        false1.addEventListener('click',() => {
            false1.classList.add('failed'); //背景が赤、文字が白に変化
            incorrectbox.style.display = 'block'; //正解表示
            resultbox2.textContent = '不正解！';
            description2.textContent = '江戸川区にあります。';
            description2.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
            false2.classList.add('notclick'); 
            truth.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    
        false2.addEventListener('click',() => {
            false2.classList.add('failed'); //背景が赤、文字が白に変化
            incorrectbox.style.display = 'block'; //正解表示
            resultbox2.textContent = '不正解！';
            description2.textContent = '江戸川区にあります。';
            description2.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
            false1.classList.add('notclick'); 
            truth.classList.add('notclick'); //他の選択肢のクリック無効化
        });

    }else{
        truth.addEventListener('click',() => {
            truth.classList.add('succeed'); //正解の選択肢の背景を青、文字を白にする
            correctbox.style.display = 'block'; //正解表示
            resultbox1.textContent = '正解！';
            description1.textContent = `正解は「${choices[i][0]}」です！`;
            description1.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            false1.classList.add('notclick');
            false2.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    
        false1.addEventListener('click',() => {
            false1.classList.add('failed'); //背景が赤、文字が白に変化
            incorrectbox.style.display = 'block'; //正解表示
            resultbox2.textContent = '不正解！';
            description2.textContent = `正解は「${choices[i][0]}」です！`;
            description2.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
            false2.classList.add('notclick'); 
            truth.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    
        false2.addEventListener('click',() => {
            false2.classList.add('failed'); //背景が赤、文字が白に変化
            incorrectbox.style.display = 'block'; //正解表示
            resultbox2.textContent = '不正解！';
            description2.textContent = `正解は「${choices[i][0]}」です！`;
            description2.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
            truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
            false1.classList.add('notclick'); 
            truth.classList.add('notclick'); //他の選択肢のクリック無効化
        });
    };
}