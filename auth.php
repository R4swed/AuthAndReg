<?php
session_start();

$users = [
    'admin' => [
        'password' => password_hash('admin', PASSWORD_DEFAULT),
        'email' => 'admin@example.com'
    ]
];

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (isset($users[$username])) {
        echo "<script>alert('Пользователь уже существует!'); window.location.href='register.html';</script>";
        exit();
    }

    $users[$username] = [
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'email' => $email
    ];

    echo "<script>alert('Регистрация успешна!'); window.location.href='auth.html';</script>";
    exit();
}

if (isset($_POST['username']) && isset($_POST['password']) && !isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!isset($users[$username])) {
        echo "<script>alert('Неверное имя пользователя или пароль!'); window.location.href='auth.html';</script>";
        exit();
    }

    if (password_verify($password, $users[$username]['password'])) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Вход выполнен успешно!'); window.location.href='auth.html';</script>";
        exit();
    } else {
        echo "<script>alert('Неверное имя пользователя или пароль!'); window.location.href='auth.html';</script>";
        exit();
    }
}
?>