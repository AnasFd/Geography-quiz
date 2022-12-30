<body>
    <div class="container">

        <?php echo validation_errors(); ?>
        <?php echo form_open('compte_creer'); ?>
        <label for="id">Pseudo</label>
        <input type="input" name="pseudo" /><br />
        <label for="mdp">Mot de passe</label>
        <input type="input" name="mdp" /><br />
        <input type="submit" name="submit" value="Créer un compte" />
        </form>

    </div>
</body>






<!-- Autre syntaxe pour le code formulaire  -->
<!-- <?php /*
    //code before update
    echo validation_errors();
    echo form_open('compte_creer');
    echo form_label('Pseudo :');
    $champ1=array('name'=>'pseudo',
    'required'=>'required');
    echo form_input($champ1);
    echo form_label('Mot de passe :');
    $champ2=array('name'=>'mdp',
    'required'=>'required');
    echo form_input($champ2);
    */
    
?> -->