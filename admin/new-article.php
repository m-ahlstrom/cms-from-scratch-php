<?php

require_once '../includes/init.php';

Auth::requireLogin();

$articles = new Article();

$category_ids = [];

$conn = require_once '../includes/db.php';

$categories = Category::getAll($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $articles->title = $_POST['title'];
    $articles->content = $_POST['content'];
    $articles->published_at = $_POST['published_at'];

    $category_ids = $_POST['category'] ?? [];

    if ($articles->create($conn)) {

        $articles->setCategories($conn, $category_ids);

        Url::redirect("/admin/article.php?id={$articles->id}");

    }
}

?>

<?php require_once '../includes/header.php'; ?>

<h2>New article</h2>

<?php require_once 'includes/article-form.php'; ?>

<?php require_once '../includes/footer.php'; ?>