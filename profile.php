<?php
session_start();
include("databaseconnection.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
    rel="stylesheet">
    <link rel="stylesheet" href="CSS/profile.css">
</head>
  
<body>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $imagename=$_FILES['image']['name'];
    $tempLocation=$_FILES['image']['tmp_name'];
   $email=$_SESSION["email"];
   $queryimage = "UPDATE users SET profileimage = '$imagename' WHERE email ='$email'";
               
               $runner=mysqli_query($connect,$queryimage);
              
            if($runner){
               move_uploaded_file( $_FILES["image"]["tmp_name"], "images/". $imagename);
                  header("Location:profile.php");
                  exit("DONE");
               $_SESSION['status']="Image Saved Successfully";
            }
                else{
                      echo "not saved";
                  $_SESSION['status']="Image Not Saved";
                }
    }

  //DISPLAYING IMAGE
  
   $email = $_SESSION["email"];
       $queryimageselector="SELECT* FROM users WHERE email= '$email'";
         $object= mysqli_query($connect,$queryimageselector);
    if(mysqli_num_rows($object)>0){
        $row=mysqli_fetch_assoc($object);
          $pic=$row['profileimage'];
         
        
    }
      else{
        echo "FAIL";
      }
  
 


?>
      <header>
             <h1 class="wlcome"> UDUB Student Portal </h1>
              <h1 class="logout
              "> <a href="home.php"><i class="material-icons logout">logout</i> Log Out</a></h1>
             
      </header>
      <main>
<fieldset >
    <img src="<?php echo "images/".$row['profileimage']; ?>" height="200" width="200"> 
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

 
        <label for="profile" id="edit">EDIT IMAGE</label>
        <input type="file" name="image" id="profile" required >
        <input type="submit" name="submit" id="submit" value="Save">
    </form>
</fieldset>
    
       
      

    <?php
    if (isset($_SESSION['status'])) {
        echo "<p>" . $_SESSION['status'] . "</p>";
        unset($_SESSION['status']);
    }
    ?>
       <section class="details">
<H1 class="infohead">   Student Information</H1>
   <aside class="info">
    <div class="log">Name: </div>
    <p class="det"> <?php echo $_SESSION["name"]; ?></p>
   </aside>
   <aside class="info">
    <div class="log">Surname:</div>
    <p class="det"><?php echo $_SESSION["surname"]; ?></p>
   </aside>
   <aside class="info">
    <div class="log"> Cellphone Number: </div>
    <p class="det"><?php echo $_SESSION["contact_num"]; ?></p>
   </aside>
   <aside class="info">
    <div class="log">Module Code:</div>
    <p class="det"><?php echo $_SESSION["module_code"]; ?></p>
   </aside>
   <aside class="info">
    <div class="log">Student Number:</div>
    <p class="det"><?php echo $_SESSION["student_number"]; ?></p>
   </aside>
   <aside class="info">
    <div class="log">Email:</div>
    <p class="det"><?php echo $_SESSION["email"]; ?></p>
   </aside>
   <aside class="info">
    <div class="log">Date Registered:</div>
    <p class="det"><?php echo $_SESSION["regdate"]?></p>
   </aside>
   
       </section>
      
    
</main>
     <footer>

    &copy; 2025 SCOB000 StudentPortal Assignment. All rights reserved.
    Developed by Boitumelo Mkhondo aka Kalashnikov | Contact: <a href="mailto:support@studentportal.edu">support@studentportal.edu</a>

  </footer>
</body>

</html>


