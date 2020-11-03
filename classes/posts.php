<?php 
include 'db.php';
class Posts extends DB{
    public function getPost($id){
        $post = array();
        $post = DB::query("SELECT * FROM tbl_posts where post_id = :id order by post_id desc", array(':id'=>$id));  
        return $post;
    }
}