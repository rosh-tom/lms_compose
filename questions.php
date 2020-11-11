<?php session_start(); ?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
   -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<link rel="stylesheet" href="styles/myStyle.css">

<?php 
    include 'classes/questionnaire.classes.php';
    
    $id =  $_GET['questionnaire'];

    $questionnaire = new Questionnaire();
    $result = $questionnaire->getOneQuestionnaire($id);
   
    echo $result[0]['q_title'];
    echo $result[0]['q_type'];

    $questions = DB::query("SELECT * FROM tbl_questions WHERE q_id = :id ORDER BY created_at DESC", array(':id' => $id));



?>
<a href="questionnaire.php"><=Back</a>
<div id="questions">
    {{ message }}
    <h1>Question List <span><button @click="CreateQmodal()">Create Question</button></span></h1>
    
    <?php 
    
         if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        echo "<br>";
        $num = count($questions)+1;
        foreach($questions as $question){
            $num--;
            echo $num . " - ".$question['question'] ."<br>";
        }
        
    ?>

 

<!-- /#questions   -->
<?php if($result[0]['q_type'] == "Multiple Choice"){ ?>
<!-- MODAL  -->
<template v-if="Qmodal"> 
    <div class="modal"> 
    <!-- Modal content -->
    <div class="modal-content">
        <form action="controller/question.controller.php" method="post">
            <input type="hidden" value="<?=$id?>" name="question_id"/>
            <div class="modal-header">
            <span class="close" @click="CreateQmodal()">&times;</span>
                Create New Questionnaire
            </div>
            <div class="modal-body"><br> 
            <!-- body  --> 
                <textarea placeholder="Question." cols="30" rows="10" name="question"></textarea><br><br>
                  <br>
                  <label for="">A: </label><input type="text" name="a">
                <br>
                <label for="">B: </label><input type="text" name="b">
                <br>
                <label for="">C: </label><input type="text" name="c">
                <br>
                <label for="">D: </label><input type="text" name="d">
                <br>
                  <br>
                <label for="">Answer: </label>
                <select name="answer">
                    <option value="a">A.</option>
                    <option value="b">B.</option> 
                    <option value="c">C.</option> 
                    <option value="d">D.</option> 
                </select>
                <br> 
            <!-- /body  -->  
                

            </div> 
            <div class="modal-footer">
                <input type="submit" value="Save" name="btn_saveQuestions">
            </div>
        </form>
        </div>  
    </div> 
</template>
<!-- /MODAL  -->
<?php } ?>
 




</div>
<script>
    var app = new Vue({
        el: "#questions",
        data: {
            message: 'Message from Vue.js',
            Qmodal: false
            
        },
        methods: {
            CreateQmodal: function(){
                this.Qmodal = !this.Qmodal;
            } 
        }
    });

</script>