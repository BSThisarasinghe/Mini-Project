<?php

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed");
    }
}

function password_encrypt($password) {
    $hash_format = "$2y$10$";

    $salt_length = 22;

    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format . $salt;
    $hash = crypt($password, $format_and_salt);
    return $hash;
}

function generate_salt($length) {
    $unique_random_string = md5(uniqid(mt_rand(), TRUE));
    $base64_string = base64_encode($unique_random_string);
    $modified_base64_string = str_replace('+', '.', $base64_string);
    $salt = substr($modified_base64_string, 0, $length);
    return $salt;
}

function password_check($password, $existing_hash) {
    $hash = crypt($password, $existing_hash);
    if ($hash === $existing_hash) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function find_admin_by_username($username) {
    global $conn;

    $safe_username = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM member WHERE username = '{$safe_username}' LIMIT 1";
    $admin_set = mysqli_query($conn, $query);
    confirm_query($admin_set);

    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return NULL;
    }
}

function find_admin_by_id($user_id) {
    global $conn;

    $safe_user_id = mysqli_real_escape_string($conn, $user_id);
    $query = "SELECT * FROM request WHERE id = '{$safe_user_id}' LIMIT 1";
    $admin_set = mysqli_query($conn, $query);
    confirm_query($admin_set);

    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return NULL;
    }
}

function attempt_login($username, $password) {
    $admin = find_admin_by_username($username);
    if ($admin) {
        if (password_check($password, $admin["password"])) {
            return $admin;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function find_all_admins() {
    global $conn;

    $query = "SELECT * FROM member WHERE role = 'admin' ORDER BY username ASC";
    $admin_set = mysqli_query($conn, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}

function logged_in() {
    return isset($_SESSION['id']);
}

function confirm_logged_in() {
    if (!logged_in()) {
        redirect_to("login.php");
    }
}

?>