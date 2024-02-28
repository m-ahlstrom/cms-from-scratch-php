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


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($articles->delete($conn)) {
        Url::redirect("/cms_from_scratch_php/admin/index.php");
    }
}

?>

<?php require_once "../includes/header.php"; ?>

<h2>Delete articles</h2>

<form method="post">
    <p>Are you sure?</p>
    <button>Delete</button>
    <a href="article.php?id=<?= $articles->id; ?>">Cancel</a>
</form>

<?php require_once "../includes/footer.php" ?>