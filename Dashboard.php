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

    <title>CLEAN EATING FOR HEALTHY LIFESTYLE : Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">

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
            echo '<div align = "right">' .$id. '  <a class="btn btn-danger" href = "logout.php"> LOGOUT </a></div>';
            ?>
            <div class="jumbotron", style="background: rgba(238,238,238, 0.8); margin-bottom: 0px;">
                <div class="container">
                    <h1>Personal Information</h1>
                </div>
            </div>
            <div style="background-color: rgba(238, 238, 238, 0.5);">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3"> </div>
                        <div class="col-sm-6">
                           <table class="table">

                            <?php
                            $query = "SELECT * FROM personal_info WHERE ID = '$id'";
// Get a response from the database by sending the connection
                            
// and the query
                            $response = @mysqli_query($db, $query);
// If the query executed properly proceed
                            if ($response) {



                                while ($row = mysqli_fetch_array($response)) {
                                        $pref = $row['Preferences'] ;
                                          $_SESSION['user_pref'] = $pref; 
                                          $bmr = $row['Current_BMR'];
                                          $_SESSION['user_bmr'] = $bmr;
                                          //echo $_SESSION['user_pref']. '  '. $_SESSION['user_bmr'];
                                         
                                    switch( $row['Activity_Level'] ){
                                        case 1:
                                        $activity = "No Activity";
                                        break;
                                        case 1.2:
                                        $activity = "Low";
                                        break;
                                        case 1.375:
                                        $activity = "Light";
                                        break;
                                        case 1.55:
                                        $activity = "Moderate";
                                        break;
                                        case 1.725:
                                        $activity = "Active";
                                        break;
                                        case 1.9:
                                        $activity = "Extreme";
                                        break;


                                    }
                                    if($row['BMI'] < 18.5){ $bmi_result = 'Underweight';}
                                    elseif ($row['BMI'] >= 18.5 AND $row['BMI'] < 24.9 ) {
                                        $bmi_result = 'Healthy Weight';
                                    } elseif ($row['BMI'] > 25 AND $row['BMI'] < 29.9 ) {
                                        $bmi_result = 'Overweight';
                                    } elseif ($row['BMI'] > 30 AND $row['BMI'] < 34.9 ) {
                                        $bmi_result = 'Obese';
                                    } elseif ($row['BMI'] >= 35 AND $row['BMI'] < 39.9 ) {
                                        $bmi_result = 'Severely Obese';
                                    } elseif ($row['BMI'] >= 40 ) {
                                        $bmi_result = 'Morbidly Obese';
                                    }

                                    echo'<tr>       
                                    <td align="center"> NAME: </td>
                                    <td > ' . $row['Name'] . '</td></tr>
                                    <tr><td align="center"> Age: </td>
                                        <td >' . $row['Age'] . '</td></tr>
                                        <tr><td align="center"> Gender: </td>
                                            <td >' . $row['Gender'] . '</td></tr>
                                            <tr><td align="center"> Height: </td>
                                                <td >' . $row['Height'] . '</td></tr>
                                                <tr><td align="center"> Weight: </td>
                                                    <td >' . $row['Weight'] . '</td></tr>
                                                    <tr><td align="center"> Activity_Level: </td>
                                                        <td >' . $activity . '</td></tr>
                                                        <tr><td align="center"> Preferences: </td>
                                                            <td >' . $row['Preferences'] . '</td></tr>
                                                            <tr><td align="center"> Your BMI: </td>
                                                                <td >' . $row['BMI'] . '('.$bmi_result.')</td></tr>
                                                                <tr><td align="center"><h4> Calories Need per day(including activity): </h4></td>
                                                                    <td ><h4>' . $row['Current_BMR'] . '</h4></td></tr> ';

                                                            }
                                                            
  
                                                           
                                                            echo '</table>';
                                                            
                                                           // echo ' '.$_SESSION['user_pref'] . '   '. $_SESSION['user_bmr'] ;
                                                            echo '<div style="text-align: center"><a class="btn btn-primary" href = "Edit.php"> Update Profile </a> 
                                                                    <a class="btn btn-primary" href = "foodset.php">  Get your Menu!!!   </a> </div>';

                                                        } else {

                                                            echo "Couldn't issue database query<br />";

                                                            echo mysqli_error($db);

                                                        }

// Close connection to the database
                                                        mysqli_close($db);

                                                        ?>
                                                    </div>
                                                    <div class="col-sm-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </body>
                                </html>