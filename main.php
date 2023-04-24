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
    <a href="employeeAdd.php">Добавить</a>
    <?php if($_SESSION['job_title'] == 'admin'){ ?>
    <a href="auth/signUp.php">Зарегистрировать</a>
<?php }} else {?>
    <a href="auth/signIn.php">Войти</a>

<?php }?>
</nav>

<?php
require_once 'config/dbConnect.php';
require_once 'functions.php';
$query = "SELECT * FROM employees";
$res = query($query, $mysqli);
while ($row = mysqli_fetch_assoc($res)) {
    ?>
    <div class="block">
        <h2><?=$row['surname']?> <?= $row['name']?> <?=$row['patronymic']?>
            <?php if($_SESSION && !empty($_SESSION)){ ?>
                <a href="employeeDel.php?id_employees=<?= $row['id_employees']?>">Удалить</a>
            <?php }?>
        </h2>
        <p>
            Пол: <?= $row['sex']; ?><br>
            Возраст: <?= $row['age']; ?><br>
            Семейный статус: <?= $row['id_family_status']; ?><br>
            Дети: <?= $row['kids']; ?><br>
            Должность: <?= $row['id_job_title']; ?><br>
            Научная степень: <?= $row['id_academic_degree']; ?><br>
        <?php if($_SESSION && !empty($_SESSION)){ ?>
            <p><a href="employeeUpd.php?id_employees=<?= $row['id_employees']?>">Изменить</a></p>
        <?php }?>
        </p>
    </div>
<?php }?>
</body>
</html>
