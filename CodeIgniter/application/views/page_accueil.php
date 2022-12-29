<!-- Match -->        
<div class="play text-center">
    <h1>Geographie</h1> 
    <p>Prêt à jouer?</p> 
    <?php echo form_open('page_accueil'); ?>
        <div class="input-group">
            <input type="input" class="form-control" name="mat_code" placeholder="Code match (8 caractères)">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-primary">Commencer!</button>
            </div>
        </div>
        <?php
            echo '</br>'; 
            echo validation_errors(); 
        ?>
    </form>
</div>

<!-- News -->
<div class="container">
    <h2><?php echo $titre;?></h2>
    <?php
        if($news != NULL) {         
            echo '<table class="table table-bordered">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Auteur</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>';
                    foreach($news as $new){
                        echo "<tr>";
                            echo '<td><a href="'.$this->config->base_url().'index.php/actualite/afficher/'.$new["new_id"].'">'.$new["new_titre"].'</a></td>';
                            // echo "<td>".$new["new_titre"]."</td>";
                            echo "<td>".$new["new_texte"]."</td>";
                            echo "<td>".$new["usr_pseudo"]."</td>";
                            echo "<td>".$new["new_date"]."</td>";
                        echo "</tr>";
                    }
                    echo"</tbody>
                </table>";
            }
        else {echo "<br />";
            echo "Aucune actualité pour l'instant !";
        }
    ?>  
</div>
