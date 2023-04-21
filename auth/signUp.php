<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
session_start();
require_once '../config/dbConnect.php';
require_once '../functions.php';
if (!empty($_POST['submit'])) {
    $name = strip_tags($_POST['name']);
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $query = "INSERT INTO users (name, login, password) VALUES ('$name', '$login', '$password')";
    $res = query($query, $mysqli);
    if (mysqli_affected_rows($mysqli) == 1) {
        $_SESSION['login'] = $login;
        header('Location: ../classicsView.php');
    }
}
?>
<h1>Регистрация</h1>
<form method="post">
    <label><p>Имя</p><input type="text" name="name"></label>
    <label><p>Логин</p><input type="text" name="login"></label>
    <label><p>Пароль</p><input type="password" name="password"></label>
    <div>
        <input class="button" type="submit" name="submit" value="Регистрация">
        <a href="../classicsView.php">Назад</a>
    </div>
</form>
</body>
</html>
