<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
session_start();
require_once '../functions.php';
require_once '../config/dbConnect.php';
if (!empty($_POST['submit'])){
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $query = "SELECT * FROM users where login = '$login' and password = '$password'";
    $res = query($query, $mysqli);
    if (mysqli_affected_rows($mysqli) == 1) {
        foreach ($res as $re){
            $_SESSION['job_title'] = $re['job_title'];
        }
        header('Location: ../site/main.php');
    }else{
        $errors[] = 'Такого пользователя не существует';
    }
}
?>
<h1>Вход</h1>
<form method="post">
    <?php if(!empty($errors)){ ?>
        <div class="valid">
            <?php foreach ($errors as $error){ ?>
                <h3 class="error"><?= $error?></h3>
            <?php }?>
        </div>
    <?php } ?>
    <label><p>Логин</p><input type="text" name="login"></label>
    <label><p>Пароль</p><input type="password" name="password"></label>
    <div>
        <input class="button" type="submit" name="submit" value="Войти">
        <a href="../site/main.php">Назад</a>
    </div>
</form>
</body>
</html>
