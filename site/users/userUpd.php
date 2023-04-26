<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Изменить</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php
session_start();
require_once '../../config/dbConnect.php';
require_once '../../functions.php';
$id = (int)$_GET['id_user'];
if (!empty($_POST['submit'])) {
    $name = strip_tags($_POST['name']);
    $surname = strip_tags($_POST['surname']);
    $job_title = strip_tags($_POST['job_title']);
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $query = "UPDATE users SET `name` = '$name',
                    `surname` = '$surname', 
                    `job_title` = '$job_title',
                    `login` = '$login',
                    `password` = '$password' WHERE id_user = $id";
    $res = query($query, $mysqli);
    if (mysqli_affected_rows($mysqli) == 1) {
        header('Location: users.php');
    }
}
$query = "SELECT * FROM users where id_user = $id";
$res = query($query, $mysqli);
foreach ($res as $re){ ?>
    <h1>Изменение</h1>
    <form method="post">
        <label><p>Имя</p><input type="text" name="name" value="<?= $re['name']?>"></label>
        <label><p>Фамилия</p><input type="text" name="surname" value="<?= $re['surname']?>"></label>
        <label><p>Должность</p>
            <input type="radio" name="job_title" value="admin">Администратор
            <input type="radio" name="job_title" value="worker">Кадровый работник
        </label>
        <label><p>Логин</p><input type="text" name="login" value="<?= $re['login']?>"></label>
        <label><p>Пароль</p><input type="password" name="password" value="<?= $re['password']?>"></label>
        <div>
            <input class="button" type="submit" name="submit" value="Изменить">
            <a href="../main.php">Назад</a>
        </div>
    </form>
<?php }?>
</body>
</html>
