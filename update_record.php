<?php

// setup db connection
require_once('./include/connect.php');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// send header
header('Content-Type: text/html; charset=UTF-8');
include('navigation.html');

$id =  $_POST['record'];
$sql = "select * from buch where buch_id = $id";
$result = $db->query($sql);

echo '<div class="container">';
echo '<h1>Buch ändern</h1>';
echo '<form method="post" action="edit_record_select.php" accept-charset="utf-8">';

// print dropdown with records
echo '<select name="record">';
foreach ($result as $record){
    echo '<option value="'.$record['buch_id'].'">'.$record['buch_name'] .'</option>';
}
echo '</select>';
echo '<label><input type="text" name="name">Neuer Name</label>';
echo '<label><input type="text" name="isbn">Neue Isbn</label>';
echo '<label><input type="text" name="price">Neuer Preis</label>';
echo '<input type="submit" name="update" value="Speichern">';
echo '</form>';
echo '</div></body></html>';

$db = null;
$result = null;