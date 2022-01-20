<?php
$logged_in = false;
$sql = '';
$username = '';
$pw ='';

function authentification(){

    //variable declaration
    global $sql;
    global $username;
    global $pw;
    $logged_in = false;

    // setup db connection
    require_once('./include/connect.php');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // prepared statement to prevent sql injections
    $sql = "select username, password from users where password = :password and username = :username";
    $prepare_state = $db->prepare($sql);
    $prepare_state->bindParam('username', $username);
    $prepare_state->bindParam('password', $pw);

    // set querry parameters with possibility for sql injection
    $username = $_POST['username'];
    $pw = $_POST['password'];
    $sql = "select username, password from users where password = '$pw' and username = '$username'";

    // execute querry
    //$result = $db->query($sql);
    $prepare_state->execute();

    // check if there's a valid account
    if($prepare_state -> rowCount()){
        $logged_in = true;
        $pw = $prepare_state['password'];
    }
    return $logged_in;
}

// send header
header('Content-Type: text/html; charset=UTF-8');
include('navigation.html');

// is user logged in ?
if(isset($_POST['login'])){
    $logged_in = authentification();
}

if($logged_in){
    global $sql;
    echo '<div class="container">';
    echo '<span style="font-size: larger"><p><b><span style="color: red;">Pw wurde gehackt ! Name des Accounts ist:</span> '.$username.'</b></p>';
    echo '<p><b><span style="color: red;">Pw des Accounts ist:</span> '.$pw.'</b></p>';
    echo $sql;
    echo '</span>';
}
else{
    echo '<div class="container">';
    echo '<h1>Login</h1>';
    echo '<form method="post" action="login.php" accept-charset="utf-8">';
    echo '<p> PS: Versuche den "admin" benutzer zu hacken ;) </p>';

    echo '<label><input type="text" name="username">Username</label>';
    echo '<label><input type="text" name="password">Passwort</label>';

    echo '<input type="submit" name="login" value="Login">';
    echo '</form>';
}
echo '</div></body></html>';
