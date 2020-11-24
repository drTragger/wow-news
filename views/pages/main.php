<?php if (isset($_SESSION['login'])): ?>
    <p class="greeting">Hello, <?= ucfirst($_SESSION['login']) ?></p>
    <a href="?action=edit">Create Ad</a>
<?php else: ?>
    <form method="post">
        <div class="form-group">
            <label for="username">User Name:</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter user name" required
                   value="<?= $_SESSION['username'] ?>">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
<?php endif; ?>
<div class="news">
    <?php if (isset($data)): ?>
        <?php $data = array_reverse($data) ?>
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
        <p class="no-news">There are no news here. You can add a new one.</p>
    <?php endif; ?>
</div>
