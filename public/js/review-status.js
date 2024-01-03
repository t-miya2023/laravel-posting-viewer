
document.addEventListener('DOMContentLoaded', function () {
    const statusToggles = document.querySelectorAll('.status-toggle');

    // ページ読み込み時に各要素のクラスを設定
    statusToggles.forEach(toggle => {
        const currentStatus = JSON.parse(toggle.getAttribute('data-status'));
        toggle.className = currentStatus ? 'status-toggle btn btn-success' : 'status-toggle btn btn-danger';
    });
    //クリック時の動作
    statusToggles.forEach(toggle => {
        toggle.addEventListener('click', function () {
            const reviewId = this.getAttribute('data-review-id');
            const currentStatus = JSON.parse(this.getAttribute('data-status'));
            // ここでAjaxを使用してStatusを切り替える処理を実行する
            // 例：axiosを使用する場合
            axios.post(`reviews/toggle-status/${reviewId}`)
                .then(response => {
                    const newStatus = response.data.newStatus; // サーバーから新しいStatusを取得

                    // 新しいStatusに応じて表示を切り替え
                    this.textContent = newStatus ? '承認' : '未承認';
                    this.setAttribute('data-status', newStatus);
                    this.className = newStatus ? 'status-toggle btn btn-success' : 'status-toggle btn btn-danger';
                })
                .catch(error => {
                    console.error(error);
                });
        });
    });
});
