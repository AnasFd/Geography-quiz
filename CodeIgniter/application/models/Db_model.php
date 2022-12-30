<?php

class Db_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    //All logins query
    public function get_all_compte(){
        $query = $this->db->query("SELECT usr_pseudo FROM t_user_usr;");
        return $query->result_array();
    }

    //Compter le nombre des comptes presents dans la table des comptes
    public function get_acc_count(){
        $query = $this->db->query("select count(usr_pseudo) as nbUsr from t_user_usr;");
        return $query->row();
    }

    //One 'new' query given the id in the title ($numero)
    public function get_new($numero){
        $query = $this->db->query("select new_id, new_texte from t_news_new where new_id=".$numero.";");
        return $query->row();
    }

    public function get_all_news(){
        $query = $this->db->query("select new_titre,new_texte,cast(new_date as DATE) as new_date ,usr_pseudo from t_news_new order by new_date desc limit 5;");
        return $query->result_array();
    }

    public function get_que_ans($mat_code){
        $query = $this->db->query("select qui_name, mat_intitule, que_intitule, ans_texte from t_answer_ans
                                    join t_question_que using(que_id)
                                    join t_match_mat using(qui_id)
                                    join t_quiz_qui using(qui_id)
                                    where mat_code = '".$mat_code."';");
        return $query->result_array();
    }

    public function set_compte(){
        $pseudo=$this->input->post('pseudo');
        $mdp=$this->input->post('mdp');
        $req="INSERT INTO t_user_usr VALUES ('".$pseudo."','".$mdp."','F','D');";
        $query = $this->db->query($req);
        return ($query);
    }

    public function check_match(){
        $mat_code = $this->input->post('mat_code');
        $sql = "select mat_intitule from t_match_mat join t_quiz_qui using(qui_id) where mat_code = '".$mat_code."';";
        $query = $this->db->query($sql);
        return $query->row();//here we return a row so we need to see if it's not null (like 1 actualite)
    }

    public function check_pseudo(){
        $pla_pseudo = $this->input->post('pla_pseudo');
        $mat_code = $this->input->post('mat_code');
        $sql = "select pla_pseudo from t_player_pla join t_match_mat using(mat_id) where mat_code = '".$mat_code."' and pla_pseudo = '".$pla_pseudo."'; ";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function connect_compte($username, $userspassword){
        //the salt
        $salt = "IhaveChosenYouAsmyLordAndSavior!!34682__Test";

        //Salted password using the php hash function
        $password = hash('sha256', $salt . $userspassword);
        $query = $this->db->query("SELECT usr_pseudo,usr_mdp
                                    FROM t_user_usr
                                    WHERE usr_pseudo = '".$username."'
                                        AND usr_mdp = '".$password."'
                                        AND usr_etat = 'A';");
        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }


}