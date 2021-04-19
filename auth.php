<?php

function code_generation($line_length=12){
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$code = substr(str_shuffle($permitted_chars), 1, $line_length);
	return $code;
}

$db = mysqli_connect('localhost', 'root', '') or die ('Нет соединения');

if(isset($_POST['submit']))
{
	 $query = mysqli_query($db,"SELECT user_id, user_password FROM `userlist`.`users` WHERE user_login='".$_POST['login']."' LIMIT 1");
	 $data = mysqli_fetch_assoc($query);
	 if($data['user_password'] === md5($_POST['password']))
	 {
	 	$hash = code_generation(10);
	 	mysqli_query($db, "UPDATE `userlist`.`users` SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");
	 	setcookie("id", $data['user_id'], time()+60);
        setcookie("hash", $hash, time()+60);

        mail('test_email@mail.ru','Email confirmation','http://localhost/portal/email.php?code='.$hash."'");
        header("Location: check.php"); 
        exit();
	 }
else
    {
        print "Вы ввели неправильные данные";
    }
}
?>

<form method="POST"><pre>
<link type="text/css" rel="stylesheet" href="css.css" /> 
<div id = "base">
    <input type="text" name="login" class="feedback-input" placeholder="login" required>
    <input type="text" name="password" class="feedback-input" placeholder="password">
    <input name="submit" type="submit" value="Sign in">
</div>
</pre></form>