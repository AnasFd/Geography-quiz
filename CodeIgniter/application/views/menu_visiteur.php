<!DOCTYPE html>
<html lang="en">

<head>
  <title>Geography quiz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
  </style>
</head>

<body>

    <nav class="navbar navbar-inverse" style="margin-bottom: 0px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo $this->config->base_url(); ?>index.php/page_accueil">Geography quiz</a>
            </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo $this->config->base_url(); ?>index.php/compte/connecter"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
                </ul>
        </div>
    </nav>
  