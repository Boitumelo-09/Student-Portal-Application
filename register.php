<?php
    session_start();
include("databaseconnection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     <link rel="stylesheet" href="CSS/register.css">
</head>
<body>
    <header>

    </header>
    <main>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
          <h1>Register</h1>
           <section class="input">
            <label for="student_number"></label>
               <input type="text" name="Studentnum" id="student_number" maxlength="9" minlength="9" required placeholder="Student Number">
        </section>
           <section class="input">
            <label for="Name"></label>
                <input type="text" name="Name" id="Name" required placeholder="Name">
        </section>
           <section class="input">
            <label for="Surname"></label>
            <input type="text" name="Surname" id="Surname" required placeholder="Surname">
        </section>
           <section class="input">
            <label for="contact"></label>
            <input type="text" name="Contact" id="" maxlength="10" minlength="10" inputmode="numeric" required placeholder="Contact Number"> 
        </section>
           <section class="input">
            <label for="module_code"></label>
            <input type="text" name="Module_Code" id="module_code" maxlength="7" minlength="7" required placeholder="Module Code">
        </section>
           <section class="input">
            <label for="email"></label>
            <input type="email" name="Email" id="email" required placeholder="Email">
        </section>
           <section class="input">
            <label for="password"></label><input type="password" name="Password" id="password" minlength="10" maxlength="20" required placeholder="Password">
        </section>
        </section>
           <section class="input">
            <label for="Cpassword"></label><input type="password" name="Cpassword" id="Cpassword" minlength="10" maxlength="20" required placeholder="Confirm Password">
        </section>
              <input type="submit" value="Register" name="submit">
              
    </form>
   <p>Or</p>
              <p>Log In To Your Account</p>
            <button>
              <a href="login.php">Log In</a> 
            </button>
           
    </main>
    <footer>

    &copy; 2025 SCOB000 StudentPortal Assignment. All rights reserved.
    Developed by Boitumelo Mkhondo aka Kalashnikov | Contact: <a href="mailto:support@studentportal.edu">support@studentportal.edu</a>

  </footer>
</body>
</html>

<?php
       if ($_SERVER["REQUEST_METHOD"]=="POST") {
  
$student_number=filter_input(INPUT_POST,$_POST["Studentnum"] ,FILTER_SANITIZE_SPECIAL_CHARS);
 $name=$_POST["Name"];
 $surname=$_POST["Surname"];
 $contact=$_POST["Contact"];
 $modulecode=$_POST["Module_Code"];
 $email=$_POST["Email"];
 $password=password_hash($_POST["Password"], PASSWORD_DEFAULT);
 $confirmpassword=$_POST["Cpassword"];
 $name = filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_SPECIAL_CHARS);
 $surname = filter_input(INPUT_POST, 'Surname', FILTER_SANITIZE_SPECIAL_CHARS);
 $contact = filter_input(INPUT_POST, 'Contact', FILTER_SANITIZE_NUMBER_INT);
 $modulecode = filter_input(INPUT_POST, 'Module_Code', FILTER_SANITIZE_SPECIAL_CHARS);
$query="INSERT INTO users (student_number,name,surname,contact_num,module_code,email,password) 
VALUES('$student_number','$name','$surname','$contact','$modulecode','$email','$password')";


              
                 if(password_verify($confirmpassword,$password)){
                      if(mysqli_query($connect,$query)){
                         header("Location:login.php");
                      }
                        else{
                            header("location:incorrect.php");
                        }

                
                 }
                   else{
                    header("location:incorrect.php");
                   }
         
       }
    mysqli_close($connect);
?>