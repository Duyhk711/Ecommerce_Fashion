@extends('layouts.client')
@section('css')
<style>
    article img{
        max-width: 100%;
        height: 200px;
    }
</style>
@endsection

@section('content')
@include('client.component.page_header')

<div class="container">
    <!--Toolbar-->
    <div class="toolbar toolbar-wrapper blog-toolbar">
        <div class="row align-items-center">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 text-left filters-toolbar-item d-flex justify-content-center justify-content-sm-start">
                <div class="search-form mb-3 mb-sm-0">
                    <form class="d-flex" action="#">
                        <input class="search-input" type="text" placeholder="Blog search...">
                        <button type="submit" class="search-btn"><i class="icon anm anm-search-l"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 text-right filters-toolbar-item d-flex justify-content-between justify-content-sm-end">
                <div class="filters-item d-flex align-items-center">
                    <label for="ShowBy" class="mb-0 me-2">Show:</label>
                    <select name="ShowBy" id="ShowBy" class="filters-toolbar-sort">
                        <option value="title-ascending" selected="selected">10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>25</option>
                        <option>30</option>
                    </select>
                </div>
                <div class="filters-item d-flex align-items-center ms-3">
                    <label for="SortBy" class="mb-0 me-2">Sort:</label>
                    <select name="SortBy" id="SortBy" class="filters-toolbar-sort">
                        <option value="title-ascending" selected="selected">Featured</option>
                        <option>Newest</option>
                        <option>Most comments</option>
                        <option>Release Date</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!--End Toolbar-->

    <!--Blog Grid-->
    <div class="blog-grid-view">
        <div id="blog-container" class="row col-row row-cols-lg-3 row-cols-sm-2 row-cols-1">

        </div>

        <!-- Pagination -->
        <nav class="clearfix pagination-bottom">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#"><i class="icon anm anm-angle-left-l"></i></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="icon anm anm-angle-right-l"></i></a></li>
            </ul>
        </nav>
        <!-- End Pagination -->
    </div>
    <!--End Blog Grid-->
</div>

@endsection
@section('js')
<script>
    const apiKey = 'a046cdd5c3d946f1bea4b8e1cfb4e68f';
    const apiUrl = `https://newsapi.org/v2/everything?q=fashion&apiKey=${apiKey}`;
    const blogContainer = document.getElementById('blog-container');

    async function fetchFashionArticles() {
        try {
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error(` error!: ${response.status}`);
            }
            const data = await response.json();
            if (data.articles && data.articles.length > 0) {
                displayArticles(data.articles);
            } else {

                blogContainer.innerHTML = '<p>Không tìm thấy bài viết nào.</p>';
            }
        } catch (error) {
            console.error('Lỗi khi tải bài viết:', error);
            blogContainer.innerHTML = `<p>Không thể tải bài viết.</p>`;
        }
    }

    function displayArticles(articles) {

        blogContainer.innerHTML = '';


        if (!articles || articles.length === 0) {
            blogContainer.innerHTML = '<p>Không có dữ liệu để hiển thị.</p>';
            return;
        }


        articles.forEach(article => {
            if (article.title && article.url && article.urlToImage && article.description) {
                const articleElement = document.createElement('article');
                articleElement.classList.add('col-item');
                articleElement.innerHTML = `
            <div class="blog-item col-item">
                <div class="blog-article zoomscal-hov">
                    <div class="blog-img">
                      <a class="featured-image rounded-0 zoom-scal" href="${article.url}" target="_blank"><img class="rounded-0 blur-up lazyload" data-src="${article.urlToImage}" src="${article.urlToImage}" alt="${article.title}" width="740" height="410" /></a>
                    </div>
                    <div class="blog-content">
                            <h2 class="h3"><a href="${article.url}" target="_blank">${article.title}</a></h2>
                                <ul class="publish-detail d-flex-wrap">
                                    <li><i class="icon anm anm-user-al"></i> <span class="opacity-75 me-1">Posted by:</span> ${article.author || 'Lỗi'}</li>
                                    <li><i class="icon anm anm-clock-r"></i> <time datetime="${new Date(article.publishedAt).toISOString()}">${new Date(article.publishedAt).toLocaleDateString()}</time></li>
                                    <li><i class="icon anm anm-comments-l"></i> <a href="#">Comments</a></li>
                                </ul>
                    <p class="content">${article.description}</p>
                    <a href="${article.url}" target="_blank" class="btn btn-secondary btn-sm">Read more</a>
                    </div>
                </div>
            </div>
            `;
                blogContainer.appendChild(articleElement);
            }
        });
    }

    fetchFashionArticles();
</script>
@endsection

