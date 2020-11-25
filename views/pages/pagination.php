<nav>
    <ul class="pagination">
        <?php if (View::$currentPage - 1 > 0): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= View::$currentPage - 1 ?>">Previous</a>
            </li>
        <?php endif; ?>
        <?php if (View::$currentPage + 1 <= View::$lastPage): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= View::$currentPage + 1 ?>">Next</a></li>
        <?php endif ?>
    </ul>
    <ul class="pagination">
        <?php if (View::$currentPage != 1): ?>
            <li><a href="?page=1">First Page</a></li>
        <?php endif ?>
        <?php if (View::$currentPage != View::$lastPage): ?>
            <li><a href="?page=<?= View::$lastPage ?>">Last Page</a></li>
        <?php endif ?>
    </ul>
</nav>