<!-- Pseudo -->
<div class="play text-center">
    <h1>Geographie</h1> 
    <p>Choisir son pseudo!</p> 
    <?php echo form_open('accueil_pseudo'); ?>
        <div class="input-group">
            <input type="input" class="form-control" name="pla_pseudo" placeholder="Pseudo">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-primary">Jouer!</button>
            </div>
            <input type="hidden" name="mat_code" value="<?php echo $mat_code;?>">
        </div>
        <?php
            echo '</br>'; 
            echo validation_errors(); 
        ?>
    </form>
</div>

