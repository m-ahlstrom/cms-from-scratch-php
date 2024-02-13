<?php

require_once 'includes/init.php';

$conn = require_once 'includes/db.php';

if (isset($_GET['id'])) {

    $articles = Article::getWithCategories($conn, $_GET['id'], true);
} else {
    $articles = null;
}

?>

<?php require_once 'includes/header.php'; ?>

<?php if ($articles): ?>

    <article>
        <h2>
            <?= htmlspecialchars($articles[0]['title'] ?? ''); ?>
        </h2>

        <time datetime="<?= $articles[0]['published_at'] ?>">
            <?php
            $datetime = new DateTime($articles[0]['published_at']);
            echo $datetime->format("j F, Y");
            ?>
        </time>

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

<?php else: ?>

    <p>No articles found.</p>

<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>