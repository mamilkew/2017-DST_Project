<?php
include 'mysqli_connect.php';

/*if($_SERVER["REQUEST_METHOD"] == "GET") 
{*/
  /*$bmr = mysqli_real_escape_string($db,$_GET['current_BMR']); 
  $Preferrences = mysqli_real_escape_string($db,$_GET['Preferrences']);
  
  $Food_time = mysqli_real_escape_string($db,$_GET['Food_time']);
*/
 //
session_start();
$id = $_SESSION['login_user'];
 echo '<div align = "right">' .$id. '  <a class="btn btn-danger" href = "logout.php"> LOGOUT </a></div>';
$Preferrences=$_SESSION['user_pref'];
 // 
   $bmr=$_SESSION['user_bmr'];

   $result  = $bmr/3;
   $result_max = $result+50;
    $result_min = $result-50;
$lunch ="select a.Name as Item1,b.Name as Item2,a.Calories+b.Calories as Total_calories from intl_food a , intl_food b where (a.calories+b.calories<'$result_max' AND a.calories+b.calories>$result_min)AND a.Food_time='l'AND b.Food_time='l'AND a.Preferences='$Preferrences' AND b.Preferences='$Preferrences' ORDER BY RAND() LIMIT 1";

$break_fast ="select a.Name as Item1,b.Name as Item2,a.Calories+b.Calories as Total_calories from intl_food a , intl_food b where (a.Calories+b.Calories<'$result_max' AND a.Calories+b.Calories>'$result_min')AND a.Food_time='b' AND b.Food_time='b'AND a.Preferences='$Preferrences' AND b.Preferences='$Preferrences' ORDER BY RAND() LIMIT 1";


$dinner ="select a.Name as Item1,b.Name as Item2,a.Calories+b.Calories as Total_calories from intl_food a , intl_food b where (a.Calories+b.Calories<'$result_max' AND a.Calories+b.Calories>'$result_min')AND a.Food_time='d'AND b.Food_time='d'AND a.Preferences='$Preferrences' AND b.Preferences='$Preferrences' ORDER BY RAND() LIMIT 1";


echo mysqli_error($db);
?>
    
