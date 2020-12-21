<?php
session_start();
// -----------------------  Create connection
$servername = "localhost";
$username = "padmin";
$password = "Padmin123";
$database = "mini";
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<html>
    <body>
        <div class="user">
        <?php
echo "Hello.....";
echo $_SESSION[ "userEmail"];
$abc = $_SESSION["userEmail"];
$sql="SELECT Pimage FROM dataentry where firstname='$abc'";
$data=mysqli_query($conn,$sql);
$result=mysqli_fetch_assoc($data);
echo "<img src='".$result['Pimage']."' height='100' width='100'>";



echo"<br>";
echo"<br>";
echo"<br>";
?>
</div>
<?php


$sql_display="SELECT firstname,lastname,email,contact,age,Pimage FROM dataentry";
$data=mysqli_query($conn,$sql_display);
$count=mysqli_num_rows($data);

?>

<html>
<body>
<link rel="stylesheet" href="../assignmentphp/register.css">

  
<button onclick="location.href='register.php'" id="logout">Log out</button>
<h1>Registered users</h1>
<table>
    <tr>
        <th>Image</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>EmailID</th>
        <th>ContactNumber</th>
    </tr>

    <?php
        while($result1=mysqli_fetch_assoc($data)){
            echo "<tr>
            <td ><img src='".$result1['Pimage']."' height='100' width='100'</td>
                    <td >".$result1['firstname']."</td>
                    <td>".$result1['lastname']."</td>
                    <td >".$result1['email']."</td>
                    <td>".$result1['contact']."</td>
                </tr>";
        }
    
    ?>
   
</table>

</body>
</html>