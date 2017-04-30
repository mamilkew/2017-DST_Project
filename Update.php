<?php
include 'mysqli_connect.php';
session_start();
//header( "refresh:0; url=Refresh.php" ); 
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

  if($gender=='male'){ 
    $result = (10 * $weight + 6.25 * $height - 5 * $age + 5 )*$activity;
 }
 else {
   $result = (10 * $weight + 6.25 * $height - 5 * $age - 161 )*$activity;
 }

 $query = "UPDATE personal_info SET Age = '$age',Gender='$gender',Height= '$height',Weight= '$weight',Activity_Level= '$activity', Preferences= '$preferences',Current_BMR= '$result' WHERE ID = '$id'";
 $response = @mysqli_query($db, $query);
 if($response){
   
   $query1 = "SELECT * FROM personal_info WHERE ID = '$id'";
   $response1 = @mysqli_query($db, $query1);
   if ($response1){
     while($row = mysqli_fetch_array($response1)){ 
      $bmr = $row['Current_BMR'] ;
      $_SESSION['bmr'] = $bmr;
      header( "refresh:0; url=Dashboard.php" ); 
    
    }
   
  }
  else {
    echo "Failed.";
    echo mysqli_error($db);
  }
}
else{
  echo " at line 42";
  echo mysqli_error($db);
}
}
else{
  echo "at line 47";
  echo mysqli_error($db);
}

// Close connection to the database
mysqli_close($db);

?>