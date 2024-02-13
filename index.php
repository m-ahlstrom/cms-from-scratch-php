<?php

require_once 'includes/init.php';

$conn = require_once 'includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getTotal($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset, true);

?>

<?php require_once 'includes/header.php'; ?>

<?php if (empty($articles)): ?>
    <p>No articles found.</p>
<?php else: ?>
    <ul id="index">
        <?php foreach ($articles as $article): ?>
            <li>
                <article>
                    <h2><a href="article.php?id=<?= $article['id']; ?>">
                            <?= htmlspecialchars($article['title'] ?? ''); ?>
                        </a></h2>
                    <time datetime="<?= $article['published_at'] ?>">
                        <?php
                        $datetime = new DateTime($article['published_at']);
                        echo $datetime->format("j F, Y");
                        ?>
                    </time>
                    <?php if ($article['category_names']): ?>
                        <p>Categories:
                            <?php foreach ($article['category_names'] as $name): ?>
                                <?= htmlspecialchars($name ?? ''); ?>
                            <?php endforeach; ?>
                        </p>
                    <?php endif; ?>

                    <p>
                        <?= htmlspecialchars($article['content'] ?? ''); ?>
                    </p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php require 'includes/pagination.php'; ?>

<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>