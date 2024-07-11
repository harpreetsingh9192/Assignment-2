<?php
    require 'connection.php'; 
    session_start();
    $sql = "DELETE FROM `gym` WHERE `gym`.`email` = '" . $_SESSION['username'] ."';";
    $result = mysqli_query($conn, $sql);
    if($result){
        session_unset();
        header("location: ./index.php");
    }
    else{
        echo "ERROR! Please try again";
    };    
?>
