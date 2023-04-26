<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отображение</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<nav>
<?php
session_start();
if($_SESSION && !empty($_SESSION)){ ?>
    <a href="../../auth/logout.php">Выйти</a>
    <a href="../employees/employeeAdd.php">Добавить</a>
    <?php if($_SESSION['job_title'] == 'admin'){ ?>
        <a href="../../auth/signUp.php">Зарегистрировать</a>
        <a href="../main.php">На главную</a>
<?php }}?>
</nav>
<?php
require_once '../../config/dbConnect.php';
require_once '../../functions.php';
$query = "SELECT * FROM users";
$res = query($query, $mysqli);
while ($row = mysqli_fetch_assoc($res)) {
    ?>
    <div class="block">
        <h2><?=$row['surname']?> <?= $row['name']?>
            <a href="userDel.php?id_user=<?= $row['id_user']?>">Удалить</a>
        </h2>
        <p>
            Должность: <?= $row['job_title']; ?><br>
            Логин: <?= $row['login']; ?><br>
            Пароль: <?= $row['password']; ?><br>
        <?php if($_SESSION && !empty($_SESSION)){ ?>
            <p><a href="userUpd.php?id_user=<?= $row['id_user']?>">Изменить</a></p>
        <?php }?>
        </p>
    </div>
<?php }?>
</body>
</html>
