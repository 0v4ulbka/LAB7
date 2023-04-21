<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Удалить</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
session_start();
require_once 'config/dbConnect.php';
require_once 'functions.php';
if (!empty($_POST['del'])) {
    $id = (int)$_GET['id'];
    $query = "DELETE FROM classics WHERE id=$id";
    $res = query($query, $mysqli);
    header('Location: classicsView.php');
} ?>
<h1>Вы уверены, что хотите удалить?</h1>
<form method="post">
    <div>
        <input class="button" type="submit" name="del" value="Удалить">
        <a href="classicsView.php">Назад</a>
    </div>
</form>
</body>
</html>
