<body>
    <div class="container">
        <?php
            // if(isset($mat_code)){
                echo validation_errors();
                echo form_open('accueil_pseudo');
                echo '
                    <label for="pla_pseudo">Choisir pseudo :</label>
                    <input type="input" name="pla_pseudo" /><br />
                    <input type="submit" name="submit" value="Submit" />
                    <input type="hidden" name="mat_code" value="'.$mat_code.'">
                    </form>
                    ';
            // }
            // else
            // echo "Something wrong happened";
            // echo '<br />';
        ?>
    </div>
</body>

