<?php

// setup db connection
require_once('./include/connect.php');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//if delete is clicked, all selected records will be removed
if(isset($_POST['delete'])){
    $checkboxes = $_POST['record_check'];
    $delete_string = '';
    foreach ($checkboxes as $id){
        if($id != ''){
            $delete_string = $delete_string . $id . ",";
        }
    }

    $sql = "delete from buch where buch_id in ($delete_string 0)";
    $db->exec($sql);
}

// select all records to show in table
$sql = 'select * from buch';
$result = $db->query($sql);
$db = null;

// send header
header('Content-Type: text/html; charset=UTF-8');
include('navigation.html');

echo '<div class="container">';
echo '<h1>Bücher</h1>';
echo '<form method="post" action="show_records.php" accept-charset="utf-8">';
echo '<table>';
echo '<label>Alle auswählen<input type="checkbox" onclick="toggle()" id="select_all"></label>';

//print table with records
foreach ($result as $value){
    echo '<tr><td><input type="checkbox" name="record_check[]" value="'. $value['buch_id'].'" class="check"></td>';

    foreach ($value as $column){
        echo '<td>'.$column.'</td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '<input type="submit" name="delete" value="Datensätze löschen">';
echo '</form></div></body></html>';

$result = null;
?>

<script>
    // function to select or deselect all records
    function toggle() {
        checkboxes = document.getElementsByClassName('check');
        for(var checkbox in checkboxes){
            checkboxes[checkbox].checked = checkboxes[checkbox].checked !== true;}
    }
</script>
