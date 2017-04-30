<?php
include 'mysqli_connect.php';
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") 
{
  $name = mysqli_real_escape_string($db,$_POST['name']); 
  $username = mysqli_real_escape_string($db,$_POST['id']);
  $password = mysqli_real_escape_string($db,$_POST['pwd']); 
  $email = mysqli_real_escape_string($db,$_POST['email']); 
  

    //See Whether is user is already exists..
  $validate = "SELECT * FROM user_info where Email = '$email'";
  $result_sel = @mysqli_query($db, $validate);
  if(!$result_sel)
  {
   echo "User Already Exists.Please <a href = 'login.html'> LOGIN </a> !";

   echo mysqli_error($db);
   
 } else {
     //include 'first_time.php';
   $query = "INSERT INTO user_info (Name,ID,Password,Email) VALUES ('$name','$username','$password','$email')";
   $response = @mysqli_query($db, $query);
   if($response){
    
     $_SESSION['login_user'] = $username;
     $_SESSION['user_name'] = $name;

 
     header( "refresh:0; url=Form.html" ); 
   } else { echo mysqli_error($db);}
 }


}
else{
  echo mysqli_error($db);
}


// Close connection to the database
mysqli_close($db);

?>