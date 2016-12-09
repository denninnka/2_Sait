<?php
$pageTitle = 'Твоите файлове';
include './includes/header.php';
//var_dump($_SESSION);
//var_dump($_SESSION['username']);
if (isset($_SESSION['isLogged'])) {
    if (isset($_SESSION['username'])) {
        $dir = '/var/www/html/Sait/pictures/' . $_SESSION['username'];
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file == '.' || $file == '..') {
                        continue;
                    }
                    echo "Фаилът се казва: <a href='#' download='" . $file . "'>$file </a>" . filesize($dir . '/' . $file) . " bytes" . "\n" . "</br>";
                }
                closedir($dh);
            }
        }
        echo "<a href='./uploadfile.php'>Добави файл</a></br>
			<form method='POST'>
			<input type='submit' name='exit' value='Изход'>
			</form>";

        if (isset($_POST['exit'])) {
            session_destroy();
            header('Location: ./index.php');
            exit;
        }
    }
}
if (!isset($_SESSION['isLogged']) || !isset($_SESSION['username'])) {
    echo 'Не си се логнал, върни се на страницата за <a href="./index.php">Вход</a>';
}
?>

<?php
include dirname(__FILE__) . '/includes/footer.php';
?>