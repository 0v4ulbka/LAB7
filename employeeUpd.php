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
$id = (int)$_GET['id_employees'];
if (!empty($_POST['submit'])) {
    $name = strip_tags($_POST['name']);
    $surname = strip_tags($_POST['surname']);
    $patronymic = strip_tags($_POST['patronymic']);
    $sex = strip_tags($_POST['sex']);
    $age = strip_tags($_POST['age']);
    $id_family_status = strip_tags($_POST['id_family_status']);
    $kids = strip_tags($_POST['kids']);
    $id_academic_degree = strip_tags($_POST['id_academic_degree']);
    $id_job_title = strip_tags($_POST['id_job_title']);
    $query = "UPDATE employees SET `name` = '$name',
                    `surname` = '$surname', 
                    `patronymic` = '$patronymic',
                    `sex` = '$sex',
                    `age` = '$age', 
                    `id_family_status` = '$id_family_status',
                    `kids` = '$kids',
                    `id_academic_degree` = '$id_academic_degree', 
                    `id_job_title` = '$id_job_title' WHERE id_employees = $id";
    $res = query($query, $mysqli);
    if (mysqli_affected_rows($mysqli) == 1) {
        header('Location: main.php');
    }
}
$query = "SELECT * FROM employees where id_employees = $id";
$res = query($query, $mysqli);
foreach ($res as $re){ ?>
        <h1>Изменение</h1>
    <form method="post">
        <label><p>Имя</p><input type="text" name="name" value="<?= $re['name']?>"></label>
        <label><p>Фамилия</p><input type="text" name="surname" value="<?= $re['surname']?>"></label>
        <label><p>Отчество</p><input type="text" name="patronymic" value="<?= $re['patronymic']?>"></label>
        <label><p>Пол</p><input type="text" name="sex" value="<?= $re['sex']?>"></label>
        <label><p>Возраст</p><input type="text" name="age" value="<?= $re['age']?>"></label>
        <label><p>Семейный статус</p>
            <select name="id_family_status">
                <?php $query = "SELECT * FROM family_status";
                $statuses = query($query, $mysqli);
                foreach ($statuses as $status){ ?>
                    <option value="<?= $status['id_family_status']?>"><?= $status['name']?></option>
                <?php }?>
            </select>
        </label>
        <label><p>Дети</p><input type="text" name="kids" value="<?= $re['kids']?>"></label>
        <label><p>Должность</p>
            <select name="id_job_title">
                <?php $query = "SELECT * FROM job_titles";
                $job_titles = query($query, $mysqli);
                foreach ($job_titles as $job_title){ ?>
                    <option value="<?= $job_title['id_job_title']?>"><?= $job_title['name']?></option>
                <?php }?>
            </select>
        </label>
        <label><p>Научная степень</p>
            <select name="id_academic_degree">
                <?php $query = "SELECT * FROM `academic_degreеs`";
                $academic_degrees = query($query, $mysqli);
                foreach ($academic_degrees as $academic_degree){ ?>
                    <option value="<?= $academic_degree['id_academic_degree']?>"><?= $academic_degree['name']?></option>
                <?php }?>
            </select>
        </label>
        <div>
            <input class="button" type="submit" name="submit" value="Изменить">
            <a href="main.php">Назад</a>
        </div>
    </form>
<?php }?>
</body>
</html>
