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
    $surname = strip_tags($_POST['surname']);
    $job_title = strip_tags($_POST['job_title']);
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $query = "INSERT INTO users (name, surname, job_title, login, 
                   password) VALUES ('$name', '$surname', '$job_title', 
                                     '$login', '$password')";
    $res = query($query, $mysqli);
    if (mysqli_affected_rows($mysqli) == 1) {
        header('Location: ../site/users/users.php');
    }
}
?>
<h1>Регистрация</h1>
<form method="post">
    <label><p>Имя</p><input type="text" name="name"></label>
    <label><p>Фамилия</p><input type="text" name="surname"></label>
    <label><p>Должность</p>
        <input type="radio" name="job_title" value="admin">Администратор
        <input type="radio" name="job_title" value="worker">Кадровый работник
    </label>
    <label><p>Логин</p><input type="text" name="login"></label>
    <label><p>Пароль</p><input type="password" name="password"></label>
    <div>
        <input class="button" type="submit" name="submit" value="Регистрация">
        <a href="../site/users/users.php">Назад</a>
    </div>
</form>
</body>
</html>
