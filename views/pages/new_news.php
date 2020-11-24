<h2>Create new news</h2>
<form action="?action=news_item" method="post">
    <?php if (isset($_GET['edit_id'])): ?>
        <input type="hidden" name="edition" value="<?= $data['id'] ?>">
    <?php endif; ?>
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Enter the title" required value="<?= $data['title'] ?>">
    </div>
    <div class="form-group">
        <label for="desc">Description:</label>
        <textarea name="description" class="form-control" id="desc" cols="40" rows="10" placeholder="Enter the description"><?= $data['description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-default"><?php if (isset($_GET['edit_id'])) echo 'Save'; else echo 'Create'; ?></button>
</form>