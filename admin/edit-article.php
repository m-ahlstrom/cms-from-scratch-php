<?php

require_once '../includes/init.php';

Auth::requireLogin();

$conn = require_once '../includes/db.php';

if (isset($_GET['id'])) {

    $articles = Article::getByID($conn, $_GET['id']);

    if (!$articles) {
        die("Article not found!");
    }
} else {
    die("ID not supplied, article not found!");
}

$category_ids = array_column($articles->getCategories($conn), 'id');

$categories = Category::getAll($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $articles->title = $_POST["title"];
    $articles->content = $_POST["content"];
    $articles->published_at = $_POST["published_at"];

    $category_ids = $_POST['category'] ?? [];

    if ($articles->update($conn)) {
        $articles->setCategories($conn, $category_ids);
        Url::redirect("/admin/article.php?id={$articles->id}");
    }
}

?>

<?php require_once '../includes/header.php'; ?>

<h2>Edit article</h2>

<?php require_once 'includes/article-form.php'; ?>

<?php require_once '../includes/footer.php'; ?>