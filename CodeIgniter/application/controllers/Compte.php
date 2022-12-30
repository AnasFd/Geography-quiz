<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Compte extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        //$this->load->helper('url'); //since we autoload it in /config/autoload.php
    }

    public function lister(){
        $data['titre'] = 'Liste des pseudos';
        $data['pseudos'] = $this->db_model->get_all_compte();
        $data['title'] = 'Nombres de comptes';
        $data['nbUsr'] = $this->db_model->get_acc_count();

        $this->load->view('templates/haut');
        $this->load->view('compte_liste',$data);
        $this->load->view('templates/bas');
    }

    public function creer(){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'pseudo', 'Pseudo',
            'required|max_length[20]|is_unique[t_user_usr.usr_pseudo]',
            array(
                    'required'      => 'Veuillez choisir un %s.',
                    'is_unique'     => 'Ce %s existe déjà.'
            )
        );
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/haut');
            $this->load->view('compte_creer');
            $this->load->view('templates/bas');
        }
        else{

            $pseudo=html_escape($this->input->post('pseudo'));
            $mdp=html_escape($this->input->post('mdp'));

            $this->db_model->set_compte($pseudo,$mdp);
            $data['message']="Nouveau nombre de comptes : ";
            //appel de la fonction créée dans le précédent tutoriel :
            $data['acc_nb']=$this->db_model->get_acc_count();
            $this->load->view('templates/haut');
            $this->load->view('compte_succes',$data);
            $this->load->view('templates/bas');
        }
    }

    public function connecter(){

        $this->load->helper('form');
        $this->load->library('form_validation');

        //Pas besoin de verifier le pseudo ici puisque on peut le verifier dans la fonction login_check en le passant comme deuxième paramètre
        $username = $this->input->post('pseudo');
        $this->form_validation->set_rules('mdp', 'mdp', 'required|callback_login_check['.$username.']');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/haut');
            $this->load->view('compte_connecter');
            $this->load->view('templates/bas');
        }
        else{
            //retrieving the usr role knowing the user pseudo
            $role = $this->db->get_where('t_user_usr', array('usr_pseudo' => $username))->row();

            //Setting the ssession data
            $session_data = array('username' => $username , 'role' => $role->usr_role);
            $this->session->set_userdata($session_data);
            
            redirect('/backoffice/home/');
        }
    }
    
    public function login_check($password,$username){
        if($password != NULL && $username != NULL){ //Si les deux champs sont remplis
            $pwd = html_escape($password);
            $usr = html_escape($username);
            if($this->db_model->connect_compte($usr,$pwd)) //Si le couple exist dans la bd
                return true;
            else{
                $this->form_validation->set_message('login_check', 'Identifiants erronés ou inexistants !');
                return false;
            }
        }
        else{ //l'un des deux champs (ou les deux) n'est pas rempli
            $this->form_validation->set_message('login_check', 'Veuillez remplir tous les champs');
            return false;
        } 
    }
    
    public function disconnect(){
        unset(
            $_SESSION['username'],
            $_SESSION['role']
        );
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
