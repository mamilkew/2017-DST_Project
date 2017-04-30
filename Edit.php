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

    <title>CLEAN EATING FOR HEALTHY LIFESTYLE : Personal Information</title>

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

        <?php
        include 'mysqli_connect.php';

        session_start();
        $id = $_SESSION['login_user'];
        ?>
    <div class="dashboard">
        <?php

        // Create a query for the database
        echo '<div align = "right">' .$id. '  <a class="btn btn-danger" href = "logout.php"> LOGOUT </a></div>';
        ?>
        <div class="jumbotron" , style="background: rgba(238,238,238, 0.8); margin-bottom: 0px; padding-bottom: 20px;">
            <div class="container">
                <h1>Personal Information</h1>
                <p>We'll never share your email with anyone else.</p>
                <p>Please fill up the following details</p>
            </div>
        </div>
        <div style="background-color: rgba(238, 238, 238, 0.4);">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <form action='Update.php' method="GET">
                            <div class="form-group">
                                <label for="age">Age :</label>
                                <input class="form-control" id="age" type="number" name="age" placeholder="Enter Age" required>
                            </div>
                            <fieldset class="form-group">
                                <legend>Gender :</legend>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="male" value="male" checked>
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="female" value="female">
                                        Female
                                    </label>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <label for="height">Height (cm)</label>
                                <input class="form-control" id="height" type="number" name="height" placeholder="Centimetres" required>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight (kg)</label>
                                <input class="form-control" id="weight" type="number" name="weight" placeholder="Kilograms" required>
                            </div>

                            <div class="form-group">
                                <label for="activity">Activity Level</label>
                                <select class="form-control" id="activity" name ="activity">
                                    <option value="1">No Activity</option>
                                    <option value="1.2">Low</option>
                                    <option value="1.375">Light</option>
                                    <option value="1.55">Moderate</option>
                                    <option value="1.725">Active</option>
                                    <option value="1.9">Extreme</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="preferences">Preferences</label>
                                <select class="form-control" id="preferences" name="preferences">
                                    <option>Veg</option>
                                    <option>Non-Veg</option>
                                   
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" >Calculate BMR</button> 
                            <<?php
        $query = "SELECT * FROM personal_info WHERE ID = '$id'";
// Get a response from the database by sending the connection
// and the query
        $response = @mysqli_query($db, $query);
// If the query executed properly proceed
        if ($response) {

            while ($row = mysqli_fetch_array($response)) {
                // echo '<script type="text/javascript">alert('.$row['Age'].');</script>';
                 echo '<script type="text/javascript"> document.getElementById("age").value='. $row['Age'] .';';
                if ($row['Gender'] == 'Female') {
                    echo 'document.getElementById("female").checked = true;';
                } else{
                    echo 'document.getElementById("male").checked = true;';
                }
                echo 'document.getElementById("height").value='. $row['Height'] .';';
                echo 'document.getElementById("weight").value='. $row['Weight'] .';';
                echo 'document.getElementById("activity").value="'. $row['Activity_Level'] .'";';
                echo 'document.getElementById("preferences").value="'. $row['Preferences'] .'";</script>';
            }
        }
        ?>
                           
   
                        </form>
                      
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
       
    </body>
    </html>
