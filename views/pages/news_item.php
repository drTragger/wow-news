<a href="/">To main page</a>
<h2>You have just added these news:</h2>
<div class="news">
    <?php if (isset($data)): ?>
    <table>
        <?php foreach ($data as $newsItem) : ?>
            <tr>
                <td><?= $newsItem['title'] ?></td>
            </tr>
            <tr>
                <td><?= $newsItem['description'] ?></td>
            </tr>
            <tr>
                <td><?= ucfirst($newsItem['user_name']) ?></td>
            </tr>
            <tr>
                <td><?= $newsItem['created_at'] ?></td>
            </tr>
            <?php if ($newsItem['user_name'] === $_SESSION['login']): ?>
                <tr>
                    <td>
                        <form method="post">
                            <input type="hidden" name="delete" value="<?= $newsItem['id'] ?>">
                            <button type="submit">
                                <i class="far fa-trash-alt trash_img"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="get">
                            <input type="hidden" name="edit_id" value="<?= $newsItem['id'] ?>">
                            <button type="submit">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <p class="no-news">Error loading news.</p>
<?php endif; ?>