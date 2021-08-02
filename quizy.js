'use strict';

const choices = [
    ["たかなわ","たかわ","こうわ"],
    ["かめいど","かめと","かめど"],
    ["こうじまち","かゆまち","おかとまち"],
    ["おなりもん","おかどもん","ごせいもん"],
    ["とどろき","たたら","たたりき"],
    ["しゃくじい","せきこうい","いじい"],
    ["ざっしょく","ぞうしき","ざっしき"],
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



for (let i = 0 ; i < choices.length ; i++ ){
    let quizySet = '<div class="quizyContainer">'
                    + `<h2 class="question">${i+1}.この地名はなんて読む？</h2>`
                    + `<img src = ${pictures[i][0]} alt = ${pictures[i][1]} class="image">`
                    + `<li class="choice" id="true${i+1}">${choices[i][0]}</li>`
                    + `<li class="choice" id="false${i+1}-1">${choices[i][1]}</li>`
                    + `<li class="choice" id="false${i+1}-2">${choices[i][2]}</li>`
                    + `<div class="resultBox" id="correctbox${i+1}">`
                    + `<p class="correctAnswer" id="result${i+1}-1"></p>`
                    + `<p class="answerDescription" id="description${i+1}-1"></p>`
                    + '</div>'
                    + `<div class="resultBox" id="incorrectbox${i+1}">`
                    + `<p class="incorrectAnswer" id="result${i+1}-2"></p>`
                    + `<p class="answerDescription" id="description${i+1}-2"></p>`
                    + '</div>'
                    + '</div>';

    document.write(quizySet);
    const truth = document.getElementById(`true${i+1}`);
    const false1 = document.getElementById(`false${i+1}-1`);
    const false2 = document.getElementById(`false${i+1}-2`);
    const correctbox = document.getElementById(`correctbox${i+1}`);
    const incorrectbox = document.getElementById(`incorrectbox${i+1}`);
    const resultbox1 = document.getElementById(`result${i+1}-1`);
    const resultbox2 = document.getElementById(`result${i+1}-2`);
    const description1 = document.getElementById(`description${i+1}-1`);
    const description2 = document.getElementById(`description${i+1}-2`);
    
    truth.addEventListener('click',() =>{
        truth.classList.add('succeed'); //正解の選択肢の背景を青、文字を白にする
        correctbox.style.display = 'block'; //正解表示
        resultbox1.textContent = '正解！';
        description1.textContent = `正解は「${choices[i][0]}」です！`;
        false1.classList.add('notclick');
        false2.classList.add('notclick');
    });

    false1.addEventListener('click',() => {
        false1.classList.add('failed'); //背景が赤、文字が白に変化
        incorrectbox.style.display = 'block'; //正解表示
        resultbox2.textContent = '不正解！';
        description2.textContent = `正解は「${choices[i][0]}」です！`;
        truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
        false2.classList.add('notclick'); 
        truth.classList.add('notclick'); //他の選択肢のクリック無効化
    });

    false2.addEventListener('click',() => {
        false2.classList.add('failed'); //背景が赤、文字が白に変化
        incorrectbox.style.display = 'block'; //正解表示
        resultbox2.textContent = '不正解！';
        description2.textContent = `正解は「${choices[i][0]}」です！`;
        truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
        false1.classList.add('notclick'); 
        truth.classList.add('notclick'); //他の選択肢のクリック無効化
    });
    

}
