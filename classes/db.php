<?php 

class DB{
    private static function connect(){
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "db_lms";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    public static function query($query, $params = array()){ 
        $exploded = explode(' ', $query)[0]; 
        $conn = self::connect();
        $statement = $conn->prepare($query); 

        if($statement->execute($params)){
            if($exploded == 'SELECT' || $exploded == 'select'){
                $data = $statement->fetchAll();
                return $data;
            }
            return true;
        }else{
            return $conn->error;
        } 
    }

    // public static function query($query, $params = array()){
    //     $statement = self::connect()->prepare($query);
    //     try {
    //         if($statement->execute($params)){
    //             if(explode(' ', $query[0] == 'SELECT')){
    //                 $data = $statement->fetchAll();
    //                 return $data;
    //             }
    //             return true;
    //         }else{
    //             return false;
    //         }
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
        
    // }


}
// end class 
