 <?php
    session_start();
    session_unset();
    echo "please wait";
    header ("location: index.php");
 ?>