<?php session_start();       // Start the session ?>    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload files</title>
    <style>
    h1 {
  font-size: 20px;
  margin-top: 24px;
  margin-bottom: 24px;
}

img {
height: 60px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <!-- <form class="" action="data.php" method="post" autocomplete="off" enctype="multiport/form-data">
        <label for ="name">Name:</label>
        <input type="text" name="name" id="name" required value=""><br>
        <label for ="image">Image:</label>
        <input type="file" name="image" id="image" required accept=".jpg, .jpeg, .png" value=""><br>
        <button type="submit" name ="submit">Submit</button>
    </form>
    <br>
    <a href="data.php">Data</a> -->
    

   <div class="col-md-6 offset-md-3 mt-5">
       
        <form accept-charset="UTF-8" action="index.php" method="POST" enctype="multipart/form-data" >
          <div class="form-group">
            <label for="exampleInputName">Full Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name " required="required">
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlSelect1">File type</label>
            <select class="form-control" id="exampleFormControlSelect1" name="platform" required="required">
              <option value="Logo">Logo</option>
              <option value="Creative">Creative</option>
              <option value="Website">Website Design</option>
            </select>
          </div>
          <hr>
          <div class="form-group mt-3">
            <label class="mr-2">Upload your work:</label>
            <input type="file" name="uploadfile">
          </div>
          <hr>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
<?php
require 'connection.php';
if(isset( $_FILES["uploadfile"])){
$filename= $_FILES["uploadfile"]['name'];
$tempname= $_FILES["uploadfile"]['tmp_name'];
$name= $_POST["name"];
$folder ="img/".$filename;

echo $folder;
echo $_POST['platform'];
move_uploaded_file($tempname,$folder);
if( $_POST['platform']==='Creative')
$query="INSERT INTO upload VALUES(DEFAULT,'$name','$filename','')";
else if( $_POST['platform']==='Logo')
$query="INSERT INTO logo VALUES(DEFAULT,'$name','$filename','')";
else if( $_POST['platform']==='Website')
$query="INSERT INTO website VALUES(DEFAULT,'$name','$filename','')";
mysqli_query($conn,$query);
print_r($_FILES["uploadfile"]);}
?>
<?php
if (!isset($_SESSION['name'])) {         // condition Check: if session is not set. 
  header('location: https://localhost/msj-new-website/upload/authentication.php'); 
  exit();  // if not set the user is sendback to login page.
}
?>
<?php session_destroy(); ?>