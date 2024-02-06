<?php include("header.php"); ?>
<?php
session_start();

if(isset($_POST["enter"])){
if(!empty($_POST['email']) && !empty($_POST['pass_word'])) {
 $connect=mysqli_connect('localhost', 'root', 'root', 'plushy_friends');
 $email=mysqli_real_escape_string($connect,$_POST['email']);
 $pass_word=mysqli_real_escape_string($connect,$_POST['pass_word']);
 $query=mysqli_query($connect,"SELECT * FROM `users` WHERE email= '$email' ");
$myrow = mysqli_fetch_array($query);

if (empty($myrow['pass_word']))
    {
    //если пользователя с введенным логином не существует
    exit ("<br /><br />Пользователя с указанным email не существует!");
    }
    
else {
    //если существует, то сверяем пароли

if ($myrow['pass_word']== ( "$pass_word" )){
    //если пароли совпадают, то запускаем данному пользователю сессию
    $_SESSION['login']=$myrow['login']; 
    $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, поэтому сессия запускается с использованием этих данных
    
	 echo '<div class="alert alert-success" role="alert">Добро пожаловать!</div>';
        echo "<script language='javascript'>\n";    
        echo "window.history.back()"; 
        echo "</script>\n";
    }

else {
    //если пароли не совпали, выводим на экран информацию об этом и пользователя не авторизовываем

    echo '<div class="alert alert-danger" role="alert">Неверный пароль</div>';
        echo "<script language='javascript'>\n";    
        echo "window.history.back()"; 
        echo "</script>\n";
}else {
  echo '<div class="alert alert-danger" role="alert">Все поля обязательны для заполнения!</div>';
        echo "<script language='javascript'>\n";    
        echo "window.history.back()"; 
        echo "</script>\n";
}
}
?>