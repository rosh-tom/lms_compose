<?php session_start();
    include 'classes/questionnaire.classes.php'; 

    $questionnaires = new Questionnaire();
    $results = $questionnaires->getQuestionnaire();
   

 ?> 

<link rel="stylesheet" href="styles/myStyle.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
  
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<a href="index.php"><=Back</a>
<br><br>
<div id="content"> 
    <span>{{ message }} From Vue.js</span>
    <?php 
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
    
    ?>
    <h1> Questionnaire <span><button @click="CreateQmodal()" >Create</button></span></h1> 
        
    <?php 
        foreach($results as $result){
            echo $result['q_title'] ." | ". $result['q_description'] ." | ". $result['q_type'] ." | ". $result['q_items'] ."<br>".
            "<a href='questions.php?questionnaire=".$result['q_id']."'>Questions</a><br><hr>";
            ; 
        }
    
    ?>
 
<!-- MODAL  -->
    <template v-if="Qmodal"> 
    <div class="modal"> 
    <!-- Modal content -->
    <div class="modal-content">
        <form action="controller/questionnaire.controller.php" method="post">
            <div class="modal-header">
            <span class="close" @click="CreateQmodal()">&times;</span>
                Create New Questionnaire
            </div>
            <div class="modal-body"><br>

            <!-- body  -->
                <input type="text" placeholder="TITLE" name="q_title">
                <br> 
                <textarea placeholder="Description" cols="30" rows="10" name="q_description"></textarea><br><br>
                  <br>
                <label for="">Type: </label>
                <select name="q_type">
                    <option value="Multiple Choice">Multiple Choice</option>
                    <option value="True or False">True or False</option> 
                    <option value="Enumaration">Enumaration</option> 
                    <option value="Explaination">Explaination</option> 
                </select>
                <br>
                <input type="number" min="0" placeholder="Number of items" name="q_items"> 
            <!-- /body  -->  
            </div> 
            <div class="modal-footer">
                <input type="submit" value="Save" name="btn_saveQuestionnaire">
            </div>
        </form>
        </div>  
    </div> 
</template>
<!-- /MODAL  -->


</div>
  

<!-- SCRIPTS  -->
<script>
    var app = new Vue({
        el: "#content",
        data: {
            message: 'HELLO WORLD',
            Qmodal: false,
            
        },
        methods: {
            CreateQmodal: function(){
                this.Qmodal = !this.Qmodal;
            } 
        }
    });


</script>

