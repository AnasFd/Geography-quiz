<?php
$username = $this->session->userdata('username');

if(isset($username)){
    echo "<h2>Espace d'administration</h2>
    <br />
    <h2>Session ouverte ! Bienvenue ".$username."</h2>";
}
else
    redirect(base_url());
?>