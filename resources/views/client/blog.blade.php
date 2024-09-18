@extends('layouts.client')
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: white;
        text-align: center;
    }

    main {
        padding: 1rem;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 20px;
    }

    article {
        border: 1px solid black;
        height: 150px;
        background-color: white;
        border-radius: 10px;
        padding: 1.5rem;
        transition: 0.3s, 0.3s;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        text-align: center;
    }

    article:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px;
    }

    article img {
        max-width: 100%;
        border-radius: 10px 10px 0 0;
    }

    article h2 {
        font-size: 1.6rem;
        margin: 1rem 0;
        color: black;
        flex-grow: 1;
    }

    article a {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.7rem 1.5rem;
        background-color: blue;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        text-align: center;
        transition: 0.3s, 0.3s;
        box-shadow: 0 4px 10px;
    }

    article a:hover {
        background-color: blue;
        transform: translateY(-3px);
        box-shadow: 0 8px 15px;
    }

    article a:active {
        transform: translateY(1px);
        box-shadow: 0 4px 10px;
    }
</style>
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main id="blog-container">

    </main>
</body>
<script>
    const apiKey = 'a046cdd5c3d946f1bea4b8e1cfb4e68f';
    const apiUrl = `https://newsapi.org/v2/everything?q=fashion&apiKey=${apiKey}`;

    const blogContainer = document.getElementById('blog-container');


    async function fetchFashionArticles() {
        try {
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            if (data.articles && data.articles.length > 0) {
                displayArticles(data.articles);
            } else {
                blogContainer.innerHTML = '<p>No articles found.</p>';
            }
        } catch (error) {
            console.error('Error fetching the articles:', error);
            blogContainer.innerHTML = `<p>Unable to load articles. Please check your API key and try again.</p>`;
        }
    }


    function displayArticles(articles) {
        blogContainer.innerHTML = '';
        articles.forEach(article => {
            const articleElement = document.createElement('article');
            articleElement.innerHTML = `
            <img src="${article.urlToImage || 'https://via.placeholder.com/300'}" alt="${article.title}">
            <h2>${article.title}</h2>
            <p>${article.description || 'No description available.'}</p>
            <a href="${article.url}" target="_blank">Read more</a>
        `;
            blogContainer.appendChild(articleElement);
        });
    }

    fetchFashionArticles();
</script>

</html>
@endsection