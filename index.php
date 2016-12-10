<?php
$pageTitle = 'Сайт';
include './includes/header.php';

if (isset($_POST['vhod'])) {
    if (file_exists('./user.txt')) {
        $users = file('./user.txt');
        foreach ($users as $key => $value) {
            $user     = explode("!", ($value));
            $username = $user[0];
            $password = trim($user[1]);
            if ($_POST['username'] == $username && $_POST['pass'] == $password) {
                $_SESSION['isLogged'] = true;
                $_SESSION['username'] = $username;
                header('Location: ./allfiles.php');
                exit;
            }
        }

        if ($_SESSION['isLogged'] == false) {
            echo "Грешно потребителско име или парола";
        }
    }
}
if ($_SESSION['isLogged'] && $_SESSION['username']) {
    header('Location: ./allfiles.php');
    exit;
}
if (isset($_POST['registraciq'])) {
    header('Location: ./registraciq.php');
    exit;
}
?>

<h2>Здравейте, добре дошли!</h2>
<h3>Влезте във вашият профил</h3>
<form method="POST">
<div>Потребителско име:&nbsp;<input type="text" name="username"></div><div><br></div>
<div>Парола:&nbsp;<input type="text" name="pass"></div><div><br></div>
<div><input type="submit" name="registraciq" value="Регистрация">&nbsp;<input type="submit" name="vhod" value="Влез"></div>
</form>

<?php
include './includes/footer.php';
?>
