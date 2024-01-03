document.querySelectorAll('.review-container').forEach(function(container) {
    const reviewTextShort = container.querySelector('.reviewTextShort');
    const reviewTextFull = container.querySelector('.reviewTextFull');
    const showMoreButton = container.querySelector('.showMore');

    if (reviewTextShort && reviewTextFull && showMoreButton) {
        showMoreButton.addEventListener('click', () => {
            if (reviewTextShort.style.display === 'none') {
                reviewTextShort.style.display = 'inline';
                reviewTextFull.style.display = 'none';
                showMoreButton.innerText = '続きを読む';
            } else {
                reviewTextShort.style.display = 'none';
                reviewTextFull.style.display = 'inline';
                showMoreButton.innerText = '閉じる';
            }
        });
    }
})