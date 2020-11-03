<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<a href="index.php"><=Back</a>
<br><br>
<div id="content"> 
    <select v-model="questionaire">
        <option value="mul">Multiple Choice</option>
        <option value="enu">Enumeration</option>
        <option value="tof">True of False</option>
        <option value="exp">Explaination</option>
    </select>
    <input type="submit" @click="show()" value="Make"> 
    <br><br>
    <template v-if="questionType == 'mul'">  
        <div style="width: 50%">

        <button @click="questionType=null" style="float: right">X</button>
        <textarea rows="5" style="width: 100%"></textarea>

        </div>

    </template>

    <template v-if="questionType == 'enu'">
        {{questionType}}
        <button @click="questionType=null">X</button>
    </template>
    <template v-if="questionType == 'tof'">
        {{questionType}}
        <button @click="questionType=null">X</button>
    </template>
    <template v-if="questionType == 'exp'">
        {{questionType}}
        <button @click="questionType=null">X</button>
    </template>


</div>
 


<!-- SCRIPTS  -->
<script>
    var app = new Vue({
        el: "#content",
        data: {
            message: 'HELLO WORLD',
            questionType: null, 
            questionaire: ''
        },
        methods: {
            show: function(){ 
                this.questionType = this.questionaire;
            }
        }
    });


</script>

