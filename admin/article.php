<?php

require_once '../includes/init.php';

Auth::requireLogin();

$conn = require_once '../includes/db.php';

if (isset($_GET['id'])) {

    $articles = Article::getWithCategories($conn, $_GET['id']);
} else {
    $articles = null;
}

?>

<?php require_once '../includes/header.php'; ?>

<?php if ($articles): ?>

    <article>
        <h2>
            <?= htmlspecialchars($articles[0]['title'] ?? ''); ?>
        </h2>
        <?php if ($articles[0]['published_at']): ?>
            <time>
                <?= $articles[0]['published_at'] ?>
            </time>
        <?php else: ?>
            Unpublished
            <button class="publish" data-id="<?= $articles[0]['id'] ?>">Publish</button>
        <?php endif; ?>

        <?php if ($articles[0]['category_name']): ?>
            <p>Categories:
                <?php foreach ($articles as $a): ?>
                    <?= htmlspecialchars($a['category_name'] ?? ''); ?>
                <?php endforeach; ?>
            </p>
        <?php endif; ?>

        <?php if ($articles[0]['image_file']): ?>
            <img src="/uploads/<?= $articles[0]['image_file']; ?>">
        <?php endif; ?>

        <p>
            <?= htmlspecialchars($articles[0]['content'] ?? ''); ?>
        </p>
    </article>


    <a href="edit-article.php?id=<?= $articles[0]['id']; ?>">Edit</a>
    <a class="delete" href="delete-article.php?id=<?= $articles[0]['id']; ?>">Delete</a>
    <a href="edit-article-image.php?id=<?= $articles[0]['id']; ?>">Edit image</a>

<?php else: ?>

    <p>No articles found.</p>

<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>