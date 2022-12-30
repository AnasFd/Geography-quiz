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
        $query = $this->db->query("select new_id, new_titre,new_texte,cast(new_date as DATE) as new_date ,usr_pseudo from t_news_new order by new_date desc limit 5;");
        return $query->result_array();
    }

    public function get_que_ans($mat_code){
        $query = $this->db->query("select * from t_answer_ans
                                    join t_question_que using(que_id)
                                    join t_match_mat using(qui_id)
                                    join t_quiz_qui using(qui_id)
                                    where mat_code = '".$mat_code."';");
        return $query->result_array();
    }

    public function set_compte($pseudo,$mdp){
        //adding salt to the password
        $salt = "IhaveChosenYouAsmyLordAndSavior!!34682__Test";

        //Password salted
        $password = hash('sha256', $salt . $mdp);

        //inserting into the users table
        $req="INSERT INTO t_user_usr VALUES ('".$pseudo."','".$password."','F','D');";
        $query = $this->db->query($req);
        return ($query);
    }

    public function check_match($mat_code){
        $sql = "select mat_intitule from t_match_mat join t_quiz_qui using(qui_id) where mat_code = '".$mat_code."';";
        $query = $this->db->query($sql);
        return $query->row();//here we return a row so we need to see if it's not null (like 1 actualite)
    }

    public function check_pseudo($pla_pseudo,$mat_code){
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

    public function get_usr_role($username){
        return $this->db->query("select usr_role from t_user_usr where usr_pseudo = '".$username."';")->row();
    }

    public function get_pfl_info($username){
        return $this->db->query("select * from t_profil_pfl where usr_pseudo = '".$username."';")->row();
    }

    public function my_hash($mdp){
        $salt = "IhaveChosenYouAsmyLordAndSavior!!34682__Test";
        return hash('sha256', $salt . $mdp);
    }

    public function update_password($username,$password){
        $sql = 'update t_user_usr set usr_mdp = "'.$password.'" where usr_pseudo = "'.$username.'";';
        $query = $this->db->query($sql);
        return($query);
    }

    public function get_all_profil(){
        return $this->db->query("select * from t_profil_pfl;")->result_array();
    }

    public function get_quiz_match(){
        $sql = "select qui_name, qui_description, t_quiz_qui.usr_pseudo as auteurQuiz, mat_intitule, mat_debut, mat_fin, t_match_mat.usr_pseudo as auteurMatch, mat_code, mat_etat, mat_id from t_quiz_qui left outer join t_match_mat using(qui_id) where qui_etat = 'A';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //gets only valid quiz (with questions)
    public function get_quiz_name(){
        return $this->db->query("select distinct qui_name from t_quiz_qui join t_question_que using(qui_id) where t_quiz_qui.qui_id = t_question_que.qui_id and qui_etat = 'A';")->result_array();
    }

    public function get_good_ans($mat_id,$que_id){
        $sql = "select ans_id from t_answer_ans join t_question_que using(que_id) join t_quiz_qui using(qui_id) join t_match_mat using(qui_id) where mat_id = ".$mat_id." and que_id = ".$que_id." and ans_bonne = 'V';";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function get_queNb_mat($mat_id){
        return $this->db->query("select count(que_id) as nbQue from t_question_que join t_quiz_qui using(qui_id) join t_match_mat using(qui_id) where mat_id = ".$mat_id.";")->row();
    }

    //returns good answer knowing ans id
    public function check_ans($ans_id){
        return $this->db->query("select ans_bonne from t_answer_ans where ans_id = ".$ans_id.";")->row();
    }

    //declancher le trigger permettant d'efectuer une raz d'un match
    public function raz($mat_code){
        return $this->db->query("update t_match_mat set mat_debut = now(), mat_fin = NULL WHERE mat_code = '".$mat_code."';");
    }

    // can also be done with a function instead of a query
    public function activate_mat($mat_code){
        return $this->db->query("update t_match_mat set mat_etat = 'A' WHERE mat_code = '".$mat_code."';");
    }

    public function deactivate_mat($mat_code){
        return $this->db->query("update t_match_mat set mat_etat = 'D' WHERE mat_code = '".$mat_code."';");
    }

    public function delete_mat($mat_id){
        $tables = array('t_player_pla', 't_match_mat');
        $this->db->where('mat_id', $mat_id);
        $this->db->delete($tables);
    }

}