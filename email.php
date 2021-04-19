<?php

$db = mysqli_connect('localhost', 'root', '') or die ('Нет соединения');
if(!empty($_GET['code']) && isset($_GET['code']))
{

    $query = mysqli_query($db, "SELECT user_id FROM `userlist`.`users` WHERE user_hash='".$_GET['code']."'");
    if(mysqli_num_rows($query) > 0)
    {
        mysqli_query($db, "UPDATE `userlist`.`users` SET user_confirmed='TRUE' WHERE user_hash='".$_GET['code']."'");
        echo "Ваш email успешно подтвержден";
    }
    else{
        echo 'При подтверждении произошла ошибка';
    }
}
else{
    echo 'Не правильная ссылка на подтверждение';
}
?>






































