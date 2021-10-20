'use strict';

const modal = document.getElementById('modal');
document.getElementById('top-submit').addEventListener('click', () => {
  modal.style.display = 'block';
})

document.getElementById('back-button').addEventListener('click', () => {
  modal.style.display = 'none';
})

document.getElementById('modal-submit').addEventListener('click', () => {
  document.getElementById('spinner').style.display = 'block';
})
