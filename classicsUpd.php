<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Изменить</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
session_start();
require_once 'config/dbConnect.php';
require_once 'functions.php';
$id = (int)$_GET['id'];
if (!empty($_POST['submit'])) {
    $author = strip_tags($_POST['author']);
    $title = strip_tags($_POST['title']);
    $type = strip_tags($_POST['type']);
    $year = strip_tags($_POST['year']);
    $query = "UPDATE classics SET `title` = '$title',
                    `author` = '$author', 
                    `type` = '$type',
                    `year` = '$year' WHERE id = $id";
    $res = query($query, $mysqli);
    if (mysqli_affected_rows($mysqli) == 1) {
        header('Location: classicsView.php');
    }
}
$query = "SELECT * FROM classics where id = $id";
$res = query($query, $mysqli);
foreach ($res as $re){ ?>
        <h1>Изменение</h1>
    <form method="post">
        <label><p>Автор</p><input type="text" name="author" value="<?= $re['author']?>"></label>
        <label><p>Заголовок</p><input type="text" name="title" value="<?= $re['title']?>"></label>
        <label><p>Категория</p><input type="text" name="type" value="<?= $re['type']?>"></label>
        <label><p>Год</p><input type="text" name="year" value="<?= $re['year']?>"></label>
        <div>
            <input class="button" type="submit" name="submit" value="Изменить">
            <a href="classicsView.php">Назад</a>
        </div>
    </form>
<?php }?>
</body>
</html>
