<?php

// setup db connection
require_once('./include/connect.php');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// send header
header('Content-Type: text/html; charset=UTF-8');
include('navigation.html');

if(isset($_POST['update'])){

    // set record attributes
    $name = htmlspecialchars($_POST['name']);
    $id = htmlspecialchars($_POST['record']);

    // execute querry
    $sql = "update buch set buch_name = '$name' where buch_id = $id";
    try{
        $db->exec($sql);
    }
    catch (PDOException $e){
        echo $e->getMessage() . '<br>';
        echo 'Querry: <b style="color: red">' . $sql . '</b><br>';
    }
}

$sql = 'select * from buch';
$result = $db->query($sql);

echo '<div class="container">';
echo '<h1>Bücher ändern</h1>';
echo '<form method="post" action="update_record.php" accept-charset="utf-8">';

// print dropdown with records
echo '<select name="record">';
foreach ($result as $record){
    echo '<option value="'.$record['buch_id'].'">'.$record['buch_name'] .'</option>';
}
echo '</select>';
echo '<label><input type="text" name="name">Neuer Name</label>';
echo '<input type="submit" name="update" value="Ändern">';
echo '</form>';
echo '</div></body></html>';

$db = null;
$result = null;