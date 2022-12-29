<h1><?php echo $titre;?></h1>
<br />
<?php
if(isset($actu)) {
    echo $actu->new_id;
    echo(" -- ");
    echo $actu->new_texte;
}
else {
    echo "<br />";
    echo "pas d’actualité !";
}
?>