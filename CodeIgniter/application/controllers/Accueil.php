<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
        //switched it from afficher() to here cause I will use it globally
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
    public function afficher(){
        $this->form_validation->set_rules('mat_code', 'Code match', 'required|callback_match_check');

        $data['titre'] = 'Actualités :';
        $data['news'] = $this->db_model->get_all_news();

        if ($this->form_validation->run() == FALSE){
            $this->load->view('menu_visiteur');
            $this->load->view('page_accueil',$data);
            $this->load->view('templates/bas');
        }
        else{
            $data['mat_code'] = $this->input->post('mat_code');
            // $data['que_ans'] = $this->db_model->get_que($mat_code);
            // $data['mat_qui'] = $this->db_model->get_mat_qui($mat_code);
            // $data['ans_que'] = $this->db_model->get_ans($mat_code);
            $this->load->view('menu_visiteur');
            $this->load->view('accueil_pseudo',$data);
            $this->load->view('templates/bas');
        }
    }

    //function to check the length and existance of mat_code given in forum
    public function match_check($str){
        $mat_ok = $this->db_model->check_match();

        if (strlen($str)!=8){
            $this->form_validation->set_message('match_check', 'Code de match doit avoir 8 caractere');
            return FALSE;
        }
        else if(!isset($mat_ok)){
            $this->form_validation->set_message('match_check', 'Code de match inexistant, veuillez saisir le code fourni par votre formateur !');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    public function pseudo(){
        $mat_code = $this->input->post('mat_code');
        $data['mat_code'] = $mat_code;
        $this->form_validation->set_rules('pla_pseudo','Pseudo','required|max_length[11]|callback_pseudo_check['.$mat_code.']');


        if($this->form_validation->run() == FALSE){
            $this->load->view('menu_visiteur');
            $this->load->view('accueil_pseudo',$data);
            $this->load->view('templates/bas');
        }
        else{
            $data['mat_info'] = $this->db_model->get_que_ans($mat_code);

            $this->load->view('menu_visiteur');
            $this->load->view('match_lister',$data);
            $this->load->view('templates/bas');

            //redirect('match_lister',$data);
        }
    }

    public function pseudo_check($pla_pseudo,$mat_code){
        $pseudo_in_match = $this->db_model->check_pseudo();

        if (strlen($pla_pseudo)>20){
            $this->form_validation->set_message('pseudo_check', 'Le Pseudo ne doit pas dépasser 20 caractères!');
            return FALSE;
        }
        else if(isset($pseudo_in_match)){ //si le resultat n'est pas NULL donc il existe un pseudo associé à ce match
            $this->form_validation->set_message('pseudo_check', 'Le pseudo choisi est déjà utilisé, vueillez choisissez un autre!');
            return FALSE;
        }
        else{ //on doit inserer le pseudo dans la base de donnee si les conditions sont satisfaites
            $query = $this->db->query("select mat_id from t_match_mat where mat_code like '".$mat_code."';");
            $row = $query->row();
            if(isset($row)){
                $data = array(
                    'pla_id' => NULL,
                    'pla_pseudo' => $pla_pseudo,
                    'pla_score' => NULL,
                    'mat_id' => $row->mat_id
                );
                $this->db->insert('t_player_pla',$data);
            }
            else{
                $this->form_validation->set_message('pseudo_check', 'Problème d\'insertion');
                return FALSE;
            }
            return TRUE;
        }
    }

}
