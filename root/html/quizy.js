'use strict';

for (let i = 0;i < 2;i++){
    const truth = document.getElementById(`true${i}`);
    const false1 = document.getElementById(`false${i}-1`);
    const false2 = document.getElementById(`false${i}-2`);
    const resultbox = document.getElementById(`result-box${i}`); //正解の際に表示されるボックス
    const result = document.getElementById(`result${i}`); //「正解!」を表示する部分
    const description = document.getElementById(`description${i}`); //正解の場合に表示される説明文

    truth.addEventListener('click',() => {
        truth.classList.add('succeed'); //正解の選択肢の背景を青、文字を白にする
        resultbox.style.display = 'block'; //正解表示
        result.textContent = '正解！';
        description.textContent = `正解は「${truth.textContent}」です！`;
        description.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
        false1.classList.add('notclick');
        false2.classList.add('notclick'); //他の選択肢のクリック無効化
    });

    false1.addEventListener('click',() => {
        false1.classList.add('failed'); //背景が赤、文字が白に変化
        resultbox.style.display = 'block'; //正解表示
        result.textContent = '不正解！';
        result.classList.add('incorrect-answer'); //不正解の時はアンダーラインが赤になるように上書き
        description.textContent = `正解は「${truth.textContent}」です！`;
        description.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
        truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
        truth.classList.add('notclick'); //他の選択肢のクリック無効化
        false2.classList.add('notclick');
    });

    false2.addEventListener('click',() => {
        false2.classList.add('failed'); //背景が赤、文字が白に変化
        resultbox.style.display = 'block'; //正解表示
        result.textContent = '不正解！';
        result.classList.add('incorrect-answer'); //不正解の時はアンダーラインが赤になるように上書き
        description.textContent = `正解は「${truth.textContent}」です！`;
        description.scrollIntoView({behavior: 'smooth', block: 'center'}); //正解表示がブラウザの真ん中に来るように自動スクロール
        truth.classList.add('succeed'); //正解の選択肢の背景が青、文字が白
        truth.classList.add('notclick'); //他の選択肢のクリック無効化
        false1.classList.add('notclick');
    });
}