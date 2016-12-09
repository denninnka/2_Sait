<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Регистрация';
include './includes/header.php';

if ($_POST) {
    $username = trim($_POST['username']);
    $username = str_replace('!', ' ', $username);
    $pass     = trim($_POST['password']);
    $pass     = str_replace('!', ' ', $pass);
    $repass   = trim($_POST['repassword']);
    $repass   = str_replace('!', ' ', $repass);
    $error    = false;
    if (file_exists('./user.txt')) {
        $res = file('./user.txt');
        foreach ($res as $key => $value) {
            $resul = explode('!', ($value));
            $user  = $resul[0];
            if ($user == $username) {
                $error = true;
                echo "Съществува такъв потребител";
            }
        }
    }

    if (mb_strlen($username) < 3) {
        echo "<p>Името е прекалено късо</p>";
        $error = true;
    }
    if (!preg_match('/^[а-яА-Яa-zA-Z]+$/u', $username)) {
        echo "<p>Името не трябва да съдържа числа и специални символи</p>";
        $error = true;
    }
    if (mb_strlen($pass) < 6 || mb_strlen($pass) > 6) {
        echo "Паролата трябва да съдържа шест символа<br />";
        $error = true;
    }
    if ($_POST['password'] != $_POST['repassword']) {
        echo "Непревилна парола";
        $error = true;
    }
    if (!$error) {
        $result = $username . '!' . $pass . "\n";
        if (file_put_contents('./user.txt', $result, FILE_APPEND)) {
            echo "Регистрацията е успешна<br />";
            echo "Можете да се логнете<a href='./index.php'>тук</a>";
        }
    }
}
//var_dump($_POST);
?>
<h3>Здравейте, тук можете да се регистрирате</h3>
<form method="POST">
<div>Потребителско име:&nbsp;<input type="text" name="username"></div><div><br></div>
<div>Парола:&nbsp;<input type="text" name="password"></div><div><br></div>
<div>Повтори парола:&nbsp;<input type="text" name="repassword"></div><div><br></div>
<div><input type="submit" name="reg" value="Регистрирай се"></div>
</form>

<?php
include './includes/footer.php';
?>