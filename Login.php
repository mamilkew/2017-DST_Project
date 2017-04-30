<?php

include 'mysqli_connect.php';
session_start();
   
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
$myusername = mysqli_real_escape_string($db,$_POST['id']);

$mypassword = mysqli_real_escape_string($db,$_POST['pwd']); 


$query = "SELECT * FROM user_info where ID = '$myusername' and Password = '$mypassword'";

$response = @mysqli_query($db, $query);
if($response->num_rows > 0)
{

   while($row = mysqli_fetch_array($response))
   

{echo mysqli_error($db);

 $_SESSION['login_user'] = $myusername;
          $_SESSION['user_name'] = $row['Name'];
// echo "Welcome <b> ". $_SESSION['user_name'] . "</b><br>";

          header( "refresh:1; url=Dashboard.php" ); 


}

} else {

echo 'Invalid Username or Password. Please <a href = "login.html"> LOGIN </a> again.<br />';

echo mysqli_error($db);

}

}
 else{
echo mysqli_error($db);}
// Close connection to the database
mysqli_close($db);


?>
