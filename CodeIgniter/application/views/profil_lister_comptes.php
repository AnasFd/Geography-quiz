<?php if(isset($profils)){ ?>
<div class="container">
    <h2><?php echo $titre;?></h2>
    <?php
    if($profils != NULL) {         
        echo '<table class="table table-bordered">
            <thead>
            <tr>
                <th>Pseudo</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>';
                foreach($profils as $p){
                    echo "<tr>";
                        echo "<td>".$p["usr_pseudo"]."</td>";
                        echo "<td>".$p["pfl_prenom"]."</td>";
                        echo "<td>".$p["pfl_nom"]."</td>";
                        echo "<td>".$p["pfl_mail"]."</td>";
                    echo "</tr>";
                }
                echo"</tbody>
            </table>";
    }
    else{
        echo "Pas de profil pour l'instant";
    }
    ?>

</div>

<?php } ?>