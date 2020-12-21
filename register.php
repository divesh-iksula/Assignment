<!DOCTYPE html>
<html>
    <head>
      <link rel="stylesheet" href="../assignmentphp/register.css">
</head>
    <body>
    <button onclick="location.href='login.php'" id="log">login</button><br><br>
    <div>
        <form action="register.php"method="POST" class='modi' enctype= "multipart/form-data" autocomplete="off">
            First Name : <input type="text" name="firstname"/><br><br>
            Last Name : <input type="text" name="lastname"/><br><br>
            Email Id : <br><input type="email" name="email" required/><br><br>
            Contact No : <input type="text" maxlength="10" pattern="\d{10}" name="contact"><br><br>
            Age : <input type="number" name="age" min="18" max="60"/><br><br>
            Password : <input type="password" name="password123"/><br><br>
            Confirm Password : <input type="password" name="confirmpassword"/><br><br>
            Select image to upload<br>
            <input type="file"  name="fileToUpload" id="fileToUpload"><br><br>
            <input type="submit" name="submit" value="submit" id="subbutton">
            <br><br>

            
        </form>
        </div>
    </body>
</html>

<?php

$firstname = $lastname = $email = $contact = $age = $password = $confirmpassword = $Pimage = "" ;

$firstname = test_input($_POST["firstname"]);
$lastname = test_input($_POST["lastname"]);
$email = $_POST["email"];
$contact = $_POST["contact"];
$age = $_POST["age"];
$ode = $_POST["password123"];
$confirm = $_POST["confirmpassword"];


//----------------------------------connection
$servername = "localhost";
$username = "padmin";
$password = "Padmin123";
$database = "mini";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);
echo"sucessfully connected";
echo"<br>";
echo"<br>";
echo"<br>";
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//image

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);




//-------------------------------------data entry
$sql = "SELECT * FROM dataentry WHERE email ='$email';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<script>alert('Email Id Already Registered');</script> ";
  exit();
} else{
  if ($ode==$confirm){
  $sql = "INSERT INTO dataentry(firstname,lastname,email,contact,age,password123,confirmpassword,Pimage)
    VALUES ('$firstname','$lastname','$email','$contact','$age','$ode','$confirm','$target_file')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alret('$firstname. Your data stored successfully');</script>";
        echo"<br>";
      } else {
        echo "Something Went wrong";
        echo"<br>";
        echo"<br>";
      }
  }else{
    echo '<script>alert("Incorrect Password")</script>';
    echo"<br>";
    echo"<br>";
  }

}


  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  
?>
