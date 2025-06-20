<?php
    session_start();
include("databaseconnection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
    <header>
    </header>
    <main>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])  ?>" method="post">
            <h1>Log In</h1>
            <div class="inputlog">
                <label for="email"></label>
                <input type="email" name="Email" id="email" required placeholder="Email">
            </div>
            <div class="inputlog">
            <label for="password"></label>
            <input type="Password" name="Password" id="password" minlength="10" maxlength="20" required placeholder="Password">
            </div>
            <div class="rem">
                <div class="group"><input type="checkbox" name="rememberme" id="check"><label for="check">Remember Me</label></div>
             
             <a href="">Forgot Password</a>
            </div>
            <input type="submit" value="Log In">
              
        </form>
        <p>Or</p>
              <p>Register For An Account</p>
            <button>
              <a href="register.php">Register</a> 
            </button>
    </main>
    <footer>

    &copy; 2025 SCOB000 StudentPortal Assignment. All rights reserved.
    Developed by Boitumelo Mkhondo aka Kalashnikov | Contact: <a href="mailto:support@studentportal.edu">support@studentportal.edu</a>

  </footer>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
$email=$_POST["Email"];
$Password=$_POST["Password"];
$query="SELECT * FROM users Where email='$email'";
  $object=mysqli_query($connect,$query);
  
          if(mysqli_num_rows($object)>0){
                  $row=mysqli_fetch_assoc($object);
                     
                        if($email==$row["email"] && password_verify($Password, $row["password"])){
         $_SESSION["student_number"]=$row["student_number"];
         $_SESSION["name"]=$row["name"];
         $_SESSION["surname"]=$row["surname"];
         $_SESSION["contact_num"]=$row["contact_num"];
         $_SESSION["module_code"]=$row["module_code"];
         $_SESSION["email"]=$row["email"];
         $_SESSION["regdate"]=$row["registration_date"];
                        header("Location:profile.php");
                          exit();
                      }
                         else if($Password!=$row["password"]){
                              header("location:incorrect.php");
                                  exit();
                         }
          }
             else{
                 header("location:incorrect.php");
                       exit();
             }
    }
mysqli_close($connect);
?>