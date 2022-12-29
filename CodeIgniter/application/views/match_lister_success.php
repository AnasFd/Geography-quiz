<div class="container">
    <?php
        if($mat_info != NULL){
            //Traitement des Titres
            foreach($mat_info as $m){
                // Pour les constants du resultats (qui_name and mat_intitule)
                if(!isset($traite[$m["qui_name"]])){
                    echo "<h1>Quiz : ".$m["qui_name"]."</h1>"; 
                    echo "<br />";  
                    echo"<h4>Match : ".$m["mat_intitule"]."</h4>";
                    echo "<br />";
                    $traite[$m["qui_name"]] = 1;
                }
            }

            echo "<h4>Bravo ".$pla_pseudo.", votre score : ".$score." %</h4>";

            foreach($mat_info as $que){
               
                // Affichage d'une ligne contenant la question pour une question non traité
                if(!isset($traite[$que["que_intitule"]])){
                    $que_intitule = $que["que_intitule"];

                    echo "<dt>".$que["que_intitule"]."</dt>";
                    
                    // boucle d'affichage des reponses liées à une question
                    foreach($mat_info as $ans){
                        if(strcmp($que_intitule, $ans["que_intitule"]) == 0){
                            // echo'<div class="radio">';
                            //     echo'<label><input type="radio" value="'.$ans["ans_texte"].'" name="pla_answer">'.$ans["ans_texte"].'</label>';
                            // echo'</div>';
                            // Add three lines under after wanting to show corrige
                            echo "<dd>-".$ans["ans_texte"]."   ";
                            if(($ans["mat_corrige"] == 1) && ($ans["ans_bonne"] == 'V'))
                            echo '<span class="glyphicon glyphicon-ok"></span></dd>';
                        }
                    }
                    echo "<br />";
                    $traite[$que["que_intitule"]] = 1;
                }
            }
        }
        else {
            echo "<br />"; 
            echo "<br />"; 
            echo'<div class="alert alert-danger">
                <strong>Erreur!</strong> Aucun match associé à ce code.
            </div>';
            echo "<br />"; 
            echo "<br />"; 
        }
    ?>
</div>