<?php 
    include 'classes/db.php';

Class Questionnaire{
    public function getQuestionnaire(){
        $results = array();
        $query = "SELECT * FROM tbl_questionnaires where course_id = :id order by q_id desc";
        $results = DB::query($query, array(':id'=>1));
        return $results;
    }
    public function getOneQuestionnaire($id){
        $results = array();
        $query = "SELECT * FROM tbl_questionnaires where q_id = :id";
        $results = DB::query($query, array(':id'=>$id));
        return $results;
    }
}
