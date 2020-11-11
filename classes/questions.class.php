<?php 

include 'db.php';

class Questions{
    public $result = array();

    public function addQuestions($params = array()){ 
         $query = "INSERT INTO tbl_questions(question, a, b, c, d, answer, q_id, teacher_id, course_id) values (
             ?, ?, ?, ?, ?, ?, ?, ?, ?
         )";
         $result = DB::query($query, $params);
 
        if($result){
            return true;
        }else{
            return false;
        } 
    }
    public function get_questions(){
        $query = "SELECT * FROM tbl_questions where q_id = :q_id, and teacher_id = :teacher_id, and course_id = :course_id";
        $this->results = DB::query($query, array(':q_id'=>'', ':teacher_id'=>'1', ':course_id'=>'1')); 
    }

     
}

