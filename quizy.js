'use strict';

const false1 = document.getElementById('false1');
false1.addEventListener('click',() => {
    false1.classList.add('failed1');
})

const false2 = document.getElementById('false2');
false2.addEventListener('click',() => {
    false2.classList.add('failed2');
})

const truth = document.getElementById('true');
truth.addEventListener('click',() => {
    truth.classList.add('succeed');
})

// const false1 = document.getElementById('false1');
// const false2 = document.getElementById('false2');
// if (false1 == true || false2 == true){
//     false1.addEventListener('click',() => {
//         false1.classList.add('failed1');
//     });
//     false2.addEventListener('click',() => {
//         false2.classList.add('failed2');
//     });
// }