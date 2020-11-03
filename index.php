<head>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <style>
        a:hover, button:hover{
            cursor: pointer;
        } 
        
form{
    margin: 0px;
}
input[submit]:hover{
    cursor: pointer;
}

/* The Modal (background) */
.modal { 
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 16px 12px;
  background-color: gray;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 16px 12px;
    background-color: gray;
    color: white;
}
    </style>
</head>
<?php 
    include 'classes/db.php';
    $id = "1";

    $posts = DB::query("SELECT post_id, title, description, type FROM tbl_posts where teacher_id = :id order by post_id desc", array(':id'=>$id)); 

    $logged_name = DB::query("SELECT firstname, lastname FROM tbl_teachers where teacher_id = :id", array(':id'=>$id));
    $logged_firstname = $logged_name[0]['firstname'];
    $logged_lastname = $logged_name[0]['lastname']; 

    if(isset($_POST['btn_post'])){
        $title = $_POST['title']; 
        $description = $_POST['description'];
        $file_name = $_FILES['file_post']['name']; 
        if ($_FILES['file_post']['name'] == "") {
            $type = null;
            $location = null;
            $filename = null;
        }else{
            $type = $_FILES['file_post']['type']; 
            $type = explode('/', $type);
            $type = $type[0];

            $target = "Uploads/".basename($_FILES['file_post']['name']); 
            move_uploaded_file($_FILES['file_post']['tmp_name'], $target);  
              
        }   

        $query = "INSERT INTO tbl_posts(title, description, filename, type, location, teacher_id) VALUES(
            :title, :description, :filename, :type, :location, :teacher_id
        )";
        DB::query($query, array(':title'=>$title, ':description'=>$description, ':filename'=>$file_name, ':type'=>$type,':location'=>$target, ':teacher_id'=>$id));
        header("location: index.php");
    }
?>
<div id="index">
    <h1>
        Welcome <?= $logged_firstname ." ". $logged_lastname?> 
    </h1>

    <h3> {{ message }} from VUE</h3>

    <button @click="changeModal()">Compose</button>
    <a href="questionaire.php"><button> Questionaires</button></a>
    <button>Compose</button>
    <button>Compose</button>
    <a href="">Questionaires</a>
    <a href="">Course Chat</a>
    <a href="">Messages</a>
    <br><br>

    <?php 
        foreach ($posts as $post) {
            echo "<b>". $post['title'] ."</b><br>";
            echo "&ensp;". $post['description'] . "<br>";
            echo '&ensp;'. $post['type'] ."<br>";
            echo "<a href='show.php?post=". $post['post_id'] ."'> View </a><br><hr>";
        }
    ?>


        <!-- modal  -->
 
<!-- The Modal -->
<template v-if="showModal"> 
    <div class="modal"> 
    <!-- Modal content -->
    <div class="modal-content">
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
            <span class="close" @click="changeModal()">&times;</span>
                Modal Header
            </div>
            <div class="modal-body"><br>
                <input type="text" placeholder="Title" name="title"><br>
                <br> 
                <textarea placeholder="Text Ares.." cols="30" rows="10" name="description"></textarea><br><br>
                <input type="file" name="file_post" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf, video/*, image/*, application/zip,application/rar" >
            </div>
            <div class="modal-footer">
                <input type="submit" value="Save" name="btn_post">
            </div>
        </form>
        </div> 
    </div> 
</template>
<!-- end modal  -->

</div>

<script>
    var app = new Vue({
        el: '#index',
        data: {
            message:  'Hello World',
            showModal: false
        },
        methods :{
            changeModal: function(){
                this.showModal = !this.showModal;
            }
        }
    });

</script>