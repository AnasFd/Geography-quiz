<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
    }

    public function home(){
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');

        if(isset($username) && isset($role)){
            if($role == 'F'){
                $this->load->view('templates/menu_formateur');
                $this->load->view('compte_menu');
                $this->load->view('templates/bas');
            }
            else{
                $this->load->view('templates/menu_administrateur');
                $this->load->view('compte_menu');
                $this->load->view('templates/bas');
            }
        }
        else{
            redirect('/accueil/afficher/');
        }
    }

    

}