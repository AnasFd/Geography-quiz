<?php if(!($this->session->userdata('username'))) redirect('/compte/connecter/') ; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Geography quiz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- <link href="<?php //echo base_url();?>style/css/styles.css" rel="stylesheet" /> -->
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    .d-sm-flex {
        display: flex !important;
    }
    .justify-content-between {
    justify-content: space-between !important;
    }
    .align-items-center {
    align-items: center !important;
    }
  </style>
</head>

<body>
    <nav class="navbar navbar-inverse" style="margin-bottom: 20px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo $this->config->base_url(); ?>index.php/backoffice/home/">Geography quiz</a>
            </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url();?>index.php/profil/lister">Profil</a></li>
                    <li><a href="<?php echo base_url();?>index.php/match/gestion">Matchs</a></li>
                    <li><a href="<?php echo base_url();?>index.php/compte/disconnect"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
                </ul>
        </div>
    </nav>
  