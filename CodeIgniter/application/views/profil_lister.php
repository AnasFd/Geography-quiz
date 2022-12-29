<div class="container">
  <h2>Informations personnelles:</h2>
  <div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-body">Pseudo : <?php echo $profil->usr_pseudo; ?></div>
        <div class="panel-body">Nom    : <?php echo $profil->pfl_nom; ?></div>
        <div class="panel-body">Prénom : <?php echo $profil->pfl_prenom; ?></div>
        <div class="panel-body">Email  : <?php echo $profil->pfl_mail; ?></div>
        <div class="panel-footer text-center"><a class="btn btn-primary" href="<?php echo base_url();?>index.php/profil/modifier" role="button">Modifier</a></div>
    </div>
  </div>
</div>

