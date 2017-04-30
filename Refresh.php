<?php
include 'mysqli_connect.php';
session_start();
$id = $_SESSION['login_user'];
$query1 = "Delete from sunday where ID = '$id' ";
$query2 = "Delete from monday where ID = '$id' ";
$query3 = "Delete from tuesday where ID = '$id' ";
$query4 = "Delete from wednesday where ID = '$id' ";
$query5 = "Delete from thursday where ID = '$id' ";
$query6 = "Delete from friday where ID = '$id' ";
$query7 = "Delete from saturday where ID = '$id' ";

$r1 = mysqli_query($db,$query1);
$r2 = mysqli_query($db,$query2);
$r3 = mysqli_query($db,$query3);
$r4 = mysqli_query($db,$query4);
$r5 = mysqli_query($db,$query5);
$r6 = mysqli_query($db,$query6);
$r7 = mysqli_query($db,$query7);

if($r1 && $r2 && $r3 && $r4 && $r5 && $r6 && $r7 )
{
	
	header( "refresh:0; url=foodset.php" ); 
}
else{
	echo mysqli_error($db);
}
?>