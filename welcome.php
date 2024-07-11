<?php
session_start();

function redirectWithMessage($location, $message) {
    $_SESSION['message'] = $message;
    header("location: $location");
    exit();
}

if (!isset($_SESSION['username'])) {
    redirectWithMessage('./login.php', 'Please log in first.');
}

require './connection.php';

$sql = "SELECT * FROM `gym` WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    redirectWithMessage('./login.php', 'User not found.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $hashpass = password_hash($password, PASSWORD_DEFAULT);

    $update_sql = "UPDATE `gym` SET email = ?, password = ? WHERE email = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sss", $email, $hashpass, $_SESSION['username']);

    if ($update_stmt->execute()) {
        $_SESSION['username'] = $email;
        redirectWithMessage('./welcome.php', 'Please reload the page to see changes.');
    } else {
        echo "Please choose a different email.";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>welcome</title>
    <link rel="stylesheet" href="welcome.css">
</head>

<body>
    <div class="logout">
        <a href="./logout.php">Log Out</a>
    </div>
    <form action="./welcome.php" method="POST" class="container">
        <div class="input-group">
            <label for="email">Email address</label>
            <input type="email" name="email" value="<?php echo $data["email"] ?>" required>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="type new password" required>
        </div>
        <div class="btn logout">
            <a href="./delete.php">Delete account</a>
            <button type="submit">Update</button>
        </div>
    </form>

</body>

</html>