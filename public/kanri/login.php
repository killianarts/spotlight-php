<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM account WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    if ($email = $user['email'] && password_verify($password, $user['password'])) {
        $_SESSION['account_id'] = $user['account_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['role_id'] = $user['role_id'];
        header("Location: /kanri/post/list");
        exit;
    } else {
        $passwords_match = "The passwords didn't match.";
    };
};

page_head('Login');

?>
<h1 class="text-3xl uppercase font-tx-thin">Login</h1>
<form method="post" id="login-form" action="<?= htmlentities($_SERVER['REQUEST_URI']) ?>" class="grid gap-2 justify-start">
    <!-- TODO Add email check and change default admin email -->
    <label class="font-mono-regular">
        <p>Email</p>
        <input type="text" name="email" value="" class="border" />
    </label>
    <label class="font-mono-regular">
        <p>Password</p>
        <input type="password" name="password" value="" class="border" />
    </label>
    <button name="submit" type="submit" class="bg-blue-500 font-tx text-blue-50">
        Login
    </button>
</form>
<? page_foot();
