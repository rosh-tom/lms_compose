<?php  
  include 'classes/posts.php';

  $post = new Posts();
  $result = $post->getPost($_GET['post']); 

?>
<a href="index.php"><= Back</a>
<br><br>

<h1><?= $result[0]['title'] ?></h1>
<p><?= $result[0]['description'] ?></p>

<?php if($result[0]['type'] == "video"){ ?>
    <video width="50%" height="50%"  controls>
            <source src="<?= $result[0]['location'] ?>" type="video/mp4">
    </video>
    <br><br> 
    <a href="<?= $result[0]['location'] ?>"><button>Download</button></a>
    <br><br>
<?php } ?> 

<?php if($result[0]['type'] == "application"){ ?> 
    <img src="assets/document.png" alt="" width="20px"> 
    <a href="<?= $result[0]['location'] ?>"><button>Download</button></a>
    <br><br>
<?php } ?> 
 
comments
<br>
<div style="width: 50%"> 
        <input type="text" style="width: 90%">
        <input type="submit"> 
        <br> <br>
        <div style="border: 1px solid gray; padding:10px;"> 
            <div>
            Tom: dfsfsdfsd 
            </div>
        </div>
</div>

