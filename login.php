<?php

require_once 'includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = require 'includes/db.php';

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {

        Auth::login();

        Url::redirect('/index.php');

    } else {

        $error = "Incorrect login data.";

    }
}
?>

<?php require_once 'includes/header.php' ?>

<h2>Login</h2>

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

    <button class="btn btn-primary">Log in</button>
</form>

<?php require_once 'includes/footer.php' ?>