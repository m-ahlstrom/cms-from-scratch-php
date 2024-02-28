<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {

    $articles = Article::getByID($conn, $_GET['id']);

    if (!$articles) {
        die("article not found");
    }

} else {
    die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $previous_image = $articles->image_file;

    if ($articles->setImageFile($conn, null)) {

        if ($previous_image) {
            unlink("../uploads/$previous_image");
        }

        Url::redirect("/cms_from_scratch_php/admin/edit-article-image.php?id={$articles->id}");
    }
}

?>
<?php require '../includes/header.php'; ?>

<h2>Delete article image</h2>

<?php if ($articles->image_file): ?>
    <img src="../uploads/<?= $articles->image_file; ?>">
<?php endif; ?>

<form method="post">

    <p>Are you sure?</p>

    <button>Delete</button>
    <a href="edit-article-image.php?id=<?= $articles->id; ?>">Cancel</a>

</form>

<?php require '../includes/footer.php'; ?>