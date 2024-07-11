<?php
if (!isset($_GET['mship'])) {
    header("location: ./membership.php");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require './connection.php';
        $membership = $_GET['mship'];
        $first_name = trim($_POST["first_name"]);
        $last_name = trim($_POST["last_name"]);
        $phn_no = $_POST["phn_no"];
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];
        $hashpass = password_hash($password, PASSWORD_DEFAULT);
        if (
            !filter_var($first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/"))) ||
            !filter_var($last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))
        ) {
            echo '<div class="alert" id="alert">
                 Please enter a valid name
                <button class="alrt_btn" id="alrt_btn" onclick="hide()">X</button>
                </div>';
        } else {
            if (!$password == $confirm_password) {
                echo '<div class="alert" id="alert">
                 <strong>Password mismatch!</strong>  Please enter same password
                <button class="alrt_btn" id="alrt_btn" onclick="hide()">X</button>
                </div>';
            } else {
                $existsql = "SELECT * FROM `gym` WHERE email = ? OR `p.no` = ?";
                $stmt = $conn->prepare($existsql);
                $stmt->bind_param("ss", $email, $phn_no);
                $stmt->execute();
                $result = $stmt->get_result();
                $exist = $result->num_rows;
                if ($exist > 0) {
                    echo '<div class="alert" id="alert">
            <span>User alredy exist.  <a href="./login.php">Login</a></span>
            <button class="alrt_btn" id="alrt_btn" onclick="hide()">X</button>
             </div>';
                } else {
                    $sql = "INSERT INTO `gym` (`membership`, `first_name`, `last_name`, `p.no`, `email`, `password`, `gender`, `dob`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssssss", $membership, $first_name, $last_name, $phn_no, $email, $hashpass, $gender, $dob);
                    $result = $stmt->execute();
                    if ($result) {
                        header('location: ./login.php');
                        exit();
                    };
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="registration.css">
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
        <form class="registration-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <div class="input-group" id="name">
                <div>
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required minlength="3" maxlength="20" placeholder="First Name">
                </div>
                <div>
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required minlength="2" maxlength="20" placeholder="Last Name">
                </div>
            </div>
            <div class="input-group">
                <label for="phn_no">Phone No.</label>
                <input type="tel" id="phn_no" name="phn_no" pattern="[0-9]{10}" placeholder="Phone number" required>
            </div>
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" maxlength="50" placeholder="E-mail" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" maxlength="30" placeholder="Enter your password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" class="retype" name="confirm_password" placeholder="Re-type your password" required>
            </div>
            <div class="input-group">
                <label>Gender</label>
                <div class="gender-options">
                    <div><input type="radio" id="male" name="gender" value="Male" required>
                        <label for="male">Male</label>
                    </div>
                    <div> <input type="radio" id="female" name="gender" value="Female">
                        <label for="female">Female</label>
                    </div>
                </div>
            </div>
            <div class="input-group">
                <label for="dob">DOB</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div>
                <button type="reset" class="clrbutton">Clear form</button>
            </div>
            <div class="button">
                <a href="./membership.php" class="back-btn">Back to Membership</a>
                <button type="submit" class="submit-btn">Register</button>
            </div>
        </form>
    </div>

</body>

</html>