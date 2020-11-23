<?php if (isset($_SESSION['login'])): ?>
    <p class="greeting">Hello, <?= ucfirst($_SESSION['login']) ?></p>
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