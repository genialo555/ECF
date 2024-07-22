<?php
function requireAuth($role = null) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit();
    }

    if ($role && $_SESSION['user_role'] !== $role) {
        header('Location: index.php');
        exit();
    }
}