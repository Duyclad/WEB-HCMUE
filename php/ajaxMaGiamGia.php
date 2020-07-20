<?php 
session_start();
 

include("DB.php");
            mysqli_query($connect,"SET NAMES 'utf8'");

    $Code = $_GET['Code'];
    $query = mysqli_query($connect,"SELECT * FROM `magiamgia` where Code = '$Code'");

    if($query->num_rows > 0 ){
        $row = mysqli_fetch_array($query);
        echo $row['Giamgia'];
    }
    else{
        echo "NOT";
    }
?>