<!DOCTYPE html>
<html>
<head>
  <title>Food Set</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <script href="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="table">
      <table>
        <tr>
        <th>Week/Food Time</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
        <th>Saturday</th>
        <th>Sunday</th>
        </tr>
        <tr>
        <td><h4>Break Fast</h4></td>
        <td><?php $b = @mysqli_query($db, $break_fast); echo mysqli_error($db); while($row_b=mysqli_fetch_array($b)) echo $row_b['Item1'].','.$row_b['Item2'].'<br> ' ?></td>
        <td><?php $b = @mysqli_query($db, $break_fast); while($row_b=mysqli_fetch_array($b)) echo $row_b['Item1'].','.$row_b['Item2'].'<br> ' ?></td>
        <td><?php $b = @mysqli_query($db, $break_fast); while($row_b=mysqli_fetch_array($b)) echo $row_b['Item1'].','.$row_b['Item2'].'<br>' ?></td>
        <td><?php $b = @mysqli_query($db, $break_fast); while($row_b=mysqli_fetch_array($b)) echo $row_b['Item1'].','.$row_b['Item2'].'<br>' ?></td>
        <td><?php $b = @mysqli_query($db, $break_fast); while($row_b=mysqli_fetch_array($b)) echo $row_b['Item1'].','.$row_b['Item2'].'<br>' ?></td>
        <td><?php $b = @mysqli_query($db, $break_fast); while($row_b=mysqli_fetch_array($b)) echo $row_b['Item1'].','.$row_b['Item2'].'<br>' ?></td>
        <td><?php $b = @mysqli_query($db, $break_fast); while($row_b=mysqli_fetch_array($b)) echo $row_b['Item1'].','.$row_b['Item2'].'<br>' ?></td>
        
        </tr>

        <tr>
        <td><h4>Lunch</h4></td>
        
        <td><?php $l = @mysqli_query($db, $lunch); while($row_l=mysqli_fetch_array($l)) echo $row_l['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $l = @mysqli_query($db, $lunch); while($row_l=mysqli_fetch_array($l)) echo $row_l['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $l = @mysqli_query($db, $lunch); while($row_l=mysqli_fetch_array($l)) echo $row_l['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $l = @mysqli_query($db, $lunch); while($row_l=mysqli_fetch_array($l)) echo $row_l['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $l = @mysqli_query($db, $lunch); while($row_l=mysqli_fetch_array($l)) echo $row_l['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $l = @mysqli_query($db, $lunch); while($row_l=mysqli_fetch_array($l)) echo $row_l['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $l = @mysqli_query($db, $lunch); while($row_l=mysqli_fetch_array($l)) echo $row_l['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        
        </tr>

        <tr>
        <td><h4>Dinner</h4></td>
        <td><?php $d = @mysqli_query($db, $dinner); while($row_d=mysqli_fetch_array($d)) echo $row_d['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $d = @mysqli_query($db, $dinner); while($row_d=mysqli_fetch_array($d)) echo $row_d['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $d = @mysqli_query($db, $dinner); while($row_d=mysqli_fetch_array($d)) echo $row_d['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $d = @mysqli_query($db, $dinner); while($row_d=mysqli_fetch_array($d)) echo $row_d['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $d = @mysqli_query($db, $dinner); while($row_d=mysqli_fetch_array($d)) echo $row_d['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $d = @mysqli_query($db, $dinner); while($row_d=mysqli_fetch_array($d)) echo $row_d['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        <td><?php $d = @mysqli_query($db, $dinner); while($row_d=mysqli_fetch_array($d)) echo $row_d['Item1'].','.$row_l['Item2'].'<br>' ?></td>
        
        </tr>
      </table>
    </div>
  </div>
</div>
</body>
</html>';   
!----------------------------Bhargav's Code is here as below-------------------------->
<div style="background-color: rgba(238, 238, 238, 0.5);">
    <?php

    /*if($_SERVER["REQUEST_METHOD"] == "GET")
    {*/
    /*$bmr = mysqli_real_escape_string($db,$_GET['current_BMR']);
    $Preferrences = mysqli_real_escape_string($db,$_GET['Preferrences']);

    $Food_time = mysqli_real_escape_string($db,$_GET['Food_time']);
    */
    //
    $Preferrences = $_SESSION['user_pref'];
    //
    $bmr = $_SESSION['user_bmr'];

    $result = $bmr / 3;
    $result_max = $result + 100;
    $result_min = $result - 100;
    $lunch = "select distinct a.Name as Item1,b.Name as Item2,a.Fat+b.Fat AS Tot_Fat,a.Calories+b.Calories as Total_Calories from intl_food a , intl_food b where (a.calories+b.calories<'$result_max' AND a.calories+b.calories>'$result_min')AND a.Food_time='l'AND b.Food_time='l'AND a.Preferences='$Preferrences' AND b.Preferences='$Preferrences' AND a.Fat+b.Fat BETWEEN ((a.Calories+b.Calories)*0.2)/9 AND ((a.Calories+b.Calories)*0.3)/9 ORDER BY RAND() LIMIT 2";

    $break_fast = "select distinct a.Name as Item1,b.Name as Item2,a.Fat+b.Fat AS Tot_Fat,a.Calories+b.Calories as Total_Calories from intl_food a , intl_food b where (a.calories+b.calories<'$result_max' AND a.calories+b.calories>'$result_min')AND a.Food_time='b'AND b.Food_time='b'AND a.Preferences='$Preferrences' AND b.Preferences='$Preferrences' AND a.Fat+b.Fat BETWEEN ((a.Calories+b.Calories)*0.2)/9 AND ((a.Calories+b.Calories)*0.3)/9 ORDER BY RAND() LIMIT 2";


    $dinner = "select distinct a.Name as Item1,b.Name as Item2,a.Fat+b.Fat AS Tot_Fat,a.Calories+b.Calories as Total_Calories from intl_food a , intl_food b where (a.calories+b.calories<'$result_max' AND a.calories+b.calories>'$result_min')AND a.Food_time='d'AND b.Food_time='d'AND a.Preferences='$Preferrences' AND b.Preferences='$Preferrences' AND a.Fat+b.Fat BETWEEN ((a.Calories+b.Calories)*0.2)/9 AND ((a.Calories+b.Calories)*0.3)/9 ORDER BY RAND() LIMIT 2";



    ?>

    <div class="container" >
        <div class="row">
            <div class="table">
                <table>
                    <tr>
                        <th>Week/Food Time</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                    </tr>
                    <tr>
                        <td><h4>Break Fast</h4></td>
                        <td><?php $b = @mysqli_query($db, $break_fast);
                            while ($row_b = mysqli_fetch_array($b)) echo $row_b['Item1'] . '<br>' . $row_b['Item2'] . '<br> ' ?></td>
                        <td><?php $b = @mysqli_query($db, $break_fast);
                            while ($row_b = mysqli_fetch_array($b)) echo $row_b['Item1'] . '<br>' . $row_b['Item2'] . '<br> ' ?></td>
                        <td><?php $b = @mysqli_query($db, $break_fast);
                            while ($row_b = mysqli_fetch_array($b)) echo $row_b['Item1'] . '<br>' . $row_b['Item2'] . '<br>' ?></td>
                        <td><?php $b = @mysqli_query($db, $break_fast);
                            while ($row_b = mysqli_fetch_array($b)) echo $row_b['Item1'] . '<br>' . $row_b['Item2'] . '<br>' ?></td>
                        <td><?php $b = @mysqli_query($db, $break_fast);
                            while ($row_b = mysqli_fetch_array($b)) echo $row_b['Item1'] . '<br>' . $row_b['Item2'] . '<br>' ?></td>
                        <td><?php $b = @mysqli_query($db, $break_fast);
                            while ($row_b = mysqli_fetch_array($b)) echo $row_b['Item1'] . '<br>' . $row_b['Item2'] . '<br>' ?></td>
                        <td><?php $b = @mysqli_query($db, $break_fast);
                            while ($row_b = mysqli_fetch_array($b)) echo $row_b['Item1'] . '<br>' . $row_b['Item2'] . '<br>' ?></td>

                    </tr>

                    <tr>
                        <td><h4>Lunch</h4></td>

                        <td><?php $l = @mysqli_query($db, $lunch);
                            while ($row_l = mysqli_fetch_array($l)) echo $row_l['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $l = @mysqli_query($db, $lunch);
                            while ($row_l = mysqli_fetch_array($l)) echo $row_l['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $l = @mysqli_query($db, $lunch);
                            while ($row_l = mysqli_fetch_array($l)) echo $row_l['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $l = @mysqli_query($db, $lunch);
                            while ($row_l = mysqli_fetch_array($l)) echo $row_l['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $l = @mysqli_query($db, $lunch);
                            while ($row_l = mysqli_fetch_array($l)) echo $row_l['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $l = @mysqli_query($db, $lunch);
                            while ($row_l = mysqli_fetch_array($l)) echo $row_l['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $l = @mysqli_query($db, $lunch);
                            while ($row_l = mysqli_fetch_array($l)) echo $row_l['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>

                    </tr>

                    <tr>
                        <td><h4>Dinner</h4></td>
                        <td><?php $d = @mysqli_query($db, $dinner);
                            while ($row_d = mysqli_fetch_array($d)) echo $row_d['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $d = @mysqli_query($db, $dinner);
                            while ($row_d = mysqli_fetch_array($d)) echo $row_d['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $d = @mysqli_query($db, $dinner);
                            while ($row_d = mysqli_fetch_array($d)) echo $row_d['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $d = @mysqli_query($db, $dinner);
                            while ($row_d = mysqli_fetch_array($d)) echo $row_d['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $d = @mysqli_query($db, $dinner);
                            while ($row_d = mysqli_fetch_array($d)) echo $row_d['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $d = @mysqli_query($db, $dinner);
                            while ($row_d = mysqli_fetch_array($d)) echo $row_d['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>
                        <td><?php $d = @mysqli_query($db, $dinner);
                            while ($row_d = mysqli_fetch_array($d)) echo $row_d['Item1'] . '<br>' . $row_l['Item2'] . '<br>' ?></td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


























