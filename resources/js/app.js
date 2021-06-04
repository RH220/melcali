require('./bootstrap');
import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { faAddressCard, faClock } from '@fortawesome/free-regular-svg-icons'
import { faSearch, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faCamera } from '@fortawesome/free-solid-svg-icons'

library.add(faSearch, faAddressCard, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faClock, faCamera);

dom.watch();
// プレビューを表示
// image-pickerクラスの配下にあるinputタグのDOMを取得しています。
document.querySelector('.image-picker input')
.addEventListener('change', (e) => {
    // ここに画像が選択された時の処理を記述する
    // e.targetでイベントが発生したDOMを取得できます。
    const input = e.target;
    // FileReaderクラスのインスタンスを作成します。
    const reader = new FileReader();
    reader.onload = (e) => {
        // imgタグのsrc属性を更新するために、imgタグのDOMを取得します。
        // 読み込んだ結果(e.target.result)には画像データを
        // base64エンコードしてData URL形式にした文字列が格納されています。
        input.closest('.image-picker').querySelector('img').src = e.target.result
    };
    // readAsDataURLメソッドで画像の読み込みを開始します。
    reader.readAsDataURL(input.files[0]);
});