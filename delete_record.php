<?php

// setup db
require_once('./include/connect.php');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

header('Content-Type: text/html; charset=UTF-8');
include('navigation.html');

if(isset($_POST['delete'])){
    $id = htmlspecialchars($_POST['record']);
    $sql = 'delete from buch where buch_id = ' . $id;
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
echo '<h1>Bücher löschen</h1>';
echo '<form method="post" action="delete_record.php" accept-charset="utf-8">';
echo '<select name="record">';
foreach ($result as $record){
    echo '<option value="'.$record['buch_id'].'">'.$record['buch_name'] .'</option>';
}
echo '</select>';
echo '<input type="submit" name="delete" value="Löschen">';
echo '</form>';
echo '</div></body></html>';

$db = null;
$result = null;