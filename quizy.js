'use strict';

const choice = document.getElementsByClassName('choice');
const incorrectAnswer = document.getElementsByClassName('incorrectAnswer')[0];
const false1 = document.getElementById('false1');
const correctbox = document.getElementById('correctbox');
const incorrectbox = document.getElementById('incorrectbox');
// const description1 = document.getElementById('description1');
// const description2 = document.getElementById('description2');

false1.addEventListener('click',() => {
    false1.classList.add('failed'); //背景が赤、文字が白に変化
    incorrectbox.style.display = 'block'; //正解表示
    incorrectAnswer.textContent = '不正解です！';
    description[1].textContent = '正解は「たかなわ」です！';
    choice[2].classList.add('succeed');
    false2.classList.add('notclick');
    truth.classList.add('notclick');
    scrollTo(0,500);
})


const false2 = document.getElementById('false2');

false2.addEventListener('click',() => {
    false2.classList.add('failed');
    incorrectbox.style.display = 'block';
    incorrectAnswer.textContent = '不正解です！';
    description[1].textContent = '正解は「たかなわ」です！';
    choice[2].classList.add('succeed');
    false1.classList.add('notclick');
    truth.classList.add('notclick');
    scrollTo(0,500);
})


const description = document.getElementsByClassName('answerDescription');
const result1 = document.getElementById('result1');
const truth = document.getElementById('true');

truth.addEventListener('click',() =>{
    truth.classList.add('succeed');
    correctbox.style.display = 'block';
    result1.textContent = '正解です！';
    description[0].textContent = '正解は「たかなわ」です！';
    false1.classList.add('notclick');
    false2.classList.add('notclick');
    scrollTo(0,500);
})





// const choices = [
//     ["たかなわ","たかわ","こうわ"],
//     ["かめいど","かめと","かめど"],
//     ["こうじまち","かゆまち","おかとまち"],
//     ["ごせいもん","おかどもん","おなりもん"],
//     ["とどろき","たたら","たたりき"],
//     ["いじい","せきこうい","しゃくじい"],
//     ["ざっしょく","ぞうしき","ざっしき"],
//     ["おかちまち","ごしろちょう","みとちょう"],
//     ["ろっこつ","ししぼね","しこね"],
//     ["こしゃく","こぐれ","こばく"],
// ];

// const pictures = [
//     ["https://d1khcm40x1j0f.cloudfront.net/quiz/34d20397a2a506fe2c1ee636dc011a07.png","高輪"],
//     ["https://d1khcm40x1j0f.cloudfront.net/quiz/512b8146e7661821c45dbb8fefedf731.png","亀戸"],
//     ["https://d1khcm40x1j0f.cloudfront.net/quiz/ad4f8badd896f1a9b527c530ebf8ac7f.png","麹町"],
//     ["https://d1khcm40x1j0f.cloudfront.net/quiz/ee645c9f43be1ab3992d121ee9e780fb.png","御成門"],
//     ["https://d1khcm40x1j0f.cloudfront.net/quiz/6a235aaa10f0bd3ca57871f76907797b.png","等々力"],
//     ["https://d1khcm40x1j0f.cloudfront.net/quiz/0b6789cf496fb75191edf1e3a6e05039.png","石神井"],
//     ["https://d1khcm40x1j0f.cloudfront.net/quiz/23e698eec548ff20a4f7969ca8823c53.png","雑色"],
//     ["https://d1khcm40x1j0f.cloudfront.net/quiz/50a753d151d35f8602d2c3e2790ea6e4.png","御徒町"],
//     ["https://d1khcm40x1j0f.cloudfront.net/words/8cad76c39c43e2b651041c6d812ea26e.png","鹿骨"],
//     ["https://d1khcm40x1j0f.cloudfront.net/words/34508ddb0789ee73471b9f17977e7c9c.png","小榑"],
// ];



// for (let i = 0;i < 10;i++){
//         let quizySet = `<h1 class="question">${i+1}.この地名はなんて読む？</h1>`
//     + `<img src = ${pictures[i][0]} alt = ${pictures[i][1]} class="image">`
//     + `<li class="choice">${choices[i][0]}</li>`
//     + `<li class="choice">${choices[i][1]}</li>`
//     + `<li class="choice">${choices[i][2]}</li>`
//     + '<div class="result" id="resultBox"></div>';
//     document.write(quizySet);

// }

