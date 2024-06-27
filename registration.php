<?
    require_once "connect.php";

    if (!empty($_POST['registration'])) {
        $errors = [];
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);

        if (!empty($login) && !empty($password)) {
            $query = "SELECT * FROM users WHERE login='$login'";
            $result = mysqli_query($connect, $query);
            $data = mysqli_fetch_assoc($result);
            if (!empty($data)) {
                $errors[] = "Этот логин уже используется";
            } else {
                //Хэширование пароля
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO `users` (login, password) VALUES ('$login','$password')";
                $result = mysqli_query($connect, $query);
                if (!$result) {
                    $errors[] = "Заполнены не все поля";
                }
            }
        } else {
            $errors[] = "Заполнены не все поля";
        }

        if (empty($errors)) {
            header('Location: login.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="forrm.css">
    <title>Регистрация</title>
</head>
<body >
    <div class="container">
        <header>
            <h1>
                <a href="https://www.teamfortress.com/">
                    <img src="Team-Fortress-2-logo.png" alt="Authentic Collection">
                </a>
            </h1>
        </header>
        <h1 class="text-center">Следите за свежими новостями</h1>
        <form class="registration-form" action="" method="POST">
            <? if (!empty($errors)) {
                echo "<h2>Возникли следующие ошибки:</h2>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }?>

            <label>
                <span class="label-text">Login</span>
                <input type="text" name="login">
            </label>
            <label class="password">
                <span class="label-text">Пароль	</span>
                <input type="password" name="password">
            </label>
            <div class="text-center">
                <input class="submit" type="submit" name="registration" value="Зарегистрироваться">
            </div>
            <div class="text-center">
                <button class="submit"><a href="login.php" style="color: black; text-decoration: none">Авторизация</a></button>
            </div>
			<div class="text-center">
                <a href="index.php" style="color: black; text-decoration: none">Вернуться назад</a>
            </div>
        </form>
    </div>
</body>
</html>