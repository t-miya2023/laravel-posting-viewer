document.querySelector('#api-address').addEventListener('click', () => {
    //郵便番号を入力するテキストフィールドから値を取得
    const elem = document.querySelector('#zip');
    const zip = elem.value;

    //fetchでAPIからJSON文字列を取得する
    fetch('../../../api/address/' + zip)
        .then((data) => data.json())
        .then((obj) => {
            //郵便番号が存在しない場合，空のオブジェクトが返ってくる
            //オブジェクトが空かどうかを判定
            if (!Object.keys(obj).length) {
                //オブジェクトが空の場合
                txt = '住所が存在しません。'
            } else {
                //オブジェクトが存在する場合
                //住所は分割されたデータとして返ってくるので連結する
                pref = obj.pref;
                txt = obj.city + obj.town;
            }
            //住所を入力するテキストフィールドに文字列を書き込む
            document.querySelector('#prefecture').value = pref;
            document.querySelector('#address').value = txt;
        });
    });