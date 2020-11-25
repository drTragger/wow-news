<a href="/" class="create">To main page</a>
<h2>News item:</h2>
<div class="news">
    <?php if (isset($data)): ?>
        <?php require_once 'views' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'all_news.php' ?>
    <?php else: ?>
    <p class="no-news">Error loading news</p>
<?php endif; ?>