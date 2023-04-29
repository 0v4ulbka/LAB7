<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отображение</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav>
<?php
session_start();
if($_SESSION && !empty($_SESSION)){ ?>
    <a href="../auth/logout.php">Выйти</a>
    <a href="employees/employeeAdd.php">Добавить</a>
    <?php if($_SESSION['job_title'] == 'admin'){ ?>
        <a href="../auth/signUp.php">Зарегистрировать</a>
        <a href="users/users.php">Пользователи</a>
<?php }} else {?>
    <a href="../auth/signIn.php">Войти</a>
<?php }?>
</nav>
<?php if($_SESSION && !empty($_SESSION)){ ?>
<form method="post">
    <label>
        <h2>Поиск по фамилии</h2>
        <input type="text" name="search">
        <input class="magnifier" type="submit" name="submit" value="&#128270;">
        <a href="main.php">Отмена</a>
    </label>
</form>
<?php
}
require_once '../config/dbConnect.php';
require_once '../functions.php';
if (!empty($_POST)){
    $surname = strip_tags($_POST['search']);
    $query = "SELECT id_employees, first_name, surname, patronymic, sex, age, 
       family_status.name as family_status_name, kids, 
       job_titles.name as job_titles_name, 
       academic_degreеs.name as academic_degreеs_name FROM employees
LEFT JOIN family_status on employees.id_family_status=family_status.id_family_status
LEFT JOIN job_titles on employees.id_job_title=job_titles.id_job_title
LEFT JOIN academic_degreеs on employees.id_academic_degree=academic_degreеs.id_academic_degree
WHERE surname = '$surname'";
    $res = query($query, $mysqli);
    $_POST['search'] = null;
}else{
    $query = "SELECT id_employees, first_name, surname, patronymic, sex, age, 
       family_status.name as family_status_name, kids, 
       job_titles.name as job_titles_name, 
       academic_degreеs.name as academic_degreеs_name FROM employees
LEFT JOIN family_status on employees.id_family_status=family_status.id_family_status
LEFT JOIN job_titles on employees.id_job_title=job_titles.id_job_title
LEFT JOIN academic_degreеs on employees.id_academic_degree=academic_degreеs.id_academic_degree";
    $res = query($query, $mysqli);
}
while ($row = mysqli_fetch_assoc($res)) {
    ?>
    <div class="block">
        <h2><?=$row['surname']?> <?= $row['first_name']?> <?=$row['patronymic']?>
            <?php if($_SESSION && !empty($_SESSION)){ ?>
                <a href="employees/employeeDel.php?id_employees=<?= $row['id_employees']?>">Удалить</a>
            <?php }?>
        </h2>
        <p>
            Пол: <?= $row['sex']; ?><br>
            Возраст: <?= $row['age']; ?><br>
            Семейный статус: <?= $row['family_status_name']; ?><br>
            Дети: <?= $row['kids']; ?><br>
            Должность: <?= $row['job_titles_name']; ?><br>
            Научная степень: <?= $row['academic_degreеs_name']; ?><br>
        <?php if($_SESSION && !empty($_SESSION)){ ?>
            <p><a href="employees/employeeUpd.php?id_employees=<?= $row['id_employees']?>">Изменить</a></p>
        <?php }?>
        </p>
    </div>
<?php }?>
</body>
</html>
