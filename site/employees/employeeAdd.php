<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php
session_start();
require_once '../../config/dbConnect.php';
require_once '../../functions.php';
if (!empty($_POST['submit']) && $_POST['submit'] == 'Добавить') {
    $first_name = strip_tags($_POST['name']);
    $surname = strip_tags($_POST['surname']);
    $patronymic = strip_tags($_POST['patronymic']);
    $sex = strip_tags($_POST['sex']);
    $age = strip_tags($_POST['age']);
    $id_family_status = strip_tags($_POST['id_family_status']);
    $kids = strip_tags($_POST['kids']);
    $id_job_title = strip_tags($_POST['id_job_title']);
    $id_academic_degrees = strip_tags($_POST['id_academic_degrees']);
    $query = "INSERT INTO employees (first_name, surname, patronymic, sex, age, 
                       id_family_status, kids, id_academic_degree, 
                       id_job_title) VALUES ('$first_name', '$surname', '$patronymic', '$sex', 
                                             $age, $id_family_status, $kids, $id_academic_degrees, $id_job_title)";
    $res = query($query, $mysqli);
    if (mysqli_affected_rows($mysqli) == 1) {
        header('Location: ../main.php');
    }
}
?>
<h1>Добавление</h1>
<form method="post">
    <label><p>Имя</p><input type="text" name="name"></label>
    <label><p>Фамилия</p><input type="text" name="surname"></label>
    <label><p>Отчество</p><input type="text" name="patronymic"></label>
    <label><p>Пол</p>
        <input type="radio" name="sex" value="Мужской">Мужской
        <input type="radio" name="sex" value="Женский">Женский
    </label>
    <label><p>Возраст</p><input type="text" name="age"></label>
    <label><p>Семейный статус</p>
        <select name="id_family_status">
            <?php $query = "SELECT * FROM family_status";
            $statuses = query($query, $mysqli);
            foreach ($statuses as $status){ ?>
                <option value="<?= $status['id_family_status']?>"><?= $status['name']?></option>
            <?php }?>
        </select>
    </label>
    <label><p>Дети</p><input type="text" name="kids"></label>
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
        <select name="id_academic_degrees">
            <?php $query = "SELECT * FROM `academic_degreеs`";
            $academic_degrees = query($query, $mysqli);
            foreach ($academic_degrees as $academic_degree){ ?>
                <option value="<?= $academic_degree['id_academic_degree']?>"><?= $academic_degree['name']?></option>
            <?php }?>
        </select>
    </label>
    <div>
        <input class="button" type="submit" name="submit" value="Добавить">
        <a href="../main.php">Назад</a>
    </div>
</form>
</body>
</html>
