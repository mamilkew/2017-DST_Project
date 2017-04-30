<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../favicon.ico"> -->

    <title>CLEAN EATING FOR HEALTHY LIFESTYLE : Healthy Food Plan</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/foodset.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="dashboard">
    <?php
    include 'mysqli_connect.php';
    session_start();
    $id = $_SESSION['login_user'];
    // Create a query for the database
    $Preferrences = $_SESSION['user_pref'];
    $bmr = $_SESSION['user_bmr'];

    $result = $bmr / 3;
    $query = "select Gender from personal_info where ID = '$id'";
    $res = mysqli_query($db, $query);
     $result_min = $result -150;
        $result_max = $result+50  ;
        $lunch =array();
        $break_fast = array();
        $dinner = array();
    // if ($result) {
    //     while ($row = mysqli_fetch_array($res)) {
    //         if ($row['Gender'] = 'Male') {
    //             $result_min = 1800;
    //         } else {
    //             $result_min = 1200;
    //         }
    //     }
    // }
    // $result_max = $result + 200;
    // $lunch = array();
    // $break_fast = array();
    // $dinner = array();
    //$sql = 'SELECT Name,Calories,Fat FROM breakfast GROUP BY rand() HAVING Fat BETWEEN (Calories*0.2)/9 AND (Calories*0.3)/9 AND SUM(Calories) <1200 LIMIT 4';
    //$b = $mysqli_query($db,$sql);
    //if($b){echo "Hello"};
    //else { mysqli_error($db);}
    for ($i = 0; $i < 7; $i++) {

        $lunch[$i] = "select distinct a.Name as Item1,b.Name as Item2,a.Fat+b.Fat AS Tot_Fat,a.Calories+b.Calories as Total_Calories from intl_food_dataset a , intl_food_dataset b where (a.calories+b.calories<'$result_max' AND a.calories+b.calories>='$result_min')AND a.Preferences='$Preferrences' OR b.Preferences='$Preferrences' AND a.Fat+b.Fat BETWEEN ((a.Calories+b.Calories)*0.2)/9 AND ((a.Calories+b.Calories)*0.3)/9 ORDER BY RAND() LIMIT 1";

        $break_fast[$i] = "select distinct a.Name as Item1,b.Name as Item2,a.Fat+b.Fat AS Tot_Fat,a.Calories+b.Calories as Total_Calories from intl_food_dataset a , intl_food_dataset b where (a.calories+b.calories<'$result_max' AND a.calories+b.calories>='$result_min')AND a.Preferences='$Preferrences' OR b.Preferences='$Preferrences' AND a.Fat+b.Fat BETWEEN ((a.Calories+b.Calories)*0.2)/9 AND ((a.Calories+b.Calories)*0.3)/9 ORDER BY RAND() LIMIT 1";


        $dinner[$i] = "select distinct a.Name as Item1,b.Name as Item2,a.Fat+b.Fat AS Tot_Fat,a.Calories+b.Calories as Total_Calories from intl_food_dataset a , intl_food_dataset b where (a.calories+b.calories<'$result_max' AND a.calories+b.calories>='$result_min')AND a.Preferences='$Preferrences' OR b.Preferences='$Preferrences' AND a.Fat+b.Fat BETWEEN ((a.Calories+b.Calories)*0.2)/9 AND ((a.Calories+b.Calories)*0.3)/9 ORDER BY RAND() LIMIT 1";


    }

    echo '<div align = "right">' . $id . '<a class="btn btn-danger" href = "logout.php" > LOGOUT </a></div>';
    echo '
        <div class="jumbotron" , style="background: rgba(238,238,238, 0.8); margin-bottom: 0px;">
            <div class="container">
                <h1>Healthy Meal!!</h1>
            </div>
        </div>
        <div style="background-color: rgba(238, 238, 238, 0.5);">
            <div class="container">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="3"><h4>Meal Time</h4></th>
                                </tr>
                                <tr>
                                    <th><h4>Week</h4></th>
                                    <th><h4>Breakfast</h4></th>
                                    <th><h4>Lunch</h4></th>
                                    <th><h4>Dinner</h4></th>
                                    <th><h4>Total Calories</h4></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Sunday</th>

                                    <td>';

    $query = "select * from sunday where ID = '$id'";
    $result = @mysqli_query($db, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {

            echo $row['BItem1'] . ',' . $row['BItem2'] . '<br>';
            echo '</td>

                                               <td>';
            echo $row['LItem1'] . ',' . $row['LItem2'] . '<br>';
            echo '</td>
                                               <td>';
            echo $row['DItem1'] . ',' . $row['DItem2'] . '<br>';
            echo '</td>';
            echo '<td>' . $row['Total_Calories'] . '</td>';

        }
    } else {

        $b = @mysqli_query($db, $break_fast[0]);
        while ($row_b = mysqli_fetch_array($b)) {
            $total_b = $row_b['Total_Calories'];
            $bitem1 = $row_b['Item1'];
            $bitem2 = $row_b['Item2'];
            echo $bitem1 . ',' . $bitem2 . '<br>';
        }
        echo '</td>
                                       
                                       <td>';
        $l = @mysqli_query($db, $lunch[0]);
        while ($row_l = mysqli_fetch_array($l)) {
            $total_l = $row_l['Total_Calories'];
            $litem1 = $row_l['Item1'];
            $litem2 = $row_l['Item2'];
            echo $litem1 . ',' . $litem2 . '<br>';
        }
        echo '</td>
                                       <td>';
        $d = @mysqli_query($db, $dinner[0]);
        while ($row_d = mysqli_fetch_array($d)) {
            $total_d = $row_d['Total_Calories'];
            $ditem1 = $row_d['Item1'];
            $ditem2 = $row_d['Item2'];
            echo $ditem1 . ',' . $ditem2 . '<br>';
        }
        echo '</td>';
        $total = $total_b + $total_l + $total_d;
        $sql = "insert into Sunday(ID,BItem1,BItem2,LItem1,LItem2,DItem1,DItem2,Total_Calories) values ('$id','$bitem1','$bitem2','$litem1','$litem2','$ditem1','$ditem2','$total')";
        $res = @mysqli_query($db, $sql);


        echo '<td>' . $total . '</td>';
    }
    echo '</tr>
            <tr>
                <th scope="row">Monday</th>
                    <td>';
    $query = "select * from monday where ID = '$id'";
    $result = @mysqli_query($db, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {

            echo $row['BItem1'] . ',' . $row['BItem2'] . '<br>';
            echo '</td>

                                                   <td>';
            echo $row['LItem1'] . ',' . $row['LItem2'] . '<br>';
            echo '</td>
                                                   <td>';
            echo $row['DItem1'] . ',' . $row['DItem2'] . '<br>';
            echo '</td>';
            echo '<td>' . $row['Total_Calories'] . '</td>';

        }
    } else {
        $b = @mysqli_query($db, $break_fast[1]);
        while ($row_b = mysqli_fetch_array($b)) {
            $total_b = $row_b['Total_Calories'];
            $bitem1 = $row_b['Item1'];
            $bitem2 = $row_b['Item2'];
            echo $bitem1 . ',' . $bitem2 . '<br>';
        }
        echo '</td>
                                             <td>';
        $l = @mysqli_query($db, $lunch[1]);
        while ($row_l = mysqli_fetch_array($l)) {
            $total_l = $row_l['Total_Calories'];
            $litem1 = $row_l['Item1'];
            $litem2 = $row_l['Item2'];
            echo $litem1 . ',' . $litem2 . '<br>';
        }
        echo '</td>
                                             <td>';
        $d = @mysqli_query($db, $dinner[1]);
        while ($row_d = mysqli_fetch_array($d)) {
            $total_d = $row_d['Total_Calories'];
            $ditem1 = $row_d['Item1'];
            $ditem2 = $row_d['Item2'];
            echo $ditem1 . ',' . $ditem2 . '<br>';
        }
        echo '</td>';
        $total = $total_b + $total_l + $total_d;
        $sql = "insert into Monday(ID,BItem1,BItem2,LItem1,LItem2,DItem1,DItem2,Total_Calories) values ('$id','$bitem1','$bitem2','$litem1','$litem2','$ditem1','$ditem2','$total')";
        $res = @mysqli_query($db, $sql);


        echo '<td>' . $total . '</td>';
    }
    echo ' </tr>
            <tr>
                <th scope="row">Tuesday</th>
                    <td>';
    $query = "select * from tuesday where ID = '$id'";
    $result = @mysqli_query($db, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {

            echo $row['BItem1'] . ',' . $row['BItem2'] . '<br>';
            echo '</td>

                                                           <td>';
            echo $row['LItem1'] . ',' . $row['LItem2'] . '<br>';
            echo '</td>
                                                           <td>';
            echo $row['DItem1'] . ',' . $row['DItem2'] . '<br>';
            echo '</td>';
            echo '<td>' . $row['Total_Calories'] . '</td>';

        }
    } else {
        $b = @mysqli_query($db, $break_fast[2]);
        while ($row_b = mysqli_fetch_array($b)) {
            $total_b = $row_b['Total_Calories'];
            $bitem1 = $row_b['Item1'];
            $bitem2 = $row_b['Item2'];
            echo $bitem1 . ',' . $bitem2 . '<br>';
        }
        echo '</td>
                                                     <td>';
        $l = @mysqli_query($db, $lunch[2]);
        while ($row_l = mysqli_fetch_array($l)) {
            $total_l = $row_l['Total_Calories'];
            $litem1 = $row_l['Item1'];
            $litem2 = $row_l['Item2'];
            echo $litem1 . ',' . $litem2 . '<br>';
        }
        echo '</td>
                                                     <td>';
        $d = @mysqli_query($db, $dinner[2]);
        while ($row_d = mysqli_fetch_array($d)) {
            $total_d = $row_d['Total_Calories'];
            $ditem1 = $row_d['Item1'];
            $ditem2 = $row_d['Item2'];
            echo $ditem1 . ',' . $ditem2 . '<br>';
        }
        echo '</td>';
        $total = $total_b + $total_l + $total_d;
        $sql = "insert into Monday(ID,BItem1,BItem2,LItem1,LItem2,DItem1,DItem2,Total_Calories) values ('$id','$bitem1','$bitem2','$litem1','$litem2','$ditem1','$ditem2','$total')";
        $res = @mysqli_query($db, $sql);


        echo '<td>' . $total . '</td>';
    }
    echo ' </tr>
            <tr>
                <th scope="row">Wednesday</th>
                    <td>';
    $query = "select * from wednesday where ID = '$id'";
    $result = @mysqli_query($db, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {

            echo $row['BItem1'] . ',' . $row['BItem2'] . '<br>';
            echo '</td>

                                                                   <td>';
            echo $row['LItem1'] . ',' . $row['LItem2'] . '<br>';
            echo '</td>
                                                                   <td>';
            echo $row['DItem1'] . ',' . $row['DItem2'] . '<br>';
            echo '</td>';
            echo '<td>' . $row['Total_Calories'] . '</td>';

        }
    } else {
        $b = @mysqli_query($db, $break_fast[3]);
        while ($row_b = mysqli_fetch_array($b)) {
            $total_b = $row_b['Total_Calories'];
            $bitem1 = $row_b['Item1'];
            $bitem2 = $row_b['Item2'];
            echo $bitem1 . ',' . $bitem2 . '<br>';
        }
        echo '</td>
                                                             <td>';
        $l = @mysqli_query($db, $lunch[3]);
        while ($row_l = mysqli_fetch_array($l)) {
            $total_l = $row_l['Total_Calories'];
            $litem1 = $row_l['Item1'];
            $litem2 = $row_l['Item2'];
            echo $litem1 . ',' . $litem2 . '<br>';
        }
        echo '</td>
                                                             <td>';
        $d = @mysqli_query($db, $dinner[3]);
        while ($row_d = mysqli_fetch_array($d)) {
            $total_d = $row_d['Total_Calories'];
            $ditem1 = $row_d['Item1'];
            $ditem2 = $row_d['Item2'];
            echo $ditem1 . ',' . $ditem2 . '<br>';
        }
        echo '</td>';
        $total = $total_b + $total_l + $total_d;
        $sql = "insert into Wednesday(ID,BItem1,BItem2,LItem1,LItem2,DItem1,DItem2,Total_Calories) values ('$id','$bitem1','$bitem2','$litem1','$litem2','$ditem1','$ditem2','$total')";
        $res = @mysqli_query($db, $sql);


        echo '<td>' . $total . '</td>';
    }
    echo ' </tr>
            <tr>
                <th scope="row">Thursday</th>
                    <td>';
    $query = "select * from thursday where ID = '$id'";
    $result = @mysqli_query($db, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {

            echo $row['BItem1'] . ',' . $row['BItem2'] . '<br>';
            echo '</td>

                                                                           <td>';
            echo $row['LItem1'] . ',' . $row['LItem2'] . '<br>';
            echo '</td>
                                                                           <td>';
            echo $row['DItem1'] . ',' . $row['DItem2'] . '<br>';
            echo '</td>';
            echo '<td>' . $row['Total_Calories'] . '</td>';

        }
    } else {
        $b = @mysqli_query($db, $break_fast[4]);
        while ($row_b = mysqli_fetch_array($b)) {
            $total_b = $row_b['Total_Calories'];
            $bitem1 = $row_b['Item1'];
            $bitem2 = $row_b['Item2'];
            echo $bitem1 . ',' . $bitem2 . '<br>';
        }
        echo '</td>
                                                                    <td>';
        $l = @mysqli_query($db, $lunch[4]);
        while ($row_l = mysqli_fetch_array($l)) {
            $total_l = $row_l['Total_Calories'];
            $litem1 = $row_l['Item1'];
            $litem2 = $row_l['Item2'];
            echo $litem1 . ',' . $litem2 . '<br>';
        }
        echo '</td>
                                                                    <td>';
        $d = @mysqli_query($db, $dinner[4]);
        while ($row_d = mysqli_fetch_array($d)) {
            $total_d = $row_d['Total_Calories'];
            $ditem1 = $row_d['Item1'];
            $ditem2 = $row_d['Item2'];
            echo $ditem1 . ',' . $ditem2 . '<br>';
        }
        echo '</td>';
        $total = $total_b + $total_l + $total_d;
        $sql = "insert into Thursday(ID,BItem1,BItem2,LItem1,LItem2,DItem1,DItem2,Total_Calories) values ('$id','$bitem1','$bitem2','$litem1','$litem2','$ditem1','$ditem2','$total')";
        $res = @mysqli_query($db, $sql);


        echo '<td>' . $total . '</td>';
    }
    echo ' </tr>
            <tr>
                <th scope="row">Friday</th>
                    <td>';
    $query = "select * from friday where ID = '$id'";
    $result = @mysqli_query($db, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {

            echo $row['BItem1'] . ',' . $row['BItem2'] . '<br>';
            echo '</td>

                                                                                   <td>';
            echo $row['LItem1'] . ',' . $row['LItem2'] . '<br>';
            echo '</td>
                                                                                   <td>';
            echo $row['DItem1'] . ',' . $row['DItem2'] . '<br>';
            echo '</td>';
            echo '<td>' . $row['Total_Calories'] . '</td>';

        }
    } else {
        $b = @mysqli_query($db, $break_fast[5]);
        while ($row_b = mysqli_fetch_array($b)) {
            $total_b = $row_b['Total_Calories'];
            $bitem1 = $row_b['Item1'];
            $bitem2 = $row_b['Item2'];
            echo $bitem1 . ',' . $bitem2 . '<br>';
        }
        echo '</td>
                                                                             <td>';
        $l = @mysqli_query($db, $lunch[5]);
        while ($row_l = mysqli_fetch_array($l)) {
            $total_l = $row_l['Total_Calories'];
            $litem1 = $row_l['Item1'];
            $litem2 = $row_l['Item2'];
            echo $litem1 . ',' . $litem2 . '<br>';
        }
        echo '</td>
                                                                             <td>';
        $d = @mysqli_query($db, $dinner[5]);
        while ($row_d = mysqli_fetch_array($d)) {
            $total_d = $row_d['Total_Calories'];
            $ditem1 = $row_d['Item1'];
            $ditem2 = $row_d['Item2'];
            echo $ditem1 . ',' . $ditem2 . '<br>';
        }
        echo '</td>';
        $total = $total_b + $total_l + $total_d;
        $sql = "insert into Friday(ID,BItem1,BItem2,LItem1,LItem2,DItem1,DItem2,Total_Calories) values ('$id','$bitem1','$bitem2','$litem1','$litem2','$ditem1','$ditem2','$total')";
        $res = @mysqli_query($db, $sql);


        echo '<td>' . $total . '</td>';
    }
    echo ' </tr>
            <tr>
                <th scope="row">Saturday</th>
                    <td>';
    $query = "select * from saturday where ID = '$id'";
    $result = @mysqli_query($db, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {

            echo $row['BItem1'] . ',' . $row['BItem2'] . '<br>';
            echo '</td>

                                                                                           <td>';
            echo $row['LItem1'] . ',' . $row['LItem2'] . '<br>';
            echo '</td>
                                                                                           <td>';
            echo $row['DItem1'] . ',' . $row['DItem2'] . '<br>';
            echo '</td>';
            echo '<td>' . $row['Total_Calories'] . '</td>';

        }
    } else {
        $b = @mysqli_query($db, $break_fast[6]);
        while ($row_b = mysqli_fetch_array($b)) {
            $total_b = $row_b['Total_Calories'];
            $bitem1 = $row_b['Item1'];
            $bitem2 = $row_b['Item2'];
            echo $bitem1 . ',' . $bitem2 . '<br>';
        }
        echo '</td>
                                                                                     <td>';
        $l = @mysqli_query($db, $lunch[6]);
        while ($row_l = mysqli_fetch_array($l)) {
            $total_l = $row_l['Total_Calories'];
            $litem1 = $row_l['Item1'];
            $litem2 = $row_l['Item2'];
            echo $litem1 . ',' . $litem2 . '<br>';
        }
        echo '</td>
                                                                                     <td>';
        $d = @mysqli_query($db, $dinner[6]);
        while ($row_d = mysqli_fetch_array($d)) {
            $total_d = $row_d['Total_Calories'];
            $ditem1 = $row_d['Item1'];
            $ditem2 = $row_d['Item2'];
            echo $ditem1 . ',' . $ditem2 . '<br>';
        }
        echo '</td>';
        $total = $total_b + $total_l + $total_d;
        $sql = "insert into Saturday(ID,BItem1,BItem2,LItem1,LItem2,DItem1,DItem2,Total_Calories) values ('$id','$bitem1','$bitem2','$litem1','$litem2','$ditem1','$ditem2','$total')";
        $res = @mysqli_query($db, $sql);


        echo '<td>' . $total . '</td>';
    }
    echo ' </tr>
        </tbody>
    </table> ';
    ?>

    <div align="center"><a class="btn btn-primary" href="Refresh.php"> Get a different MENU! </a> <a class="btn btn-primary" href="dashboard.php"> Go Back </a></div>
    <br>
    <div><h3>How to eat Healthy!!</h3>
        <p>Make half your plate fruits and vegetables.</p>
        <br>
        <p style="word-break: break-word">
            <b>Eating:</b> We provide "Ideal Daily Fat Intake" : 20-30% of your total calorie intake.
        <p>A low-carbohydrate diet minimizes sugars and starches, replacing them with foods rich in protein and healthy fats.</p>
        </p>
        <br>
        <p style="word-wrap: break-word">
            <b>Drinking: </b> Drink water instead of sugary drinks
        <p>You should drink water throughout the day and especially around workouts. No reason to drink a whole ton though, thirst is a pretty reliable indicator of your need<p>
        </p>
    </div>

</div>
<div class="col-sm-1"></div>
</div>
</div>
</div>
</div>
</body>
</html>
