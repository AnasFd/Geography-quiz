<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('string');
    }
    
    // this one should be commented
    public function lister_url($mat_code =FALSE){

        if($mat_code==FALSE){
            $url=base_url(); header("Location:$url");
        }
        else{
            // works but can be improved using only one query
            // $data['que_ans'] = $this->db_model->get_que($mat_code);
            // $data['mat_qui'] = $this->db_model->get_mat_qui($mat_code);
            // $data['ans_que'] = $this->db_model->get_ans($mat_code);

            $data['mat_info'] = $this->db_model->get_que_ans($mat_code);

            // Chargement des 3 vues pour créer la page Web d’accueil
            $this->load->view('menu_visiteur');
            $this->load->view('match_lister_url',$data);
            $this->load->view('templates/bas');
        }
    }

    public function gestion(){
        //Getting session username
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');

        if(isset($username)&& isset($role)){
            if($role == 'F'){ //Si l'utilisateur est connecté et est formateur
                $data['titre'] = 'Quiz actifs et matches associés:';
                $data['quiz'] = $this->db_model->get_quiz_match();
                $data['username'] = $username;

                $this->load->view('templates/menu_formateur');
                $this->load->view('match_gestion',$data);
                $this->load->view('templates/bas');
            }
            else{ //sinon redirection vers la page d'accueil
                redirect('/accueil/afficher');
            }
        }
        else{ //sinon redirection vers la page d'accueil
            redirect('/accueil/afficher');
        }
    }

    public function ajouter(){
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');

        $data['titre'] = 'Ajout d\'un match:';
        $data['quiz'] = $this->db_model->get_quiz_name();


        //match data
        $mat_intitule = $this->input->post('mat_intitule');
        $this->form_validation->set_rules('mat_intitule', 'Intitule match', 'required');
        $mat_debut = $this->input->post('mat_debut');
        $this->form_validation->set_rules('mat_debut', 'Date début', 'required');
        $mat_fin = $this->input->post('mat_fin');
        $this->form_validation->set_rules('mat_fin', 'Date fin', 'required');
        //no rules for the qui_intitle because only valid quiz are given as an option
        $qui_intitule = $this->input->post('qui_intitule');
        $mat_code = random_string('alnum', 8);
        

        if(isset($username)&& isset($role)){
            if($role == 'F'){ //Si l'utilisateur est connecté et est formateur
                if ($this->form_validation->run() == FALSE){
                    $data['status'] = 'danger'; //afficher un message en rouge
                    $this->session->set_flashdata('status', validation_errors());
                    $this->load->view('templates/menu_formateur');
                    $this->load->view('match_ajouter',$data);
                    $this->load->view('templates/bas');

                } else{ 
                    //insert match info
                    $query = $this->db->query("SELECT qui_id FROM t_quiz_qui WHERE qui_name = '".$qui_intitule."';");
                    $row = $query->row();
                    if(isset($row)){
                        $insert = array(
                            'mat_id' => NULL,
                            'mat_intitule' => $mat_intitule,
                            'mat_debut' => $mat_debut,
                            'mat_fin' => $mat_fin,
                            'mat_code' => $mat_code,
                            'mat_corrige' => 1,
                            'mat_etat' => 'A',
                            'qui_id' => $row->qui_id,
                            'usr_pseudo' => $username
                        );
                        $this->db->insert('t_match_mat',$insert);
                        
                    }
                    $data['status'] = 'success'; //afficher un message en vert
                    $this->session->set_flashdata('status', 'Match ajouté avec succès');
                    $this->load->view('templates/menu_formateur');
                    $this->load->view('match_ajouter',$data);
                    $this->load->view('templates/bas');
                }
            }
            else{ //sinon redirection vers la page d'accueil
                redirect('/accueil/afficher');
            }
        }
        else{ //sinon redirection vers la page d'accueil
            redirect('/accueil/afficher');
        }
    }

    public function lister(){

        /**** Traitement des données ****/
            $pla_pseudo = $this->input->post('pla_pseudo');
            $mat_code = $this->input->post('mat_code');
            //mat id : pour recuperer le nombre de questions dans un quiz associé à un match
            $mat_id = $this->input->post('mat_id');
            //les réponses du joueur
            $answers = $this->input->post('answers');
            $get_nb_que = $this->db_model->get_queNb_mat($mat_id);
            $total = $get_nb_que->nbQue;
            //compteur des reponses correctes
            $cpt = 0;
            if(isset($answers)){
                foreach($answers as $a){
                    $check_ans = $this->db_model->check_ans($a);
                    if($check_ans->ans_bonne == 'V')
                        $cpt = $cpt + 1;
                }
            }
            $score = $cpt*100/$total;
            $data['score'] = $score;
            $data['mat_info'] = $this->db_model->get_que_ans($mat_code);
            $data['pla_pseudo'] = $pla_pseudo;

        /**** Updating the score on the db ****/
        $this->db->set('pla_score', $score);
        $array = array('pla_pseudo' => $pla_pseudo, 'mat_id' => $mat_id);
        $this->db->where($array); 
        $this->db->update('t_player_pla');


        /***** Loading views *****/
        $this->load->view('templates/haut');
        $this->load->view('match_lister_success',$data);
        $this->load->view('templates/bas');
    }

    public function raz($mat_code =FALSE){
        if($mat_code==FALSE){
            redirect('/match/gestion/');
        }
        else{
            if($this->db_model->raz($mat_code)){
                redirect('/match/gestion/');
            }
            else{
                $this->load->view('test'); //error page
            }
        }
    }

    public function activate($mat_code =FALSE){
        if($mat_code==FALSE){
            redirect('/match/gestion/');
        }
        else{
            if($this->db_model->activate_mat($mat_code)){
                redirect('/match/gestion/');
            }
            else{
                $this->load->view('test');
            }
        }
    }

    public function deactivate($mat_code =FALSE){
        if($mat_code==FALSE){
            redirect('/match/gestion/');
        }
        else{
            if($this->db_model->deactivate_mat($mat_code)){
                redirect('/match/gestion/');
            }
            else{
                $this->load->view('test');
            }
        }
    }

    public function supprimer($mat_id =FALSE){
        if($mat_id==FALSE){
            redirect('/match/gestion/');
        }
        else{
            $this->db_model->delete_mat($mat_id);
            redirect('/match/gestion/');
        }
    }
}
