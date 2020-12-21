<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../assignmentphp/register.css">
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"method="POST" id="loginform" class="namo">
            Enter Email ID <br> <input type="email" name="email1"/><br><br>
            Password <br> <input type="password" name="password1"/><br><br>
            <input type="submit" id="subbutton"/>
            <br><br>
        </form>
    </body>
</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

$email = $_POST['email1'];
$password = $_POST['password1'];


//login query

$sql = "SELECT * FROM dataentry WHERE email='".$email."' AND password123='".$password."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {   
        $_SESSION["userEmail"] = $row['firstname'];
        echo "<script>window.location.href='main.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No User Found Please Enter Valid Email and Password');</script> ";
    exit();
}

$conn->close();

}
?>