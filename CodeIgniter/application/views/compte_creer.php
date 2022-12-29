<div class="container" style="margin-top: 40px;margin-bottom: 40px;">
    <div class="col-sm-4">
        <?php echo form_open('compte/creer'); ?>
            <div class="form-group">
                <label class="control-label" for="pseudo">Pseudo:</label>
                <input type="input" class="form-control" name="pseudo" />
            </div>
            
            <div class="form-group">
                <label class="control-label" for="mdp">Mot de passe:</label>
                <input type="password" class="form-control" name="mdp" />
            </div>
            
            <input class="btn btn-default text-center" type="submit" name="submit" value="Creer" />

            <?php
                echo '</br>'; 
                echo validation_errors(); 
            ?>
        
        </form>
    </div>
</div>