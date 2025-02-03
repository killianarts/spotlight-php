<?php

namespace Spotlight\Security;

function hello() {
    echo "hello";
}

function verify_admin() {
    if (!isset($_SESSION['email'])) {
        header('Location: /kanri/login');
        exit;
    };
    if ($_SERVER['REQUEST_URI'] == "/kanri/login") {
        header('Location: /kanri/');
        exit;
    };

    if ($_SESSION['role_id'] != '1') {
        echo "Who the hell are you, punk?";
        echo $_SESSION['email'];
        echo $_SESSION['role_name'];
        echo $_SESSION['role_id'];
        exit;
    };
};
