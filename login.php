<?php
$login = true;
$invail_user = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require './connection.php';
    $username = $_POST["username"];
    $log_pass = $_POST["log_pass"];
    $logsql = "SELECT * FROM `gym` WHERE email = ? OR `p.no` = ?";
    $stmt = $conn->prepare($logsql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $aff_rows = $result->num_rows;
    if ($aff_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            if (password_verify($log_pass, $row['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                header("location: ./welcome.php");
                exit();
             }
             else{
                $login = false;
             }
         } 
    }
    else {
        $invail_user = false;
    }
}


if (!$invail_user || !$login) {
    echo '<div class="alert" id="alert">
            <strong>Wrong Username or Password</strong>
             <button class="alrt_btn" id="alrt_btn" onclick="hide()">X</button>
    	</div>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <script>
        function hide() {
            let alert = document.getElementById('alert')
            let alrt_btn = document.getElementById('alrt_btn')
            alert.style.display = 'none'
        }
    </script>
    <div class="container">
        <div class="welcome">
            Welcome to MyGym 
            <p class="info"> Please enter you information</p>
        </div>
        <form class="registration-form" action="./login.php" method="post">
            <div class="input-group">
                <label for="username">E-mail\Phn no.</label><br><br>
                <input type="text" id="username" name="username" placeholder="E-mail or Phn no." required><br><br>
                <label for="password">Password</label><br><br>
                <input type="password" id="password" name="log_pass" placeholder="Password" required><br><br>
            </div>
            <div class="submit-btn">
                <button type="submit">Login</button>
            </div>
            <div class="signup">
                <p>don't have an account</p>
                <a href="./membership.php">Sign up</a>
            </div>
        </form>
    </div>
</body>

</html>