<?php

header('Content-Type: text/html; charset=UTF-8');
include('navigation.html');
echo '<div class="container">';

#print all records from table buch
echo '<table>';
require_once('./include/connect.php');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$sql = 'select * from buch';
$result = $db->query($sql);
$db = null;

echo '<h1>Bücher</h1>';
echo '<table>';
foreach ($result as $value){
    echo '<tr>';
    foreach ($value as $column){
        echo '<td>'.$column.'</td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '</div></body></html>';