<?php
$db = mysqli_connect('localhost', 'root', '') or die ('Нет соединения');

if(isset($_POST['submit']))
{
	//$query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($db, $_POST['login'])."'");
	$query = mysqli_query($db, "SELECT user_id FROM `userlist`.`users` WHERE user_login='".$_POST['login']."'");
    if(mysqli_num_rows($query) > 0)
    {
        print "<b>Пользователь с таким логином уже существует в базе данных</b>";
    }
    else
    {
    	$login = $_POST['login'];
        $pass = md5($_POST['password']);
        $email = $_POST['email'];
        mysqli_query($db,"INSERT INTO `userlist`.`users` SET user_login='".$login."', user_password='".$pass."', user_email='".$email."'");
        header("Location: auth.php"); 
        exit();
    }
}
?>



<form method="POST"><pre>
<link type="text/css" rel="stylesheet" href="css.css" /> 
<div id = "base">
    <input type="text" name="login" class="feedback-input" placeholder="login" required>
    <input type="password" name="password" class="feedback-input" placeholder="password" required>
    <input type="text" name="email" class="feedback-input" placeholder="email" required>
    <input type="submit" name='submit' value="Sign up">
</div>
</pre></form>
  