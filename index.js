'use strict';

const modal = document.getElementById('modal');
document.getElementById('submit').addEventListener('click', () => {
  modal.style.display = 'block';
})

document.getElementById('back-button').addEventListener('click', () => {
  modal.style.display = 'none';
})