<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        //$this->load->helper('url'); //since we autoload it in /config/autoload.php
    }

    public function lister(){
        //On doit afficher les informations de l'utilisateur connecté ici
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');

        $data['profil'] = $this->db_model->get_pfl_info($username);
        

        if(isset($username) && isset($role)){
            if($role == 'F'){
                $this->load->view('templates/menu_formateur');
                $this->load->view('profil_lister',$data);
                $this->load->view('templates/bas');
            }
            else{
                $data['titre'] = 'Tous les profils:';
                $this->load->view('templates/menu_administrateur');
                $this->load->view('profil_lister',$data);
                $this->load->view('templates/bas');
            }
        }
        else{
            redirect('/accueil/afficher/');
        }
    }

    public function modifier(){
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $data['titre'] = 'Modifier vos informations :';
        $data['pfl_info'] = $this->db_model->get_pfl_info($username);

        $this->load->helper('form');

        $mdp = $this->input->post('mdp');
        //$this->form_validation->set_rules('mdp', 'Password', 'required');
        //$con_mdp = $this->input->post('con_mdp');
        $this->form_validation->set_rules('con_mdp', 'Confirm_password', 'required|callback_mdp_check['.$mdp.']');
        if($role == 'F'){
            if ($this->form_validation->run() == FALSE){
                $data['status'] = 'danger'; //afficher un message en rouge
                $this->session->set_flashdata('status', validation_errors());
                $this->load->view('templates/menu_formateur');
                $this->load->view('profil_modifier',$data);
                $this->load->view('templates/bas');
            } else{
                $data['status'] = 'success'; //afficher un message en vert
                $this->session->set_flashdata('status', 'Mot de passe modifié avec succès');
                $this->load->view('templates/menu_formateur');
                $this->load->view('profil_modifier',$data);
                $this->load->view('templates/bas');
            }
        }
        else{
            if ($this->form_validation->run() == FALSE){
                $data['status'] = 'danger'; //afficher un message en rouge
                $this->session->set_flashdata('status', validation_errors());
                $this->load->view('templates/menu_administrateur');
                $this->load->view('profil_modifier',$data);
                $this->load->view('templates/bas');
            } else{
                $data['status'] = 'success'; //afficher un message en vert
                $this->session->set_flashdata('status', 'Mot de passe modifié avec succès');
                $this->load->view('templates/menu_administrateur');
                $this->load->view('profil_modifier',$data);
                $this->load->view('templates/bas');
            }
        }
        
    }

    public function mdp_check($mdp,$con_mdp){
        if($mdp == NULL || $con_mdp == NULL){
            $this->form_validation->set_message('mdp_check', 'Champs de saisie vides !');
            return FALSE;
        }
        else{
            if(strcmp($mdp,$con_mdp) != 0){
                $this->form_validation->set_message('mdp_check', 'Confirmation du mot de passe erronée, veuillez réessayer !');
                return FALSE;
            }
            else{
                $username = $this->session->userdata('username');
                $password = $this->db_model->my_hash($mdp);
                if($this->db_model->update_password($username,$password))
                    return TRUE;
                else{
                    $this->form_validation->set_message('mdp_check', 'Problème de requete !');
                    return FALSE;
                }
            }
        }

    }

    public function lister_comptes(){
        $data['titre'] = 'Tous les profils:';
        $data['profils'] = $this->db_model->get_all_profil();
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');

        if(isset($username) && isset($role)){
            if($role == 'A'){
                $this->load->view('templates/menu_administrateur');
                $this->load->view('profil_lister_comptes',$data);
                $this->load->view('templates/bas');
            }
            else{
                redirect('/accueil/afficher/');
            }
        }
        else{
            redirect('/accueil/afficher/');
        }
    }
}