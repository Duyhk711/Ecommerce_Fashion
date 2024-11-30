@extends('layouts.client')
@section('title')
    Blog
@endsection
@section('css')
<style>
    article img {
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
                    <form class="d-flex" action="#" id="search-form">
                        <input class="search-input" type="text" id="search-input" placeholder="Blog search...">
                        <button type="submit" class="search-btn"><i class="icon anm anm-search-l"></i></button>
                    </form>
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
            <ul class="pagination justify-content-center" id="pagination">

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
    const apiUrl = (query, page) => `https://newsapi.org/v2/everything?q=${query}&apiKey=${apiKey}&pageSize=12&page=${page}`;
    const blogContainer = document.getElementById('blog-container');
    const paginationContainer = document.getElementById('pagination');
    const searchInput = document.querySelector('.search-input');
    const searchForm = document.querySelector('.search-form form'); 

    const pageSize = 12;
    let currentPage = 1;
    let totalResults = 0;
    let currentQuery = 'fashion clothes'; 

  
    async function fetchFashionArticles(query = currentQuery, page = 1) {
        try {
            const response = await fetch(apiUrl(query, page));
            if (!response.ok) {
                throw new Error(`Error: ${response.status}`);
            }
            const data = await response.json();
            if (data.articles && data.articles.length > 0) {
                displayArticles(data.articles);
                totalResults = data.totalResults;
                setupPagination(totalResults, page);
            } else {
                blogContainer.innerHTML = '<p>Không tìm thấy bài viết nào.</p>';
            }
        } catch (error) {
            console.error('Lỗi khi tải bài viết:', error);
            blogContainer.innerHTML = '<p>Không thể tải bài viết.</p>';
        }
    }
    
    function displayArticles(articles) {
        blogContainer.innerHTML = '';
        if (!articles || articles.length === 0) {
            blogContainer.innerHTML = '<p>Không có bài viết nào để hiển thị.</p>';
            return;
        }

        articles.forEach(article => {
            if (article.title && article.url && article.urlToImage && article.urlToImage !== null && article.urlToImage !== '') {
                const articleElement = document.createElement('article');
                articleElement.classList.add('col-item');
                articleElement.innerHTML = `
                <div class="blog-item col-item">
                    <div class="blog-article zoomscal-hov">
                        <div class="blog-img">
                            <a class="featured-image rounded-0 zoom-scal" href="${article.url}" target="_blank">
                                <img class="rounded-0 blur-up lazyload" data-src="${article.urlToImage}" src="${article.urlToImage}" alt="${article.title}" width="740" height="410" />
                            </a>
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


    function setupPagination(totalResults, currentPage) {
        const totalPages = Math.ceil(totalResults / pageSize);
        const paginationHTML = generatePagination(totalPages, currentPage);
        paginationContainer.innerHTML = paginationHTML;
    }

  
    function generatePagination(totalPages, currentPage) {
        let paginationHTML = '<ul class="pagination justify-content-center">';

    
        paginationHTML += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">
                            <i class="icon anm anm-angle-left-l"></i>
                        </a>
                      </li>`;

       
        for (let i = 1; i <= totalPages; i++) {
            if (i === currentPage) {
                paginationHTML += `<li class="page-item active"><a class="page-link" href="#">${i}</a></li>`;
            } else {
                paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(${i})">${i}</a></li>`;
            }
          
            if (i === 5) {
                paginationHTML += `<li class="page-item"><a class="page-link" href="#">...</a></li>`;
                break;
            }
        }

        paginationHTML += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">
                            <i class="icon anm anm-angle-right-l"></i>
                        </a>
                      </li>`;

        paginationHTML += '</ul>';
        return paginationHTML;
    }

    
    function changePage(page) {
        fetchFashionArticles(currentQuery, page);
    }

   
    searchForm.addEventListener('submit', function(event) { 
        event.preventDefault(); 
        const query = searchInput.value.trim(); 
        if (query) {
            currentQuery = query; 
            currentPage = 1; 
            fetchFashionArticles(currentQuery, currentPage); 
        }
    });

   
    fetchFashionArticles(currentQuery, currentPage);
</script>
@endsection
