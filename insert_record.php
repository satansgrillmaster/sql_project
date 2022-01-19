<?php

    function create_record(){

        // setup db
        require_once ('./include/connect.php');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // set record attributes
        $name = htmlspecialchars($_POST['name']);
        $isbn = htmlspecialchars($_POST['isbn']);
        $price = htmlspecialchars($_POST['price']);

        // execute querry
        $sql = "insert into buch (buch_name, buch_isbn, buch_preis) values ('$name',$isbn,$price);";
        try{
            $db->exec($sql);
        }
        catch (PDOException $e){
            echo $e->getMessage() . '<br>';
            echo 'Querry: <b style="color: red">' . $sql . '</b><br>';
        }
    }

header('Content-Type: text/html; charset=UTF-8');
include('navigation.html');

if(isset($_POST['send'])){
    create_record();
}

echo '<div class="container">';
echo '<h1>Buch hinzufügen</h1>';
echo '<form method="post" action="insert_record.php">';
echo '<label><input type="text" name="name">Buch Name</label>';
echo '<label><input type="text" name="isbn">Buch Isbn</label>';
echo '<label><input type="text" name="price">Buch Preis</label>';
echo '<input type="submit" name="send" value="Datensatz hinzufügen">';
echo '</form></div></body></html>';
