<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Качи файл';
include './includes/header.php';
$basedir = __DIR__ . '/pictures/';
//var_dump($_SESSION['username']);
if ($_SESSION['isLogged']) {
    if ($_SESSION['username']) {
        if (isset($_POST['upload_picture'])) {
            if (count($_FILES) > 0) {
                $userdir = $basedir . $_SESSION['username'];
                if (!is_dir($userdir)) {
                    mkdir($userdir);
                }
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $userdir . DIRECTORY_SEPARATOR . $_FILES['picture']['name'])) {
                    echo "Файла е качен успешно";
                } else {
                    echo "Грешка";
                }
            }
        }
        echo "<form method='POST' enctype='multipart/form-data'>
				<div>Снимка: <input type='file' name='picture'></div>
				<div><input type='submit' name='upload_picture' value='Качи снимка'></div>
				<div><a href='./allfiles.php'>Виж свички снимки</a></div>
			</form>";
    }
} else {
    echo 'Не си се логнал, върни се на страницата за <a href="./index.php">Вход</a>';
    session_destroy();
    exit;
}

?>

<?php
include './includes/footer.php';
?>