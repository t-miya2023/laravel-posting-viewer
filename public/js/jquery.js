
//星マークの変換

$(document).ready(function() {
    $('.rating i').on('click', function() {
        const rating = parseInt($(this).data('rating'));//data-rating属性の値を取得し、それを整数に変換してrating変数に格納
        $('#rating').val(rating); // 評価を隠しフィールドに設定
        highlightStars(rating); // 選択された星を強調表示
    });

    $('.rating i').on('mouseover', function() {
        const rating = parseInt($(this).data('rating'));
        highlightStars(rating); // マウスオーバーで星を強調表示
    });

    $('.rating i').on('mouseout', function() {
        const currentRating = parseInt($('#rating').val());
        highlightStars(currentRating); // マウスアウト時に選択された星を強調表示
    });

    function highlightStars(rating) {
        $('.rating i').each(function() {
            const starRating = parseInt($(this).data('rating'));
            if (starRating <= rating) {
                $(this).addClass('bi-star-fill').removeClass('bi-star');
            } else {
                $(this).removeClass('bi-star-fill').addClass('bi-star');
            }
        });
    }
});