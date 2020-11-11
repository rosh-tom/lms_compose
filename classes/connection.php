<?php 

class Connection {

    private static function connect(){
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "db_lms";
        
        $mysqli = new mysqli($servername, $username, $password, $dbname);
        return $mysqli;

    }

    public static function query($query, $types, $params=array()){
        $statement = self::connect()->prepare($query); 
                    $param  = "";

            for($i=0; $i < count($params); $i++) {
            $param =  $param. $params[$i] .",";
            }  
        $statement->bind_param($types, $param);

        if($statement->execute()){
            return true;
        } else{ 
            return $statement->error;
        }
          
    }

}

$data = array( 
     "q",
     "q",
     "q",
     10,
     1,
);
//  $params  = "";
// for($i=0; $i < count($data); $i++) {
//    $type =  $type. $data[$i] .",";
// } 
// echo $params;
$types = "sssss";
// $q_title = $_POST['q_title'];
// $q_description = $_POST['q_description'];
// $q_type = $_POST['q_type'];
// $q_items = $_POST['q_items'];
// $q_course_id = '1';

$query = "INSERT INTO tbl_questionnaires(q_title, q_description, q_type, q_items, course_id) 
VALUES(?, ?, ?, ?, ?)"; 
$result = Connection::query($query, $types, $data);