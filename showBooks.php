<?php
$db = new mysqli('localhost','root','','auth');

$q = $db->prepare("SELECT * FROM books ");
$q->execute();

$result_select = $q->get_result();
$tab = ['ID: ','Autor: ','Gatunek: ','Data wydania: ','Strony: ','Wydawnictwo: '];
$i = 0;
foreach($result_select as $var1){  
    foreach($var1 as $var2){
        if($i==6) $i = 0;
        echo $tab[$i];
        $i++;
        echo "$var2"."<br>";
        }
    echo "<br>";
}


?>