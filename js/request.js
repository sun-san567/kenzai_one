const showFormButton = document.querySelector("#showFormButton"); // 案件登録
const cancelButton = document.querySelector("#cancelButton"); // キャンセル
const modalOverlay = document.querySelector("#modalOverlay"); // モーダル

// 新規案件登録ボタンのクリックイベント
showFormButton.addEventListener("click", function () {
  modalOverlay.style.display = "flex";
});

// キャンセルボタンのクリックイベント
cancelButton.addEventListener("click", function () {
  modalOverlay.style.display = "none";
});

// モーダルオーバーレイのクリックイベント
modalOverlay.addEventListener("click", function (e) {
  if (e.target === this) {
    this.style.display = "none";
  }
});

// ハンバーガーメニューボタンがクリックされたときにis-activeクラスを切り替え、メニューの表示・非表示を制御します。
document.querySelector('.menu-btn').addEventListener('click', function() {
    document.querySelector('.menu-list').classList.toggle('is-active');
  });