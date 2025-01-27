<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";

page_head('Login');

$password = "No Password";
$passwords_match = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = <<<SQL
        SELECT * FROM users WHERE email = :email
        SQL;
    $stmt = $db->prepare($query);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    if ($email = $user['email'] && password_verify($password, $user['password'])) {
        $passwords_match = "The passwords match.";
    } else {
        $passwords_match = "The passwords didn't match.";
    };
};
?>
<p><?= htmlentities($passwords_match) ?></p>
<form method="post" id="login-form" action="<?= htmlentities($_SERVER['REQUEST_URI']) ?>">
    <input type="text" name="email" value="" class="border" />
    <input type="password" name="password" value="" class="border" />
    <button name="submit" type="submit">
        Login
    </button>
</form>
<? page_foot();
