
//絞り込みリセットボタン

document.querySelector('#reset-btn').addEventListener('click', () => {
    // フォームをリセット
    document.querySelector('#shop_name').value = '';
    document.querySelector('#title').value = '';
    document.querySelector('#search_address').value = '';
    // フォームを送信（リセットボタンのデフォルトの動作を防ぐ）
    document.querySelector('#search-form').submit();
});
