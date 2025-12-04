/**
 * 記事の非同期読み込み
 */
const loadMoreDom = document.querySelector('#load-more');
const newsListDom = document.querySelector('.news_list');
loadMoreDom.addEventListener('click', () => {
    let page = parseInt(loadMoreDom.dataset.page);
    let postType = loadMoreDom.dataset.postType;

    const formData = new FormData();
    formData.append('action', 'load_more_posts');
    formData.append('page', page);
    formData.append('post_type', postType);

    fetch(my_ajax_object.ajax_url, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(data => {

		// 記事がないければボタンを消す
        if (data.trim() === '') {
            loadMoreDom.style.display = 'none';
            return;
        }

        newsListDom.insertAdjacentHTML('beforeend', data);
        loadMoreDom.dataset.page = page + 1; // ページ数を更新
    });
});