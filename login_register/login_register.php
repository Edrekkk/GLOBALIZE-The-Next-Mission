<?php

session_start();
require_once 'config.php';

// Ensure the users table exists
$conn->query("CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), email VARCHAR(255) UNIQUE, password VARCHAR(255), role VARCHAR(50))");

if (!isset($_POST['login']) && !isset($_POST['register'])) {
    if (isset($_SESSION['email'])) {
        // User is logged in, show the GLOBALIZE page
        include 'user_page.php';
        exit();
    } else {
        // Not logged in, redirect to login page
        header("Location: index.php");
        exit();
    }
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("SELECT email FROM users WHERE LOWER(email)=LOWER(?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        $_SESSION['register_error'] = 'Database error: ' . $conn->error;
        $_SESSION["active_form"] = 'register';
    } elseif ($result->num_rows > 0) {
        $_SESSION['register_error'] = 'Email already used.';
        $_SESSION["active_form"] = 'register';
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $role);
        if (!$stmt->execute()) {
            $_SESSION['register_error'] = 'Registration failed: ' . $conn->error;
            $_SESSION["active_form"] = 'register';
        } else {
            $_SESSION['register_success'] = 'Registration successful. Please log in.';
            $_SESSION["active_form"] = 'login';
        }
    }

    header("Location: index.php");
    exit();
}

    if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE LOWER(email)=LOWER(?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        $_SESSION['login_error'] = 'Database error: ' . $conn->error;
        $_SESSION["active_form"] = 'login';
        header("Location: index.php");
        exit();
    }
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            
            if ($user['role'] === 'admin') {
                header("Location: login_register.php");
            } else {
                header("Location: login_register.php");
            }
            exit();
        }   
    }

    $_SESSION['login_error'] = 'Incorrect email or password.';
    $_SESSION["active_form"] = 'login';
    header("Location: index.php");
    exit();
}

?>