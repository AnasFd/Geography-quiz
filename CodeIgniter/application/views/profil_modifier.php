<div class="container">
    <h2><?php echo $titre;?></h2>
    <div class="row">
        <div class="col-sm-6">
        <?php if(isset($pfl_info)){ ?>

            <?php echo form_open('profil_modifier'); ?>

            <div class="form-group">
                <label class="control-label" for="nom">Nom:</label>
                <input type="input" class="form-control" name="nom" value="<?php echo $pfl_info->pfl_nom;?>" readonly />
            </div>

            <div class="form-group">
                <label class="control-label" for="prenom">Prénom:</label>
                <input type="input" class="form-control" name="prenom" value="<?php echo $pfl_info->pfl_prenom;?>" readonly />
            </div>

            <div class="form-group">
                <label class="control-label" for="mdp">Mot de passe:</label>
                <input type="password" class="form-control" name="mdp" />
            </div>

            <div class="form-group">
                <label class="control-label" for="con_mdp">Confirmation mot de passe:</label>
                <input type="password" class="form-control" name="con_mdp" />
            </div>

            <!-- add cacel button -->
            <div class="form-group form-inline">
                <a class="btn btn-default" href="<?php echo base_url();?>index.php/profil_lister" role="button">Annuler</a>
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
