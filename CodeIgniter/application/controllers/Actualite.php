<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Actualite extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
    }
    
    public function afficher($numero =FALSE)
    {
        if($numero==FALSE){
            $url=base_url(); header("Location:$url");
        }
        else{
            $data['titre'] = 'Actualité :';
            $data['actu'] = $this->db_model->get_new($numero);

            // Chargement des 3 vues pour créer la page Web d’accueil
            $this->load->view('templates/haut');
            $this->load->view('actualite_afficher',$data);
            $this->load->view('templates/bas');
        }

    }
}
