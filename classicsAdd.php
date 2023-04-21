<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
session_start();
require_once 'config/dbConnect.php';
require_once 'functions.php';
if (!empty($_POST['submit']) && $_POST['submit'] == 'Добавить') {
    $author = strip_tags($_POST['author']);
    $title = strip_tags($_POST['title']);
    $type = strip_tags($_POST['type']);
    $year = strip_tags($_POST['year']);
    $query = "INSERT INTO classics (author, title, type, year) VALUES ('$author', '$title', '$type', '$year')";
    $res = query($query, $mysqli);
    if (mysqli_affected_rows($mysqli) == 1) {
        header('Location: classicsView.php');
    }
}
?>
<h1>Добавление</h1>
<form method="post">
    <label><p>Автор</p><input type="text" name="author"></label>
    <label><p>Заголовок</p><input type="text" name="title"></label>
    <label><p>Категория</p><input type="text" name="type"></label>
    <label><p>Год</p><input type="text" name="year"></label>
    <div>
        <input class="button" type="submit" name="submit" value="Добавить">
        <a href="classicsView.php">Назад</a>
    </div>
</form>
</body>
</html>
