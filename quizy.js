'use strict';


const incorrectAnswer = document.getElementsByClassName('incorrectAnswer')[0];
const false1 = document.getElementById('false1');
false1.addEventListener('click',() => {
    false1.classList.add('failed');
    incorrectAnswer.textContent = '不正解です！';
    description.textContent = '正解は「たかなわ」です！';
    choice[2].classList.add('succeed');
})

const choice = document.getElementsByClassName('choice');
const false2 = document.getElementById('false2');

false2.addEventListener('click',() => {
    false2.classList.add('failed');
    incorrectAnswer.textContent = '不正解です！';
    description.textContent = '正解は「たかなわ」です！';
    choice[2].classList.add('succeed');
})


const description = document.getElementsByClassName('answerDescription')[0];
const result1 = document.getElementById('result1');
const truth = document.getElementById('true');
truth.addEventListener('click',() =>{
    truth.classList.add('succeed');
    result1.textContent = '正解です！';
    description.textContent = '正解は「たかなわ」です！';
})

