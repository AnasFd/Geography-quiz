<div class="container">
    <h2><?php echo $titre;?></h2>
    <div class="row">
        <div class="col-sm-6">
        <?php if(isset($quiz)){ ?>

            <?php echo form_open('match_ajouter'); ?>

            <div class="form-group">
                <label class="control-label" for="mat_intitule">Intitule:</label>
                <input type="input" class="form-control" name="mat_intitule" placeholder="Match intitule"/>
            </div>

            <div class="form-group">
                <label class="control-label" for="mat_debut">Date début:</label>
                <input type="datetime-local" class="form-control" name="mat_debut"/>
            </div>

            <div class="form-group">
                <label class="control-label" for="mat_fin">Date fin:</label>
                <input type="datetime-local" class="form-control" name="mat_fin" />
            </div>

            <!--something for quiz here -->
            <div class="form-group">
                <label for="qui_intitule">Quiz:</label>
                <select class="form-control" name="qui_intitule">
                    <?php
                        foreach($quiz as $q)
                            echo "<option value='".$q["qui_name"]."'>".$q["qui_name"]."</option>";
                    ?>
                </select>
            </div>
            
            <div class="form-group form-inline">
                <a class="btn btn-default" href="<?php echo base_url();?>index.php/match/gestion/" role="button">Annuler</a>
                <input class="btn btn-default" type="submit" name="submit" value="Valider" />
            </div>

            <?php if($this->session->flashdata('status')) : ?>
                <div class="alert alert-<?php echo $status ?>" role="alert">
                    <?= $this->session->flashdata('status'); ?>
                </div>
            <?php endif; ?>

            </form>
        <?php 
        }
        else{
            echo 'Problème d\'affichage du form';
        }
        ?>
        </div>
    </div>
</div>
