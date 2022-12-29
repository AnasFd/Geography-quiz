<!-- Using three queries -->
<!-- <div class="container"> -->
    <?php
        // if(($que_ans != NULL) && isset($mat_qui) && ($ans_que != NULL)) {
        //     echo "<h1>Quiz : ".$mat_qui->qui_name."</h1>"; 
        //     echo "<br />";  
        //     echo"<h4>Match : ".$mat_qui->mat_intitule."</h4>";
        //     echo "<br />";
        //     foreach($que_ans as $que){
        //         echo "<br />";
        //         echo "<dt>".$que["que_intitule"]."</dt>";
        //         foreach($ans_que as $ans){
        //             if($ans["que_id"] == $que["que_id"]){
        //                 echo "<dd>-".$ans["ans_texte"]."</dd>";
        //                 // Add three lines under after wanting to show corrige
        //                 // echo "<dd>-".$ans["ans_texte"]."   ";
        //                 // if(($mat_qui->mat_corrige == 1) && ($ans["ans_bonne"] == 'V'))
        //                 // echo '<span class="glyphicon glyphicon-ok"></span></dd>';
        //             }
        //         }
        //         echo "<br />";
        //     }
        // }
        // else {
        //     echo "<br />"; 
        //     echo "<br />"; 
        //     echo'<div class="alert alert-danger">
        //         <strong>Erreur!</strong> Aucun match associé à ce code.
        //     </div>';
        //     echo "<br />"; 
        //     echo "<br />"; 
        // }
        ?>
<!-- </div> -->

<!-- Using one query -->
<div class="container">
    <?php
        if($mat_info != NULL){
            echo form_open('match_lister');
            //Traitement des Titres
            foreach($mat_info as $m){
                // Pour les constants du resultats (qui_name and mat_intitule)
                if(!isset($traite[$m["qui_name"]])){
                    echo "<h1>Quiz : ".$m["qui_name"]."</h1>"; 
                    echo "<br />";  
                    echo"<h4>Match : ".$m["mat_intitule"]."</h4>";
                    echo "<br />";
                    $traite[$m["qui_name"]] = 1;
                    echo form_hidden('mat_id', $m["mat_id"]); //on passe l'id du match pour le nb des questions
                    echo form_hidden('mat_code', $m["mat_code"]); //on passe le code pour visualiser la page du score
                    echo form_hidden('pla_pseudo', $pla_pseudo);
                }
            }

            foreach($mat_info as $que){
               
                // Affichage d'une ligne contenant la question pour une question non traité
                if(!isset($traite[$que["que_intitule"]])){
                    $que_intitule = $que["que_intitule"];

                    echo form_hidden('que_intitule[]',$que["que_id"]);
                    echo "<dt>".$que["que_intitule"]."</dt>";
                    
                    // boucle d'affichage des reponses liées à une question
                    foreach($mat_info as $ans){
                        if(strcmp($que_intitule, $ans["que_intitule"]) == 0){
                            echo'<div class="radio">';
                                echo'<label><input type="checkbox" value="'.$ans["ans_id"].'" name="answers[]">'.$ans["ans_texte"].'</label>';
                            echo'</div>';

                        }
                    }
                    echo "<br />";
                    $traite[$que["que_intitule"]] = 1;
                }
            }
            echo '<input class="btn btn-default text-center" type="submit" name="submit" value="Terminer le match" />';
            echo "</form>";
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
