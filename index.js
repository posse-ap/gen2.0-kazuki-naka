'use strict';

const modal = document.getElementById('modal');
const modalSubmit = document.getElementById('modal-submit');
const modalContent = document.getElementById('modal-content');
const spinner = document.getElementById('spinner');
const closeButton = document.getElementById('close-button');
const backButton = document.getElementById('back-button');

//トップページの記録・投稿ボタンを押したときの処理//
document.getElementById('top-submit').addEventListener('click', () => {
  modalContent.style.display = 'block';
  modal.style.display = 'block';
})

//閉じるボタンを押したらトップページに戻る
closeButton.addEventListener('click', () => {
  modal.style.display = 'none';
  spinner.style.display = 'none';
})

//モーダルページの記録・投稿ボタンを押したらローディング画面表示
modalSubmit.addEventListener('click', () => {
  modalContent.style.display = 'none';
  spinner.style.display = 'block';
})

//カレンダーアイコンを押したらカレンダー表示
document.getElementById('calender').addEventListener('click', () => {
  modalContent.style.display = 'none';
  closeButton.style.display = 'none';
  backButton.style.display = 'block';
})

backButton.addEventListener('click', () => {
  modalContent.style.display = 'block';
  backButton.style.display = 'none';
  closeButton.style.display = 'block';
})

const contents = ["N予備校","ドットインストール","POSSE課題"];
const content = document.getElementById('content');
for(let i = 0;i < contents.length;i++){
  const div = document.createElement('div');
  div.classList.add('content');
  div.textContent = contents[i];
  content.appendChild(div);
}

const languages = ["HTML","CSS","JavaScript","PHP","Laravel","SQL","SHELL","情報システム基礎知識(その他)"];
const language = document.getElementById('language');
for(let j = 0;j < languages.length;j++){
  const div = document.createElement('div');
  div.classList.add('content');
  div.textContent = languages[j];
  language.appendChild(div);
}