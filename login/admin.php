<?php 
  session_start(); 


  $db = mysqli_connect('localhost', 'root', '', 'registration');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>


<div class="content">
  	<!-- notification message -->
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

	  
<div class="topnav">
<?php  if (isset($_SESSION['username'])) : ?>
  <?php endif ?>
    <h1>User : <strong><?php echo $_SESSION['username']; ?></strong></h1>
    <p> <a href="index.php?logout='1'" >logout</a> </p>
</div>



<div class="upload">
 <form action="upload.php" method="post" enctype="multipart/form-data">
 <input type="file" name="file" />
 <button type="submit" name="btn-upload">upload</button>
 </form>
    <br /><br />
    <?php
 if(isset($_GET['success']))
 {
  ?>
        <label>File Uploaded Successfully...  <a href="view.php">click here to view file.</a></label>
        <?php
 }
 else if(isset($_GET['fail']))
 {
  ?>
        <label>Problem While File Uploading !</label>
        <?php
 }
?>
</div>


<div class="admin-body">
 <table width="80%" border="1">
    <tr>
    <th></th>
    </tr>
    <tr>
    <td>image </td>
    <td>File Size(KB)</td>
    <td>File Type</td>
    </tr>
    <?php
 $sql="SELECT * FROM tbl_uploads WHERE type= 'image/jpeg' or type= 'image/png'";
 $result_set=mysqli_query($db,$sql);
 while($row=mysqli_fetch_array($result_set))
 {
  ?>
        <form action="upload.php" method="post">
        <tr>
        <td class="size"><?php echo "<img src = 'uploads/".$row['file']."  '/>" ?></td>
        <td><?php echo $row['size'] ?></td>
        <td><?php echo $row['type'] ?></td>
        <input type="hidden" name ="file" value="<?php echo $row['file'] ?>">
        <td><button type="submit" class="button" name="delete_item" >Delete</button></td>
       </tr>
        </form>
        <?php
        
        
 }
 $sql="SELECT * FROM tbl_uploads WHERE type= 'application'";
 $result_set=mysqli_query($db,$sql);
 while($row=mysqli_fetch_array($result_set))
 {
  ?>
        <form action="upload.php" method="post">
        <tr>
        <td class="size"><iframe src="uploads/<?php echo $row['file'] ?>" style="width: 300px;height:400px;border: none;"></iframe><br></td>
        <td><?php echo $row['size'] ?></td>
        <td><?php echo $row['type'] ?></td>
            <input type="hidden" name ="file" value="<?php echo $row['file'] ?>">
        <td><button type="submit" class="button" name="delete_item" href="delete_item">Delete</button></td>
        </tr>
        </form>
        <?php
        
        
 }
 $sql="SELECT * FROM tbl_uploads WHERE type='video/mp4' ";
 $result_set=mysqli_query($db,$sql);
 while($row=mysqli_fetch_array($result_set))
 {
  ?>
        <form action="upload.php" method="post">
        <tr>
        <td class="size"><video width="300" height="200" controls>
    <source src="uploads/<?php echo $row['file'] ?>" type="video/mp4" >
    </video></td>
        <td><?php echo $row['size'] ?></td>
        <td><?php echo $row['type'] ?></td>
                <input type="hidden" name ="file" value="<?php echo $row['file'] ?>">
            <td><button type="submit" class="button" name="delete_item" href="delete_item">Delete</button></td>
            
        </tr>
        </form>
        <?php
        
        
 }
 ?>
    </table>
</div>
</body>
</html>