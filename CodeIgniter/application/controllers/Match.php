<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
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
            $this->load->view('match_lister',$data);
            $this->load->view('templates/bas');
        }
    }
}
