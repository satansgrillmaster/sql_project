<?php
$logged_in = false;
function login(){
    require_once('./include/connect.php');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $username = $_POST['username'];
    $pw = $_POST['password'];
    $sql = "select username, password from users where password = '$pw' and username = '$username'";
    $result = $db->query($sql);

    foreach ($result as $user){
        echo $user['username'];
    }
    if($result){
        return true;
    }
    return false;
}

header('Content-Type: text/html; charset=UTF-8');
include('navigation.html');

if(isset($_POST['login'])){
    $logged_in = login();
}

if($logged_in){
    echo "Du bist eingeloggt !";
}
else{
    echo '<div class="container">';
    echo '<h1>Login</h1>';
    echo '<form method="post" action="login.php">';

    echo '<label><input type="text" name="username">Username</label>';
    echo '<label><input type="text" name="password">Passwort</label>';

    echo '<input type="submit" name="login" value="Login">';
    echo '</form></div></body></html>';
}