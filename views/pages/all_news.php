<?php foreach ($data as $newsItem) : ?>
    <div class="table">
        <table>
            <tr>
                <?php if (isset($_SESSION['id']) || isset($_GET['id'])): ?>
                    <td class="title"><?= $newsItem['title'] ?></td>
                <?php else: ?>
                    <td class="title"><a href="?id=<?= $newsItem['id'] ?>"><?= $newsItem['title'] ?></a></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="description"><?= $newsItem['description'] ?></td>
            </tr>
            <tr>
                <td class="username">Written by <?= ucfirst($newsItem['user_name']) ?></td>
                <td class="date"><?= $newsItem['created_at'] ?></td>
            </tr>
            <?php if ($newsItem['user_name'] === $_SESSION['login']): ?>
                <tr class="action">
                    <td class="delete">
                        <form method="post">
                            <input type="hidden" name="delete" value="<?= $newsItem['id'] ?>">
                            <button type="submit">
                                <i class="far fa-trash-alt trash_img"></i>
                            </button>
                        </form>
                    </td>
                    <td class="edit">
                        <form method="get">
                            <input type="hidden" name="edit_id" value="<?= $newsItem['id'] ?>">
                            <button type="submit">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
<?php endforeach; ?>