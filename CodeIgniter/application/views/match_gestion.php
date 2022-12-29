<div class="container">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2><?php echo $titre;?></h2>
        <a href="<?php echo $this->config->base_url(); ?>index.php/match/ajouter/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><span class="glyphicon glyphicon-plus"></span> Ajouter un match</a>
    </div>

    <?php
        if($quiz != NULL) {         
            echo '<table class="table table-bordered">
                <thead>
                <tr class="text-center">
                    <th>Titre du quiz</th>
                    <th>Description du quiz</th>
                    <th>Auteur du quiz</th>
                    <th>Titre du match</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Code du match</th>
                    <th>Auteur du match</th>
                    <th>Gestion des matches</th>
                </tr>
                </thead>
                <tbody>';
                    foreach($quiz as $q){
                        echo "<tr>";
                            echo "<td>".$q["qui_name"]."</td>";
                            echo "<td>".$q["qui_description"]."</td>";
                            echo "<td>".$q["auteurQuiz"]."</td>";
                            echo "<td>".$q["mat_intitule"]."</td>";
                            echo "<td>".$q["mat_debut"]."</td>";
                            echo "<td>";
                                echo ($q["mat_fin"] == NULL) ? 'Terminé' : $q["mat_fin"];
                            echo "</td>";

                            

                            echo '<td><a href="'.$this->config->base_url().'index.php/match/lister_url/'.$q["mat_code"].'">'.$q["mat_code"].'</a></td>';
                            echo "<td>".$q["auteurMatch"]."</td>";
                            echo '<td class="text-center">';
                                if(strcmp($username,$q["auteurMatch"]) == 0){
                                    echo '
                                    <div class="btn-group-vertical text-center">
                                        
                                        <a class="btn btn-warning btn-sm" href="'.$this->config->base_url().'index.php/match/raz/'.$q["mat_code"].'" role="button">RAZ</a>';

                                        if($q["mat_etat"] == 'D'){ // si le match est desactivé :
                                            echo '<a class="btn btn-primary btn-sm" href="'.$this->config->base_url().'index.php/match/activate/'.$q["mat_code"].'" role="button">Activer</a>';
                                        }
                                        else{
                                            echo '<a class="btn btn-primary btn-sm" href="'.$this->config->base_url().'index.php/match/deactivate/'.$q["mat_code"].'" role="button">Désactiver</a>';
                                        }
                                    echo'
                                        <a class="btn btn-danger btn-sm" href="'.$this->config->base_url().'index.php/match/supprimer/'.$q["mat_id"].'" role="button">Supprimer</a>
                                    </div>';
                                }
                                else
                                    echo "Non disponible";
                            echo '</td>';
                        echo "</tr>";
                    }
                    echo"</tbody>
                </table>";
            }
        else {echo "<br />";
            echo "Aucun quiz pour l'instant !";
        }
    ?>  
</div>