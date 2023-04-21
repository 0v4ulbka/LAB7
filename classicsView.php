<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отображение</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav>
<?php
session_start();
if($_SESSION && !empty($_SESSION)){ ?>
    <a href="auth/logout.php">Выйти</a>
    <a href="classicsAdd.php">Добавить</a>
<?php } else {?>
    <a href="auth/signIn.php">Войти</a>
    <a href="auth/signUp.php">Зарегистрироваться</a>
<?php }?>
</nav>

<?php
require_once 'config/dbConnect.php';
require_once 'functions.php';
$query = "SELECT * FROM classics";
$res = query($query, $mysqli);
while ($row = mysqli_fetch_assoc($res)) {
    ?>
    <div class="block">
        <h2><?= $row['title']; ?>
            <?php if($_SESSION && !empty($_SESSION)){ ?>
                <a href="classicsDel.php?id=<?= $row['id']?>">Удалить</a>
            <?php }?>
        </h2>
        <p>
        Автор: <?= $row['author']; ?><br>
        Категория: <?= $row['type']; ?><br>
        Год: <?= $row['year']; ?><br>
        <?php if($_SESSION && !empty($_SESSION)){ ?>
            <p><a href="classicsUpd.php?id=<?= $row['id']?>">Изменить</a></p>
        <?php }?>
        </p>
    </div>
<?php }?>
</body>
</html>
