<body>

    <div class="container">

        <!-- Match -->
        <div class="row">
            <!-- old 
            <?php
                // echo validation_errors();
                // echo form_open('page_accueil');
                // echo form_label('Code match :');
                // $champ1=array('name'=>'mat_code',
                // 'required'=>'required');
                // echo form_input($champ1);
            ?> -->
            
            <?php echo validation_errors(); ?>
            <?php echo form_open('page_accueil'); ?>
            <label for="mat_code">Code match :</label>
            <input type="input" name="mat_code" /><br />

            <input type="submit" name="submit" value="Submit" />
            
            </form>

        </div>


        <!-- News -->
        <div class="row">
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
                                    echo "<td>".$new["new_titre"]."</td>";
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
    </div>
</body>