'use strict';

const false1 = document.getElementById('false1');
false1.addEventListener('click',() => {
    false1.classList.add('failed1');
})

const description2 = document.getElementById('result-description2');
const result2 = document.getElementById('result2');
const false2 = document.getElementById('false2');
false2.addEventListener('click',() => {
    false2.classList.add('failed2');
    result2.textContent = '不正解です！';
    description2.textContent = '正解は「たかなわ」です！';
})

const description1 = document.getElementById('result-description1');
const result1 = document.getElementById('result1');
const truth = document.getElementById('true');
truth.addEventListener('click',() => {
    truth.classList.add('succeed');
    result1.textContent = '正解です！';
    description1.textContent = '正解は「たかなわ」です！';
})

