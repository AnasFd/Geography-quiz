<h1><?php echo $titre;?></h1>
<br />

<?php
if($pseudos != NULL) {
    foreach($pseudos as $login){
        echo "<br />";
        echo " -- ";
        echo $login["usr_pseudo"];
        echo " -- ";
        echo "<br />";
    }
    echo "<br />";
    echo $title;
    echo " : ";
    echo $nbUsr->nbUsr;
    echo "<br />";
}
else {echo "<br />";
    echo "Aucun compte !";
}
?>

