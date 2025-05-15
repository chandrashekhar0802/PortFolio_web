<?php
session_start();

function is_logged_in() {
    return isset($_SESSION['user']);
}

function is_admin() {
    return is_logged_in() && $_SESSION['user']['role'] === 'admin';
}

// Redirect to login if not logged in
function require_login() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit;
    }
}

// Redirect if not admin
function require_admin() {
    if (!is_admin()) {
        header("Location: ../login.php");
        exit;
    }
}
