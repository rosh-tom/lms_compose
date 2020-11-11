<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
  
   <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>


<?php 
    include 'classes/db.php';
    // $questions = DB::query("SELECT tbl_questions.quest_id, tbl_questions.question, tbl_questions.a, tbl_questions.b, tbl_questions.c, tbl_questions.d 
    // FROM tbl_questions where tbl_questions.q_id = :id and tbl_questions.quest_id != 2 limit 1", array(':id'=>9));
    $questions = DB::query("SELECT tbl_questions.quest_id, tbl_questions.question, tbl_questions.a, tbl_questions.b, tbl_questions.c, tbl_questions.d 
    FROM tbl_questions WHERE tbl_questions.quest_id NOT IN(SELECT quest_id FROM tbl_answer) and q_id = :id limit 1", array(':id'=>9));
   
$count =  count($questions);
echo $count ." Questions";
 
    // for($num = 1; $num <= $number_of_question; $num++){
    //     echo $num . " - ". $questions[$num-1]['question'] ."? <br>"; 
    // }

    if(isset($_POST['next'])){
        if(isset($_POST['answer'])){
            $data = [
                'answer'=> $_POST['answer'],
                'quest_id'=> $_POST['question_id'],
                'usr_id' => 1
            ];
            $correct_answer = "SELECT answer FROM tbl_questions where quest_id = :quest_id";
            $correct_answer = DB::query($correct_answer, array(':quest_id'=>$data['quest_id']));

            if($correct_answer[0]['answer'] == $data['answer']){
                $data['ans_correct'] =  1;
            }else{
                $data['ans_correct'] =  0;
            }


        //     $query = "INSERT INTO tbl_questionnaires(q_title, q_description, q_type, q_items, course_id) 
        // VALUES(:q_title, :q_description, :q_type, :q_items, :q_course_id)"; 
        // $result = DB::query($query, $data);

        //     $query = "INSERT INTO tbl_answer(ans_answer, quest_id, user_id)"
          DB::query("INSERT INTO tbl_answer(ans_answer, ans_correct, quest_id, usr_id) VALUES(:answer, :ans_correct, :quest_id, :usr_id)", $data);
          header("location: user_answering.php");
        }
        else{
            echo "Please Answer it.";
        }
       
    }

    if(isset($_POST['result'])){
        $result = "SELECT ans_correct FROM tbl_answer where ans_correct = :ans_correct and usr_id = :usr_id";
        $result = DB::query($result, array(':ans_correct'=> 1, 'usr_id'=> 1));
        $score = count($result);

        $result = "SELECT ans_correct FROM tbl_answer where usr_id = :usr_id";
        $result = DB::query($result, array('usr_id'=> 1));
        $items = count($result);


        echo "<br>YOUR SCORE IS ". $score ." / ". $items;

    }
     
?>
   <form action="user_answering.php" method="post">
        <?php 
         if($count){ 
        ?>
           
            <input type="hidden" name="question_id" value="<?= $questions[0]['quest_id'] ?>">

            <input type="radio"  name="answer" value="a">

            <label for="male">a. <?= $questions[0]['a'] ?></label><br>

            <input type="radio"   name="answer" value="b">
            <label for="female">b. <?= $questions[0]['a'] ?></label><br>

            <input type="radio"   name="answer" value="c">
            <label for="other">c. <?= $questions[0]['a'] ?> </label><br>
            
            <input type="radio"   name="answer" value="d">
            <label for="other">d. <?= $questions[0]['a'] ?></label><br>
            <input type="submit" value="NExt" name="next">
        <?php 
         }else{
            echo "THANK YOU FOR YOUR ANSWER!! ";
            echo "<input type='submit' value='See Result' name='result'>";
         }
        ?> 
    </form>