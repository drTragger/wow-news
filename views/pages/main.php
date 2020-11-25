<?php if (isset($_SESSION['login'])): ?>
    <a href="?action=edit" class="create">Create Ad</a>
<?php else: ?>
    <form method="post">
        <div class="form-group">
            <label for="username">User Name:</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter user name" required
                   value="<?= $_SESSION['username'] ?>" autofocus>
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
        <?php require 'views' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'pagination.php' ?>
        <?php $data = array_reverse($data) ?>
        <?php require_once 'views' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'all_news.php' ?>
        <?php require 'views' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'pagination.php' ?>
    <?php else: ?>
        <p class="no-news">There are no news here. You can add a new one.</p>
    <?php endif; ?>
</div>