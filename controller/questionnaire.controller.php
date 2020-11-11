<?php session_start();
    include '../classes/db.php';

    if (isset($_POST['btn_saveQuestionnaire'])) {
        $data = array(
            'q_title' => $_POST['q_title'],
            'q_description' => $_POST['q_description'],
            'q_type' => $_POST['q_type'],
            'q_items' => $_POST['q_items'],
            'q_course_id' => 1 
        );
      
        $query = "INSERT INTO tbl_questionnaires(q_title, q_description, q_type, q_items, course_id) 
        VALUES(:q_title, :q_description, :q_type, :q_items, :q_course_id)"; 
        $result = DB::query($query, $data);
         
         if($result){
            $_SESSION['message'] = "New Data Inserted";
         }else{
             $_SESSION['error'] = 'ERROR';
         }
         
         header("location: ../questionnaire.php");
    }


 