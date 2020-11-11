<?php session_start();
    include '../classes/db.php';
    
    if(isset($_POST['btn_saveQuestions'])){
        $data = [
            'question' => $_POST['question'],
            'a' => $_POST['a'],
            'b' => $_POST['b'],
            'c' => $_POST['c'],
            'd' => $_POST['d'],
            'answer' => $_POST['answer'], 
            'question_id' => $_POST['question_id'],
            'teacher_id'=>'1', 
            'course_id'=>'1' 
        ];

        $query = "INSERT INTO tbl_questions(question, a, b, c, d, answer, q_id, teacher_id, course_id) values (
            :question, :a, :b, :c, :d, :answer, :question_id, :teacher_id, :course_id
        )"; 
        $result = DB::query($query, $data);
         
         if($result){
            $_SESSION['message'] = "New Data Inserted";
         }else{
             $_SESSION['error'] = 'ERROR';
         }
        header("location: ../questions.php?questionnaire=".$_POST['question_id']);
    }
    
?> 

