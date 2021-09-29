'use strict';

const choices = [
    ["たかなわ","こうわ","たかわ"],
    ["かめいど","かめと","かめど"],
    ["こうじまち","かゆまち","おかとまち"],
    ["おなりもん","おかどもん","ごせいもん"],
    ["とどろき","たたりき","たたら"],
    ["しゃくじい","せきこうい","いじい"],
    ["ぞうしき","ざっしき","ざっしょく"],
    ["おかちまち","ごしろちょう","みとちょう"],
    ["ししぼね","ろっこつ","しこね"],
    ["こぐれ","こしゃく","こばく"],
];

const pictures = [
    ["img/picture1.png", "高輪"],
    ["img/picture2.png", "亀戸"],
    ["img/picture3.png", "麹町"],
    ["img/picture4.png", "御成門"],
    ["img/picture5.png", "等々力"],
    ["img/picture6.png", "石神井"],
    ["img/picture7.png", "雑色"],
    ["img/picture8.png", "御徒町"],
    ["img/picture9.png", "鹿骨"],
    ["img/picture10.png", "小榑"],
];

function shuffle(arr){
    for(let i = arr.length - 1; i > 0; i--){
        const j = Math.floor(Math.random() * (i + 1));
        [arr[j], arr[i]] = [arr[i], arr[j]];
        return arr;
    };
}

for(let i = 0; i < choices.length; i++){
    const shuffleChoices = shuffle([...choices[i]]);
    const contents = `<h2>${i + 1}.この地名はなんて読む？</h2>`
                    + `<img src = ${pictures[i][0]} alt = ${pictures[i][1]} class = "image">`
                    + `<ul id="selection${i + 1}"></ul>`
                    + `<div class="box" id="answerbox${i + 1}">`
                    + `<p id="answer${i + 1}"></p>`
                    + `<p id="description${i + 1}" class="description"></p>`
                    + '</div>'

    document.getElementById('main').insertAdjacentHTML('beforeend', contents);

    const selection = document.getElementById(`selection${i + 1}`);

    shuffleChoices.forEach(shuffleChoice => {
        const li = document.createElement('li');
        li.textContent = shuffleChoice;
        li.className = "choice";
        switch(shuffleChoice){
            case `${choices[i][0]}`:
                li.id = `true${i + 1}`;
                break;
            case `${choices[i][1]}`:
                li.id = `false${i + 1}-1`;
                break;
            default:
                li.id = `false${i + 1}-2`;
        }
        selection.appendChild(li);
    })

    const truth = document.getElementById(`true${i + 1}`);
    const false1 = document.getElementById(`false${i + 1}-1`);
    const false2 = document.getElementById(`false${i + 1}-2`);
    const answerbox = document.getElementById(`answerbox${i + 1}`);
    const answer = document.getElementById(`answer${i + 1}`);
    const description = document.getElementById(`description${i + 1}`);

    function textContent(){
        if(i == 8){
            description.textContent = `江戸川区にあります。`;
        }else{
            description.textContent = `正解は「${choices[i][0]}」です！`;
        }
    }

    truth.addEventListener('click', () => {
        truth.classList.add('succeed');
        answerbox.style.display = "block";
        answer.textContent = "正解！";
        answer.classList.add('correct-answer');
        textContent();
        description.scrollIntoView({behavior: "smooth", block: "center"});
        false1.classList.add('notclick');
        false2.classList.add('notclick');
    });
    false1.addEventListener('click', () => {
        truth.classList.add('succeed');
        false1.classList.add('failed');
        answerbox.style.display = "block";
        answer.textContent = "不正解！";
        answer.classList.add('incorrect-answer');
        textContent();
        description.scrollIntoView({behavior: "smooth", block: "center"});
        truth.classList.add('notclick');
        false2.classList.add('notclick');
    });
    false2.addEventListener('click', () => {
        truth.classList.add('succeed');
        false2.classList.add('failed');
        answerbox.style.display = "block";
        answer.textContent = "不正解！";
        answer.classList.add('incorrect-answer');
        textContent();
        description.scrollIntoView({behavior: "smooth", block: "center"});
        false1.classList.add('notclick');
        truth.classList.add('notclick');
    });
}