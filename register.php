<?php

require_once 'includes/init.php';

$user = new User();
$conn = require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->register($conn)) {

        Url::redirect("/index.php");

    }
}

?>

<?php require_once 'includes/header.php' ?>

<h2>Register</h2>

<?php if (!empty($error)): ?>


    <p>
        <?= $error ?>
    </p>

<?php endif; ?>

<form method="post">

    <div class="form-group">
        <label for="username">Username</label>
        <input name="username" id="username">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <button class="btn btn-primary">Register</button>
</form>

<?php require_once 'includes/footer.php' ?>