<link rel="preconnect" href="https://fonts.gstatic.com">

       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
       <link rel = "stylesheet" href="bs.css">
        <link rel = "stylesheet" href="style.css">
<?php include("header.php"); ?>
<?php

session_start();

if(isset($_POST["register"])){
if(!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['pass_word']) && !empty($_POST['pass_word_check'])) {
    if ((($_POST['pass_word_check'])==($_POST['pass_word']))) {
 $connect=mysqli_connect('localhost', 'root', 'root', 'plushy_friends');
 $login=mysqli_real_escape_string($connect,$_POST['login']);

 $email=mysqli_real_escape_string($connect,$_POST['email']);
 $pass_word=mysqli_real_escape_string($connect,$_POST['pass_word']);
 $query=mysqli_query($connect,"SELECT * FROM `users` WHERE login='{login}'");
    $myrow = mysqli_fetch_array($query);
 $numr=mysqli_num_rows($query);
 if($numr==0)
 {
 $sql_q="INSERT INTO `users`
 (login, email, pass_word)
 VALUES('{$login}', '${email}', '{$pass_word}')";
 $res=mysqli_query($connect,$sql_q);
 if($res){  
     $_SESSION['login']=$myrow['login']; 
    $_SESSION['id']=$myrow['id'];
     
        echo '<div class="alert alert-success" role="alert">Вы удачно зарегистрировались!</div>';
        echo "<script language='javascript'>\n";    
        echo "window.history.back()"; 
        echo "</script>\n";
 }
 else {
        echo '<div class="alert alert-danger" role="alert">Не удалось добавить информацию</div>';
        echo "<script language='javascript'>\n";    
        echo "window.history.back()"; 
        echo "</script>\n";
 }
 }
else {
        echo '<div class="alert alert-danger" role="alert">Этот логин занят. Попробуйте другой!</div>';
        echo "<script language='javascript'>\n";    
        echo "window.history.back()"; 
        echo "</script>\n";
 }
    }
    else {
        
        echo '<div class="alert alert-danger" role="alert">Пароли не совпадают!</div>';
        echo "<script language='javascript'>\n";    
        echo "window.history.back()"; 
        echo "</script>\n";
  

 }
}else {
    echo '<div class="alert alert-danger" role="alert">Все поля обязательны для заполнения!</div>';
        echo "<script language='javascript'>\n";    
        echo "window.history.back()"; 
        echo "</script>\n";
}
}
?>