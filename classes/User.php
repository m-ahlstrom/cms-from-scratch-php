<?php

/**
 * User.
 *
 * A person or entity that can log in to the site.
 */
class User
{
    /**
     * Unique identifier.
     * @var integer
     */
    public $id;

    /**
     * Unique username.
     * @var string
     */
    public $username;

    /**
     * Password.
     * @var string
     */
    public $password;

    /**
     * Register a user with username and password.
     *
     * @param object $conn Connection to the database.
     *
     * @return boolean True if registration is successful, null otherwise.
     */
    public function register($conn)
    {
        $sql = "INSERT INTO users (username, password)
        VALUES (:username, :password)";

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return true;
        } else {
            return false;
        }
    }


    /**
     * Authenticate a user by username and password.
     *
     * @param object $conn Connection to the database.
     * @param string $username Username.
     * @param string $password Password.
     *
     * @return boolean True if the credentials are correct, null otherwise.
     */
    public static function authenticate($conn, $username, $password)
    {
        $sql = "SELECT *
                FROM users
                WHERE username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        if ($user = $stmt->fetch()) {
            return password_verify($password, $user->password);
        }
    }
}