document.querySelector('#addition-btn').addEventListener('click', () => {
    // 新しい行（row）を生成
    var newRow = document.createElement('div');
    newRow.classList.add('row');
    var submitButton = document.querySelector('#submit-btn');

    // メニュー名入力フィールドを生成
    var menuInput = document.createElement('div');
    menuInput.classList.add('mb-2', 'col-md-8');
    menuInput.innerHTML = `
        <label class="form-label" for="menu[]">メニュー名</label>
        <input class="form-control" type="text" name="menu[]">
    `;

    // 価格入力フィールドを生成
    var priceInput = document.createElement('div');
    priceInput.classList.add('mb-2', 'col-md-4');
    priceInput.innerHTML = `
        <label class="form-label" for="price[]">価格</label>
        <input class="form-control" type="text" name="price[]">
    `;

    // 新しい行をフォームに追加
    submitButton.parentNode.insertBefore(newRow, submitButton);

    // メニュー名入力フィールドと価格入力フィールドを新しい行に追加
    newRow.appendChild(menuInput);
    newRow.appendChild(priceInput);
})