<?php
$db = mysqli_connect('localhost', 'root', '') or die ('Нет соединения');
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
	$query = mysqli_query($db, "SELECT * FROM `userlist`.`users` WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);
    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
    {
        setcookie("id", "", time() - 60);
        setcookie("hash", "", time() - 60);
        echo 'Ошибка';
    }
}
else{
    header("Location: auth.php");
    exit();
}