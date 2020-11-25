<?php if (isset($_GET['edit_id'])): ?>
    <h2>Update news</h2>
<?php else: ?>
    <h2>Create news</h2>
<?php endif; ?>
<form action="?action=news_item" method="post">
    <?php if (isset($_GET['edit_id'])): ?>
        <input type="hidden" name="edition" value="<?= $data['id'] ?>">
    <?php endif; ?>
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Enter the title" required
               value="<?= $data['title'] ?>" minlength="5" maxlength="255">
    </div>
    <div class="form-group">
        <label for="desc">Description:</label>
        <textarea name="description" class="form-control" id="desc" cols="40" rows="10"
                  placeholder="Enter the description" minlength="5"
                  maxlength="65535"><?= $data['description'] ?></textarea>
    </div>
    <button type="submit"
            class="btn btn-default"><?php if (isset($_GET['edit_id'])) echo 'Save'; else echo 'Create'; ?></button>
</form>