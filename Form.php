<?php
include 'mysqli_connect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "GET") 
{
  $age = mysqli_real_escape_string($db,$_GET['age']); 
  $gender = mysqli_real_escape_string($db,$_GET['gender']);
  $height = mysqli_real_escape_string($db,$_GET['height']); 
  $weight = mysqli_real_escape_string($db,$_GET['weight']); 
  $activity = mysqli_real_escape_string($db,$_GET['activity']); 
  $preferences = mysqli_real_escape_string($db,$_GET['preferences']);
  $id = $_SESSION['login_user'];
  $name = $_SESSION['user_name'];

  $_SESSION['preferences'] = $preferences;

  if($gender=='male'){ 
    $result = 10 * $weight + 6.25 * $height - 5 * $age + 5 * $activity;
 }
 else {
   $result = 10 * $weight + 6.25 * $height - 5 * $age - 161 * $activity;
 }
 $_SESSION['bmr'] = $result;
$bmi = ($weight*100*100)/($height*$height);
 $query = "INSERT into personal_info(ID,Name,Age,Gender,Height,Weight,Activity_Level, Preferences,BMI,Current_BMR) values ('$id','$name','$age','$gender','$height','$weight','$activity','$preferences','$bmi','$result')";
 $response = @mysqli_query($db, $query);

     header( "refresh:0; url=Dashboard.php" ); 
    }
  
  

else{
  echo "at line 47";
  echo mysqli_error($db);
}

// Close connection to the database
mysqli_close($db);

?>