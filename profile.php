<?php
include('checkprof.php');
?>
<html lang='ru'>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="form.css">
	<title>Profile</title>
</head>
<body>
<?php
if(isset($_POST['login']) or isset($_POST['email']) or isset($_POST['name']) or isset($_POST['surname']) or isset($_POST['age']))
{
	$db = mysqli_connect('localhost', 'root', '') or die ('Нет соединения');
	mysqli_query($db, "UPDATE `userlist`.`users` SET user_login='".$_POST['login']."', user_email='".$_POST['email']."', user_name='".$_POST['name']."', user_surname='".$_POST['surname']."', user_age='".$_POST['age']."' WHERE user_id='".$data['user_id']."'");
	echo 'Изменения сохранены';
}

$db = mysqli_connect('localhost', 'root', '') or die ('Нет соединения');
//echo $_COOKIE['id'];
$result = mysqli_fetch_array(mysqli_query($db, "SELECT user_id, user_login, user_email, user_confirmed, user_name, user_surname, user_age FROM `userlist`.`users` WHERE user_id='".$_COOKIE['id']."'"));
echo '<form action="profile.php" method="POST" class="form"><div class="row">Ваш id: '.$result['user_id'].'</div>';
echo '<div class="row"><label for="login">Ваш логин: </label><input type="text" name="login" id="login" placeholder="'.$result['user_login'].'"></div>';
echo '<div class="row"><label for="login">Ваш email: </label><input type="text" name="email" id="email" placeholder="'.$result['user_email'].'"></div>';
echo '<div class="row">Аккаунт подтвержден: '.$result['user_confirmed'].'</div>';
echo '<div class="row"><label for="login">Ваше имя: </label><input type="text" name="name" id="name" placeholder="'.$result['user_name'].'"></div>';
echo '<div class="row"><label for="login">Ваша фамилия: </label><input type="text" name="surname" id="surname" placeholder="'.$result['user_surname'].'"></div>';
echo '<div class="row"><label for="login">Ваш возраст: </label><input type="text" name="age" id="age" placeholder="'.$result['user_age'].'"></div>';
echo '<input name="submit" type="submit" value="Сохранить изменения"></form>'
?>
</body>