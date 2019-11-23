<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    echo
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
  $db = mysqli_connect('localhost', 'root', '', 'registration');
?>


<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>

   

  <div class="topnav">

        <?php  if (isset($_SESSION['username'])) : ?>
          <?php endif ?>
    		<h1>User : <strong><?php echo $_SESSION['username']; ?></strong></h1>
    		<p> <a href="index.php?logout='1'" >logout</a> </p>
      

	</div>


  <!-- ---------------------------------------------------------------- -->
<div class="content">
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
    <?php endif ?>
</div>

    <!-- logged in user information -->


	<!--------------------------------------->

<!-- ---------------------------------------------------------------------------------------------------------------images -->
<div class="main-body">

<div class="main-title">
	  <h2>IEEE UVCE</h2>
</div>


 <div class="image">
  <div class="title"><h1>Images</h1></div> 
    <?php
      $sql="SELECT * FROM tbl_uploads WHERE type= 'image/jpeg' or type= 'image/png' ";
      $result_set=mysqli_query($db,$sql);
      while($row=mysqli_fetch_array($result_set))
      {
        ?>
         <a href="uploads/<?php echo $row['file'] ?>" target="_blank"><?php echo "<img src = 'uploads/".$row['file']."  '/>" ?></a>
   
         <?php
      }
      ?>
  </div>
    
<!-- --------------------------------------------------------------------------------------------------------------------vedios -->
<div class="vedio">
  <div class="title"><h1>Vedios</h1></div>
  <?php
    $sql="SELECT * FROM tbl_uploads WHERE  type='video/mp4' ";
    $result_set=mysqli_query($db,$sql);
 
   while($row=mysqli_fetch_array($result_set))
  {
    ?>
    
    <video width="300" height="200" controls>
    <source src="uploads/<?php echo $row['file'] ?>" type="video/mp4" >
    </video>
    
		
   <?php
  }
  ?>
</div>

<!-- -----------------------------------------------------------------------------------------------------documents -->
<div class="application">
  <div class="title"><h1>Documents</h1></div>
    <?php
      $sql="SELECT * FROM tbl_uploads WHERE type= 'application' ";
      $result_set=mysqli_query($db,$sql);
      while($row=mysqli_fetch_array($result_set))
      {
        ?>
         <iframe src="uploads/<?php echo $row['file'] ?>" style="width: 300px;height:400px;border: none;"></iframe><br>
        <Button href="uploads/<?php echo $row['file'] ?>" target="_blank">View Document</Button>
		
        <?php
      }   
      ?>
</div>
    
  	
</div>
		

</body>
</html>






















































